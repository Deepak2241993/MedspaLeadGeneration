@extends('layouts.master')

@section('title')
    Data Tables
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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('build/libs/toastr/build/toastr.min.css') }}">
@endsection

@section('page-title')
    Leads
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div id="bulk-actions" style="display: none;">
                                    <button id="delete-all" class="btn btn-danger">Delete All</button>
                                    <button id="send-email" class="btn btn-info">Send Email</button>
                                </div>


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
                        @if (isset($error_message))
                            <div class="alert alert-danger">
                                {{ $error_message }}
                            </div>
                        @else
                            @if (isset($message))
                                <div class="alert alert-info">
                                    {{ $message }}
                                </div>
                            @endif

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="check-all"></th>
                                        <th>Sr No.</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Text</th>
                                        <th>Source</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @php
                                    //  dd($leads) ;
                                @endphp
                                <tbody>
                                    @forelse ($leads as $lead)
                                        <tr>
                                            <td style="width: 60px;">
                                                <div class="form-check font-size-16 text-center">
                                                    <input type="checkbox" class="row-checkbox"
                                                        data-ids="{{ $lead['_id'] }}" class="tasks-activeCheck2"
                                                        id="tasks-activeCheck2">
                                                    <label class="form-check-label" for="tasks-activeCheck2"></label>
                                                </div>
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $lead['first_name'] }}</td>
                                            <td>{{ $lead['last_name'] }}</td>
                                            <td class="email-column">{{ $lead['email'] }}</td>
                                            <td>{{ $lead['phone'] }}</td>
                                            <td>{{ $lead['message'] }}</td>
                                            <td>{{ $lead['source'] }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{ $lead['status_name'] }}
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @foreach ($statuses as $status)
                                                            <a class="dropdown-item change-status" href="#"
                                                                data-lead-id="{{ $lead['_id'] }}"
                                                                data-status-id="{{ $status['_id'] }}"
                                                                data-column-name="{{ $status['name'] }}">
                                                                {{ $status['name'] }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ route('leads.edit', $lead['_id']) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('leads.destroy', $lead['_id']) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                <a class="btn btn-success btn-sm btn-call"
                                                    data-phone="{{ $lead['phone'] }}"
                                                    onclick="makeCall(event, '{{ $lead['phone'] }}')">Call</a>
                                                <a class="btn btn-info btn-sm btn-sms" data-phone="{{ $lead['phone'] }}"
                                                    onclick="sendMessage(event, '{{ $lead['phone'] }}')">Message</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9">No data found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

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

                var url = "{{ route('outbound-call') }}";

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

                    $.post('{{ route('end-call') }}', {
                        _token: '{{ csrf_token() }}'
                    }, function(response) {
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
        <script>
            $(document).ready(function() {
                // Toggle checkboxes
                $('#check-all').click(function() {
                    $('.row-checkbox').prop('checked', this.checked);
                    updateBulkActions();
                });

                // Monitor checkbox changes
                $('.row-checkbox').change(function() {
                    updateBulkActions();
                });

                // Update bulk actions visibility
                function updateBulkActions() {
                    var checkedCount = $('.row-checkbox:checked').length;
                    if (checkedCount > 2) {
                        $('#bulk-actions').show();
                    } else {
                        $('#bulk-actions').hide();
                    }
                }

                // Handle Delete All action
                $(document).ready(function() {
                    // Toastr options
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

                    // Handle Check All action
                    $('#check-all').click(function() {
                        $('.row-checkbox').prop('checked', this.checked);
                    });

                    // Handle Delete All action
                    $('#delete-all').click(function() {
                        if (confirm('Are you sure you want to delete the selected columns?')) {
                            var ids = $('.row-checkbox:checked').map(function() {
                                return $(this).data(
                                'ids'); // Ensure data-ids attribute is used correctly
                            }).get();

                            if (ids.length > 0) {
                                var url =
                                "{{ route('leads.destroyMultiple') }}"; // Updated route name for multiple delete
                                $.ajax({
                                    url: url,
                                    type: 'DELETE',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        ids: ids
                                    },
                                    success: function(response) {
                                        toastr.success(
                                            'Selected columns deleted successfully');
                                        location
                                    .reload(); // Reload the page to see the changes
                                    },
                                    error: function(xhr) {
                                        toastr.error('Error deleting columns: ' + xhr
                                            .responseJSON.message);
                                    }
                                });
                            } else {
                                toastr.warning('No columns selected for deletion');
                            }
                        }
                    });
                });


                // Handle Send Email action
                $('#send-email').click(function() {
                    var emails = $('.row-checkbox:checked').closest('tr').find('.email-column').map(function() {
                        return $(this).text().trim(); // Extract text and trim any extra spaces
                    }).get();

                    // Display the collected email addresses in an alert
                    // alert('Collected Emails: \n' + emails.join('\n'));


                    $.ajax({
                        url: '#', // Update with your send email route
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            emails: emails
                        },
                        success: function(response) {
                            alert('Emails sent successfully');
                        },
                        error: function(xhr) {
                            alert('Error sending emails: ' + xhr.responseJSON.message);
                        }
                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var statusLinks = document.querySelectorAll('.change-status');

                statusLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        var leadId = this.getAttribute('data-lead-id');
                        var statusId = this.getAttribute('data-status-id');
                        var column_name = this.getAttribute('data-column-name');
                        var leadRow = this.closest('tr');
                        var statusButton = leadRow.querySelector('.dropdown-toggle');

                        // Create the spinner element
                        var spinner = document.createElement('div');
                        spinner.classList.add('spinner-border', 'spinner-border-sm', 'text-warning',
                            'm-1');
                        spinner.setAttribute('role', 'status');
                        var spinnerText = document.createElement('span');
                        spinnerText.classList.add('sr-only');
                        spinnerText.textContent = 'Loading...';
                        spinner.appendChild(spinnerText);

                        // Append the spinner to the button
                        statusButton.appendChild(spinner);

                        $.ajax({
                            url: "{{ route('leadboards.update_index') }}",
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                task_id: leadId,
                                status: statusId,
                                column_name: column_name
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success('Lead status updated successfully');
                                    statusButton.textContent = column_name + ' ';
                                    var icon = document.createElement('i');
                                    // icon.classList.add('mdi', 'mdi-chevron-down');
                                    statusButton.appendChild(icon);
                                } else {
                                    toastr.success('Lead status updated successfully');
                                    // Update the status button text without reloading
                                    statusButton.textContent = column_name + ' ';
                                    // Add the dropdown icon back
                                    var icon = document.createElement('i');
                                    // icon.classList.add('mdi', 'mdi-chevron-down');
                                    statusButton.appendChild(icon);
                                    // toastr.error('Failed to update lead status: ' + response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                toastr.error('An error occurred: ' + error);
                            },
                            complete: function() {
                                // Remove the spinner after the request is complete
                                spinner.remove();
                            }
                        });
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
    @endsection
