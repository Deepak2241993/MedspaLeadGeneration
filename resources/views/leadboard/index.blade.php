@extends('layouts.master')

@section('title', 'LeadBoard')

@section('css')
    <!-- Custom Styles -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .task {
            cursor: move;
        }
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
            border: 1px solid #000000 !important;
        }
        .card-body {
            max-height: 400px; /* Adjust as needed */
            overflow-y: auto;
        }
        .b-p-body {
            padding: 0 1rem 1rem 1rem;
        }
        .b-p-tasks {
            min-height: 100px; /* Ensure there's enough height for the drop zone */
            max-height: 400px; /* Adjust as needed */
            overflow-y: auto;
            background-color: #f8f9fa; /* Light background color for better visibility */
        }
        .no-tasks-message {
           margin-top: 50px;
            text-align: center;
            color: #6c757d; /* Text color for the no-tasks message */
        }
    </style>
@endsection

@section('page-title', 'Lead Board')

@section('body')
    <body data-sidebar="colored">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="d-grid d-lg-flex d-md-flex align-items-center action-bar mt-5">
            <div id="table-actions" class="flex-grow-1">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addColumnModal">
                    <i class="mdi mdi-plus-box"></i>
                    Add Status Column
                </button>
            </div>            
            <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                <a href="{{ route('leads.index') }}" class="btn btn-secondary btn-active" data-toggle="tooltip" data-original-title="Table View">
                    <i class="uim uim-grip-horizontal-line"></i>
                </a>
                <a href="{{ route('leadboard') }}" class="btn btn-secondary" data-toggle="tooltip" data-original-title="Lead Status">
                    <i class="uim uim-columns"></i>
                </a>
            </div>
        </div>

        <div class="w-task-board-box px-4 py-2 bg-white mt-2">
            <div class="w-task-board-panel d-flex" id="taskboard-columns">
                <div class="container mt-5">
                    <div class="row">
                        @foreach ($leadStatuses as $column)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="mb-3 task">
                                            @if (isset($column['name']))
                                                <p class="mb-0 f-15 text-dark-grey font-weight-bold">
                                                    <i class="fa fa-circle mr-2 text-yellow" style="color: #{{ $column['_id'] }}"></i>
                                                    {{ $column['name'] }}
                                                </p>
                                            @else
                                                <p class="mb-0 f-15 text-dark-grey font-weight-bold">Name not available</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="b-p-body">
                                        <div class="b-p-tasks" id="drag-container-{{ $column['_id'] }}" data-column-id="{{ $column['_id'] }}">
                                            @php
                                                $hasTasks = false;
                                            @endphp
                                            @foreach ($leadData as $lead)
                                                @if ($lead['status_id'] == $column['_id'])
                                                    @php
                                                        $hasTasks = true;
                                                    @endphp
                                                    <div class="card rounded bg-white border-grey b-shadow-4 m-1 mb-2 task-card"
                                                        data-task-id="{{ $lead['_id'] }}" id="drag-task-{{ $lead['_id'] }}">
                                                        <div class="card-body p-2">
                                                            <div class="d-flex justify-content-between mb-2">
                                                                <a href="#" class="f-12 font-weight-500 text-dark mb-0 text-wrap openRightModal">
                                                                    {{ $lead['first_name'] }} {{ $lead['last_name'] }}
                                                                    @if (!empty($lead['status_id']))
                                                                        <i class="fa fa-check-circle text-success" data-toggle="tooltip"
                                                                            data-original-title="convertedClient"></i>
                                                                    @endif
                                                                </a>
                                                                <div class="d-flex mb-3 align-items-center">
                                                                    <a class="mdi-file-phone text-lightest btn btn-success btn-sm btn-call" data-phone="{{ $lead['phone'] }}"
                                                                        onclick="makeCall(event, '{{ $lead['phone'] }}')"></a>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                @if (!empty($lead['email']))
                                                                    <div class="d-flex flex-wrap">
                                                                        <div>
                                                                            {{ $lead['email'] }}
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if (!$hasTasks)
                                                <div class="text-center text-muted no-tasks-message">
                                                    No tasks available
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addColumnModal" tabindex="-1" aria-labelledby="addColumnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addColumnModalLabel">Add Status Column</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addColumnForm" method="POST" action="{{ route('lead-status.create') }}">
                        @csrf
                        <div class="form-group">
                            <label for="columnName">Column Name</label>
                            <input type="text" class="form-control" id="columnName" name="columnName" required>
                        </div>
                        <div class="form-group">
                            <label for="columnColor">Column Color</label>
                            <input type="color" class="form-control" id="columnColor" name="columnColor" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Column</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Dragula for drag and drop functionality -->
    <script src="https://cdn.jsdelivr.net/npm/dragula@3.7.3/dist/dragula.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var containers = Array.from(document.querySelectorAll('.b-p-tasks'));
            var drake = dragula(containers);

            function updateEmptyMessages() {
                containers.forEach(function(container) {
                    var hasTasks = container.querySelector('.task-card');
                    var noTasksMessage = container.querySelector('.no-tasks-message');
                    if (hasTasks) {
                        if (noTasksMessage) noTasksMessage.style.display = 'none';
                    } else {
                        if (noTasksMessage) noTasksMessage.style.display = 'block';
                    }
                });
            }

            updateEmptyMessages();

            drake.on('drag', function (el) {
                el.style.opacity = '0.5'; // Make the dragged item slightly transparent
            });

            drake.on('dragend', function (el) {
                el.style.opacity = ''; // Reset the opacity
                updateEmptyMessages();
            });

            drake.on('drop', function (el, target, source, sibling) {
                var task_id = el.getAttribute('data-task-id');
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
                            console.log('Task updated successfully');
                            updateEmptyMessages();
                        } else {
                            console.error('Failed to update task status:', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
