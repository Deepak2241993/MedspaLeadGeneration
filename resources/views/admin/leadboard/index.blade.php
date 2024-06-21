@extends('admin.layouts.app')

@php
    $pageTitle = 'LeadBoard';
@endphp

@push('styles')
    @include('admin.sections.leadboad_css')
    <!-- Drag and Drop CSS -->
    <link rel='stylesheet' href="{{ asset('vendor/css/dragula.css') }}" type='text/css' />
    <link rel='stylesheet' href="{{ asset('vendor/css/drag.css') }}" type='text/css' />
    <link rel="stylesheet" href="{{ asset('vendor/css/bootstrap-colorpicker.css') }}" />
    <style>
        #colorpicker .form-group {
            width: 87%;
        }

        .b-p-tasks {
            min-height: 90%;
        }
    </style>
@endpush
@section('content')
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog d-flex justify-content-center align-items-center modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    {{-- {{ __('app.loading') }} --}}
                    <!-- Add your loading indicator here (e.g., spinner or loading animation) -->
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-cancel rounded mr-3" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-primary rounded">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTENT WRAPPER START -->
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center">
                <button type="button" class="btn-secondary rounded f-14 p-2" id="add-column">
                    <svg class="svg-inline--fa fa-plus fa-w-14 mr-1" aria-hidden="true" focusable="false" data-prefix="fa"
                        data-icon="plus" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                        data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z">
                        </path>
                    </svg><!-- <i class="fa fa-plus mr-1"></i> Font Awesome fontawesome.com -->
                    Add Status Column
                </button>
            </div>
            <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary f-14 btn-active" data-toggle="tooltip"
                    data-original-title="Table View"><i class="side-icon bi bi-list-ul"></i></a>
                <a href="{{ route('admin.leadboard') }}" class="btn btn-secondary f-14" data-toggle="tooltip"
                    data-original-title="Lead Status"><i class="side-icon bi bi-kanban"></i></a>
            </div>
        </div>
    </div>
    <div class="w-task-board-box px-4 py-2 bg-white">
        <div class="w-task-board-panel d-flex" id="taskboard-columns">
            @php
                // print_r($mergedData); die;
            @endphp
            @foreach ($leadStatuses as $column)
                <div class="board-panel rounded bg-additional-grey border-grey mr-3">
                    <div class="mx-3 mt-3 mb-1 b-p-header">
                        <div class="d-flex">
                            @if (isset($column['name']))
                                <p class="mb-0 f-15 mr-3 text-dark-grey font-weight-bold"><i
                                        class="fa fa-circle mr-2 text-yellow"
                                        style="color: #{{ $column['_id'] }}"></i>{{ $column['name'] }}</p>
                            @else
                                <p class="mb-0 f-15 mr-3 text-dark-grey font-weight-bold">Name not available</p>
                            @endif

                            <span class="b-p-badge bg-grey f-13 px-2 text-lightest font-weight-bold rounded d-inline-block"
                                id="lead-column-count-"></span>
                            <span class="ml-auto d-flex align-items-center">
                                <a href="javascript:;" class="d-flex f-8 text-lightest mr-3 collapse-column"
                                    data-column-id="{{ $column['_id'] }}" data-type="minimize" data-toggle="tooltip"
                                    data-original-title=collapse>
                                    <i class="fa fa-chevron-right mr-1"></i>
                                    <i class="fa fa-chevron-left"></i>
                                </a>
                                <div class="dropdown">
                                    <button
                                        class="btn bg-white btn-lg f-10 px-2 py-1 text-dark-grey text-capitalize rounded  dropdown-toggle"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right border-grey rounded b-shadow-4 p-0"
                                        aria-labelledby="dropdownMenuLink" tabindex="0">
                                        {{-- <a class="dropdown-item openRightModal" href="">Add Lead</a> --}}
                                        <hr class="my-1">
                                        <a class="dropdown-item edit-column" data-column-id="{{ $column['_id'] }}"
                                            href="javascript:;">edit</a>
                                        <a class="dropdown-item delete-column" data-column-id="{{ $column['_id'] }}"
                                            href="javascript:;">delete</a>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <div class="mr-3 ml-4 f-11 text-dark-grey">
                        </div>
                    </div>
                    <div class="b-p-body">
                        <div class="b-p-tasks" id="drag-container-{{ $column['_id'] }}"
                            data-column-id="{{ $column['_id'] }}">
                            @foreach ($leadData as $lead)
                                {{-- <x-lead-card :draggable="true" :lead="$lead" /> --}}
                                @if ($lead['status_id'] == $column['_id'])
                                    <x-lead-card :draggable="true" :lead="$lead" />
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/jquery/dragula.js') }}"></script>
    <!-- Add jQuery library -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script>
        const MODAL_LG = '#myModal';
        const MODAL_XL = '#myModalXl';
        const MODAL_HEADING = '#modelHeading';
        $('#add-column').click(function() {
            const url = "{{ route('admin.lead-status.create') }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('body').on('click', '.edit-column', function() {
            var statusId = $(this).data('column-id');
            var url = "{{ route('admin.lead-status.edit', ':id') }}";
            url = url.replace(':id', statusId);
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
            console.log(url);
        });

        $('body').on('click', '.delete-column', function() {
            var id = $(this).data('column-id');
            var url = "{{ route('admin.lead-status.destroy', ':id') }}";
            url = url.replace(':id', id);

            // console.log(url);

            Swal.fire({
                title: "Are you sure?",
                text: "You will not be able to recover the deleted record!",
                icon: 'warning',
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                customClass: {
                    confirmButton: 'btn btn-primary mr-3',
                    cancelButton: 'btn btn-secondary'
                },
                showClass: {
                    popup: 'swal2-noanimation',
                    backdrop: 'swal2-noanimation'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.easyAjax({
                        url: url,
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            '_method': 'DELETE'
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                window.location.reload();
                            }
                        }
                    });
                }
            });

        });
    </script>
    <!-- Drag and Drop Plugin -->
    <script>
        // Assuming dragula library is included in your project
        var arraylike = document.getElementsByClassName('b-p-tasks');
        var containers = Array.prototype.slice.call(arraylike);

        var drake = dragula({
                containers: containers,
                moves: function(el, source, handle, sibling) {
                    if (el.classList.contains('move-disable') || !KTUtil.isDesktopDevice()) {
                        return false;
                    }
                    return true; // elements are always draggable by default
                },
            })
            .on('drag', function(el) {
                el.className = el.className.replace('ex-moved', '');
            })
            .on('drop', function(el) {
                el.className += ' ex-moved';
            })
            .on('over', function(el, container) {
                container.className += ' ex-over';
            })
            .on('out', function(el, container) {
                container.className = container.className.replace('ex-over', '');
            });
    </script>

    <script>
        drake.on('drop', function(element, target, source, sibling) {
            var elementId = element.id;
            $children = $('#' + target.id).children();
            var boardColumnId = $('#' + target.id).data('column-id');
            var movingTaskId = $('#' + element.id).data('task-id');
            var sourceBoardColumnId = $('#' + source.id).data('column-id');
            var sourceColumnCount = parseInt($('#lead-column-count-' + sourceBoardColumnId).text());
            var targetColumnCount = parseInt($('#lead-column-count-' + boardColumnId).text());

            // console.log(elementId);
            var taskIds = [];
            var prioritys = [];

            $children.each(function(ind, el) {
                taskIds.push($(el).data('task-id'));
                prioritys.push($(el).index());
            });

            // update values for all tasks
            $.easyAjax({
                url: "{{ route('admin.leadboards.update_index') }}",
                type: 'POST',
                container: '#taskboard-columns',
                blockUI: true,
                data: {
                    boardColumnId: boardColumnId,
                    movingTaskId: movingTaskId,
                    taskIds: taskIds,
                    prioritys: prioritys,
                    '_token': '{{ csrf_token() }}'
                },
                success: function() {
                    if ($('#' + source.id + ' .task-card').length == 0) {
                        $('#' + source.id + ' .no-task-card').removeClass('d-none');
                    }
                    if ($('#' + target.id + ' .task-card').length > 0) {
                        $('#' + target.id + ' .no-task-card').addClass('d-none');
                    }

                    $('#lead-column-count-' + sourceBoardColumnId).text(sourceColumnCount - 1);
                    $('#lead-column-count-' + boardColumnId).text(targetColumnCount + 1);

                }
            });

        });
    </script>
@endpush
