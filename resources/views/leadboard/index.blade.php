@extends('layouts.master')

@section('title')
    LeadBoard
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
        <style>
            .task {
    cursor: move;
}

        </style>
         <style>
            .w-task-board-box {
                overflow-x: auto;
                white-space: nowrap;
                padding: 1rem;
                background-color: #ffffff;
            }

            .w-task-board-panel {
                display: flex;
                flex-wrap: nowrap;
            }

            .card {
                flex: 0 0 auto;
                border: 1px solid #000000 !important;
            }

            .card-body {
                max-height: 400px; /* Adjust as needed */
                overflow-y: auto;
            }

            .task {
                cursor: move;
            }

            .b-p-body {
                padding: 0 1rem 1rem 1rem;
            }

            .b-p-tasks {
                max-height: 400px; /* Adjust as needed */
                overflow-y: auto;
            }
        </style>
@endsection

@section('page-title')
    Lead Board
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center">
                <button type="button" class="btn btn-secondary buttons-copy buttons-html5" id="add-column">
                    <i class="mdi-plus-box"></i>
                    Add Status Column
                </button>
            </div>
            <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                <a href="{{ route('leads.index')}}" class="btn btn-secondary f-14 btn-active" data-toggle="tooltip" data-original-title="Table View"><i class="uim uim-grip-horizontal-line"></i></a>
                <a href="{{ route('leadboard')}}" class="btn btn-secondary f-14" data-toggle="tooltip" data-original-title="Lead Status"><i class=" uim uim-columns"></i></a>
            </div>
        </div>
    </div>
    <div class="w-task-board-box px-4 py-2 bg-white">
        <div class="w-task-board-panel d-flex" id="taskboard-columns">
            <div class="container mt-5">
                <div class="row">
                    @foreach ($leadStatuses as $column)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class=" mb-3 task">
                                    @if (isset($column['name']))
                                    <p class="mb-0 f-15 mr-3 text-dark-grey font-weight-bold">
                                        <i class="fa fa-circle mr-2 text-yellow" style="color: #{{ $column['_id'] }}"></i>
                                        {{ $column['name'] }}
                                    </p>
                                    @else
                                    <p class="mb-0 f-15 mr-3 text-dark-grey font-weight-bold">Name not available</p>
                                    @endif
                                </div>
                            </div>
                            <div class="b-p-body">
                                <div class="b-p-tasks" id="drag-container-{{ $column['_id'] }}" data-column-id="{{ $column['_id'] }}">
                                    @foreach ($leadData as $lead)
                                        @if ($lead['status_id'] == $column['_id'])
                                            <x-lead-card :draggable="true" :lead="$lead" />
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

        <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script>
            const MODAL_LG = '#myModal';

            $('body').on('click', '.edit-column', function() {
                var statusId = $(this).data('column-id');
                var url = "{{ route('leadstatus.edit', ':id') }}";
                url = url.replace(':id', statusId);
                $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
                $.ajaxModal(MODAL_LG, url);
                console.log(url);
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var containers = Array.prototype.slice.call(document.querySelectorAll('.b-p-tasks'));
                var drake = dragula(containers);

                drake.on('drop', function (el, target, source, sibling) {
                    var task_id = el.getAttribute('data-id');
                    var status = target.getAttribute('data-column-id');

                    $.ajax({
                        url: "{{ route('leadboards.update_index') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            task_id: task_id,
                            status: status
                        },
                        success: function(response) {
                            if (response.success) {
                                // Optionally, add any additional success handling here
                            }
                        }
                    });
                });
            });
        </script>
    @endsection
