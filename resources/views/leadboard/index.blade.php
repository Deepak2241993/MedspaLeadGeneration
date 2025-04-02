@extends('layouts.master')

@section('title', 'LeadBoard')

@section('css')
<!-- Custom Styles -->
<link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
    type="text/css" />
<link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
    rel="stylesheet" type="text/css" />
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('build/libs/toastr/build/toastr.min.css') }}">
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
        max-height: 400px;
        overflow-y: auto;
    }

    .b-p-body {
        padding: 0 1rem 1rem 1rem;
    }

    .b-p-tasks {
        min-height: 100px;
        max-height: 400px;
        overflow-y: auto;
        background-color: #f8f9fa;
    }

    .no-tasks-message {
        margin-top: 50px;
        text-align: center;
        color: #6c757d;
    }

    .border-grey {
        background: #000000;
    }

    /* Custom CSS for SweetAlert2 */
    .swal2-container {
        z-index: 9999;
        /* Ensure it's on top of other elements */
    }

    .swal2-toast-top-right {
        position: fixed;
        top: 10px;
        /* Distance from the top */
        right: 10px;
        /* Distance from the right */
        margin: 0;
    }
</style>
@endsection

@section('body')

<body data-sidebar="colored">
    @endsection

    @section('content')
    <div class="content-wrapper">
        <div class="d-grid d-lg-flex d-md-flex align-items-center action-bar">
            <div id="table-actions" class="flex-grow-1">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#addColumnModal">
                    <i class="mdi mdi-plus-box"></i>
                    Add Status Column
                </button>
            </div>
            <div class="col-md-6">
                <div class="mb-3 float-end">
                    <a href="{{ route('leads.index') }}" class="btn btn-primary">
                        <i class="fas fa-bars"></i></i>
                    </a>
                    <a href="{{ route('leadboard') }}" class="btn btn-primary">
                        <i class="uim uim-columns"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="w-task-board-box px-4 py-2 bg-white ">
            <div class="w-task-board-panel d-flex" id="taskboard-columns">
                <div class="container mt-5">
                    <div class="row">
                        @foreach ($leadStatuses as $index => $column)
                        <div class="col-md-4 mb-4">
                            <div class="card" style="border: 1px solid #{{ $column['label_color'] }} !important;">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mb-3 task">
                                            @if (isset($column['name']))
                                            <p class="mb-0 f-15 text-dark-grey font-weight-bold"
                                                style="color:#{{ $column['label_color'] }} !important;">
                                                <i class="fa fa-circle mr-2 text-yellow"
                                                    style="color: #{{ $column['label_color'] }}"></i>
                                                {{ $column['name'] }}
                                            </p>
                                            @else
                                            <p class="mb-0 f-15 text-dark-grey font-weight-bold">Name not
                                                available</p>
                                            @endif
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-rounded waves-effect" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="#" onclick="editColumn('{{ $column['_id'] }}', '{{ $column['name'] }}', '{{ $column['label_color'] }}', {{ $index }})">Edit</a></li>
                                                @if ($index != 0)
                                                <li><a class="dropdown-item" href="#" onclick="deleteColumn('{{ $column['_id'] }}', '{{ route('lead-status.destroy', $column['_id']) }}')">Delete</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="b-p-body">
                                    <div class="b-p-tasks" id="drag-container-{{ $column['_id'] }}"
                                        data-column-id="{{ $column['_id'] }}" data-column-name="{{ $column['name'] }}">

                                        @foreach ($uniqueLeads as $lead)
                                        @if ($lead['status_id'] == $column['_id'])
                                        @php
                                        $hasTasks = true;
                                        @endphp
                                        <div class="card rounded bg-white border-grey b-shadow-4 m-1 mb-2 task-card"
                                            data-task-id="{{ $lead['_id'] }}"
                                            id="drag-task-{{ $lead['_id'] }}">
                                            <div class="card-body p-2">
                                                <div class="d-flex justify-content-between mb-2">
                                                    <a href="#"
                                                        class="f-12 font-weight-500 text-dark mb-0 text-wrap openRightModal">
                                                        {{ $lead['first_name'] }} {{ $lead['last_name'] }}
                                                        @if (!empty($lead['status_id']))
                                                        <i class="fa fa-check-circle text-success"
                                                            data-toggle="tooltip"
                                                            data-original-title="convertedClient"></i>
                                                        @endif
                                                    </a>
                                                    <div class="d-flex align-items-center">
                                                        <!-- Call button -->
                                                        <a class="fa fa-phone text-lightest btn btn-outline-info waves-effect waves-light"
                                                            data-phone="{{ $lead['country_code'] }}{{ $lead['phone'] }}"
                                                            onclick="makeCall(event, '{{ $lead['country_code'] }}{{ $lead['phone'] }}')"
                                                            aria-label="Call {{ $lead['first_name'] }} {{ $lead['last_name'] }}"></a>

                                                        <!-- Message button -->
                                                        <a class="fa fa-envelope text-lightest btn btn-outline-info waves-effect waves-light ml-2"
                                                            data-phone="{{ $lead['country_code'] }}{{ $lead['phone'] }}"
                                                            onclick="sendMessage(event, '{{ $lead['country_code'] }}{{ $lead['phone'] }}')"
                                                            aria-label="Message {{ $lead['first_name'] }}{{ $lead['last_name'] }}"></a>
                                                    </div>

                                                </div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center">
                                                    @if (!empty($lead['email']))
                                                    <div class="d-flex flex-wrap">
                                                        <div>{{ $lead['email'] }}</div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        <div class="text-center text-muted no-tasks-message">No tasks available
                                        </div>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addColumnForm" method="POST" action="{{ route('lead-status.store') }}">
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
    <!-- Edit Column Modal -->
    <div class="modal fade" id="editColumnModal" tabindex="-1" aria-labelledby="editColumnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editColumnModalLabel">Edit Status Column</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editColumnForm">
                        @csrf
                        <input type="hidden" id="editColumnId" name="columnId">
                        <input type="hidden" id="editColumnPosition" name="columnPosition">
                        <div class="form-group">
                            <label for="editColumnName">Column Name</label>
                            <input type="text" class="form-control" id="editColumnName" name="columnName" required>
                        </div>
                        <div class="form-group">
                            <label for="editColumnColor">Column Color</label>
                            <input type="color" class="form-control" id="editColumnColor" name="columnColor" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Call Modal -->
    <div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="callModalLabel">Call in Progress</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Call Time: <span id="callTimer">&times;</span></p>
                    <div class="d-flex justify-content-around">
                        <button id="endCall" class="btn btn-danger">End Call</button>
                        {{-- <button id="muteCall" class="btn btn-warning">Mute</button>
                                <button id="holdCall" class="btn btn-info">Hold</button> --}}
                    </div>
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
    <!-- toastr plugin -->
    <script src="{{ URL::asset('build/libs/toastr/build/toastr.min.js') }}"></script>

    <!-- toastr init -->
    <script src="{{ URL::asset('build/js/pages/toastr.init.js') }}"></script>
    <!-- Dragula for drag and drop functionality -->
    <script src="https://cdn.jsdelivr.net/npm/dragula@3.7.3/dist/dragula.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var containers = Array.from(document.querySelectorAll('.b-p-tasks'));
            var drake = dragula(containers);

            function updateEmptyMessages() {
                containers.forEach(function(container) {
                    var hasTasks = container.querySelector('.task-card') !== null;
                    var noTasksMessage = container.querySelector('.no-tasks-message');
                    if (noTasksMessage) {
                        noTasksMessage.style.display = hasTasks ? 'none' : 'block';
                    }
                });
            }

            updateEmptyMessages();

            drake.on('drag', function(el) {
                el.style.opacity = '0.5'; // Make the dragged item slightly transparent
            });

            drake.on('dragend', function(el) {
                el.style.opacity = ''; // Reset the opacity
                updateEmptyMessages();
            });

            drake.on('drop', function(el, target) {
                var task_id = el.getAttribute('data-task-id');
                var status = target.getAttribute('data-column-id');
                var column_name = target.getAttribute('data-column-name');

                $.ajax({
                    url: "{{ route('leadboards.update_index') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        task_id: task_id,
                        status: status,
                        column_name: column_name
                    },
                    success: function(response) {
                        toastr["success"]("Task status updated successfully");

                        updateEmptyMessages();
                    },
                    error: function(xhr, status, error) {
                        toastr["error"]("An error occurred: " + error);
                    }
                });
            });
        });

        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": 300,
            "hideDuration": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000,
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>



    <script>
        $(document).ready(function() {
            $('#addColumnForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                timer: 2000, // Show the alert for 2 seconds
                                timerProgressBar: true,
                                willClose: () => {
                                    // Optional: Add a function to execute when the alert is closed
                                    $('#addColumnModal').modal(
                                        'hide'); // Close the modal
                                    $('#addColumnForm')[0]
                                        .reset(); // Optionally reset the form fields
                                    location
                                        .reload(); // Reload the page or update the data as needed
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An unexpected error occurred.',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function editColumn(columnId, columnName, columnColor, columnPosition) {
            // Set the values in the modal
            document.getElementById('editColumnId').value = columnId;
            document.getElementById('editColumnName').value = columnName;
            document.getElementById('editColumnColor').value = '#' + columnColor;
            document.getElementById('editColumnPosition').value = columnPosition;

            // Open the modal
            var editModal = new bootstrap.Modal(document.getElementById('editColumnModal'));
            editModal.show();
        }

        function deleteColumn(columnId, deleteUrl) {
            $.ajax({
                url: deleteUrl.replace('{id}', columnId),
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: columnId
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Column deleted successfully',
                        icon: 'success',
                        timer: 3000, // 3 seconds
                        timerProgressBar: true,
                        didClose: () => {
                            location.reload(); // Reload the page after SweetAlert closes
                        }
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error deleting column: ' + (xhr.responseJSON.message || 'An unexpected error occurred.'),
                        icon: 'error',
                        timer: 3000, // 3 seconds
                        timerProgressBar: true
                    });
                }
            });

        }
    </script>
    <script>
        $(document).ready(function() {
            $('#editColumnForm').on('submit', function(e) {
                e.preventDefault();

                var formData = $(this).serialize();
                var url = "{{ route('lead-status.update') }}"; // Your form action URL

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $('#editColumnModal').modal('hide');

                            // Add a delay before reloading the page to allow the SweetAlert to display
                            setTimeout(function() {
                                location.reload(); // Reload the page
                            }, 1600); // Slightly more than the SweetAlert timer (1500ms) to ensure it shows
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            // Log the full API response for debugging
                            console.error(response.api_response);
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!',
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });
        });
    </script>

    <script>
        function sendMessage(event, phone) {
            event.preventDefault();

            // Define the URL for the message dashboard
            let dashboardUrl = '/messages'; // Replace with the actual route if needed

            // Append the phone number as a query parameter
            window.location.href = `${dashboardUrl}?phone=${encodeURIComponent(phone)}`;
        }
    </script>
    <script>
        var callTimerInterval;
        var callStartTime;
        let isMuted = false;
        let isOnHold = false;

        function startCallTimer() {
            callStartTime = new Date();
            callTimerInterval = setInterval(updateCallTimer, 1000);
        }

        function updateCallTimer() {
            var now = new Date();
            var elapsedTime = Math.floor((now - callStartTime) / 1000);

            var hours = Math.floor(elapsedTime / 3600);
            var minutes = Math.floor((elapsedTime % 3600) / 60);
            var seconds = elapsedTime % 60;

            var formattedTime =
                (hours < 10 ? '0' : '') + hours + ':' +
                (minutes < 10 ? '0' : '') + minutes + ':' +
                (seconds < 10 ? '0' : '') + seconds;

            $('#callTimer').text(formattedTime);
        }

        function stopCallTimer() {
            clearInterval(callTimerInterval);
            $('#callTimer').text('00:00:00');
        }

        function makeCall(e, phone) {
            e.preventDefault(); // Prevent the default link behavior

            var url = "{{ route('twilio.outbound-call') }}";

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    phone: phone,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // console.log(response.message);
                    $('#callModal').modal('show');
                    startCallTimer();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    // Handle errors (optional)
                }
            });
        }

        function endCall() {
            $('#callModal').modal('hide');
        }

        $(document).ready(function() {
            $('#endCall').on('click', function(e) {
                e.preventDefault(); // Prevent the default link behavior

                $.post('{{ route('twilio.end-call') }}', {
                        _token: '{{ csrf_token() }}'
                    },
                    function(response) {
                        if (response.success) {
                            endCall();
                            stopCallTimer();
                            alert(response.message);
                        } else {
                            alert('Failed to end call: ' + response.message);
                        }
                    });
            });

            // document.getElementById('muteCall').addEventListener('click', () => {
            //     const action = 'mute';
            //     const conferenceSid = 'your_conference_sid'; // Replace with actual conference SID
            //     const participantSid = 'participant_sid_to_mute'; // Replace with actual participant SID

            //     // Fetch CSRF token from meta tag in your HTML layout
            //     const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            //     fetch(`/mute-participant/${conferenceSid}/${participantSid}`, {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
            //             },
            //             body: JSON.stringify({}) // Optional: add body if needed
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             if (data.success) {
            //                 alert('Participant muted successfully.');
            //             } else {
            //                 alert('Failed to mute participant.');
            //             }
            //         })
            //         .catch(error => console.error('Error:', error));
            // });

            // document.getElementById('holdCall').addEventListener('click', () => {
            //     const action = isOnHold ? 'unhold' : 'hold';
            //     const conferenceSid = 'your_conference_sid'; // Replace with actual conference SID
            //     const participantSid = 'participant_sid_to_hold'; // Replace with actual participant SID

            //     // Fetch CSRF token from meta tag in your HTML layout
            //     const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            //     fetch(`/hold-participant/${conferenceSid}/${participantSid}`, {
            //             method: 'POST',
            //             headers: {
            //                 'Content-Type': 'application/json',
            //                 'X-CSRF-TOKEN': csrfToken // Include CSRF token in headers
            //             },
            //             body: JSON.stringify({}) // Optional: add body if needed
            //         })
            //         .then(response => response.json())
            //         .then(data => {
            //             if (data.success) {
            //                 isOnHold = !isOnHold;
            //                 document.getElementById('holdCall').textContent = isOnHold ? 'Unhold' :
            //                     'Hold';
            //                 alert(`Participant ${isOnHold ? 'put on hold' : 'resumed'} successfully.`);
            //             } else {
            //                 alert(`Failed to ${isOnHold ? 'resume' : 'hold'} participant.`);
            //             }
            //         })
            //         .catch(error => console.error('Error:', error));
            // });

            // // Fetch all conferences
            // fetch('/conferences')
            //     .then(response => response.json())
            //     .then(conferences => {
            //         console.log(conferences);
            //         // Use the conference SID as needed
            //     })
            //     .catch(error => console.error('Error:', error));

            // // Fetch participants for a specific conference
            // const conferenceSid = 'your_conference_sid'; // Replace with actual SID
            // fetch(`/conference/${conferenceSid}/participants`)
            //     .then(response => response.json())
            //     .then(participants => {
            //         console.log(participants);
            //         // Use the participant SID as needed
            //     })
            //     .catch(error => console.error('Error:', error));

            $('#callModal').on('hidden.bs.modal', function() {
                // console.log('Modal closed');
                stopCallTimer();
            });
        });
    </script>

    @endsection