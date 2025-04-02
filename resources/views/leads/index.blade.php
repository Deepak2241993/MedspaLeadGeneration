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
<style>
    .table td.truncate {
        white-space: nowrap;
        /* Prevents text from wrapping */
        overflow: hidden;
        /* Hides overflowed text */
        text-overflow: ellipsis;
        /* Adds ellipsis (...) */
        max-width: 150px;
        /* Set a maximum width for the cell */
    }
</style>
@endsection

@section('page-title')
Leads
@if ($statusName)
- {{ $statusName }}
@endif
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
                            <div id="bulk-actions" class="d-flex justify-content-start align-items-center">
                                <!-- Delete All Button -->
                                <button id="delete-all" class="btn btn-danger me-1">Delete All</button>

                                <!-- Send Email Form -->
                                <form id="email-form" action="{{ route('emails.index') }}" method="POST" class="me-1">
                                    @csrf
                                    <input type="hidden" name="emails" id="emails-input">
                                    <button type="submit" id="send-email" class="btn btn-info">Send Email</button>
                                </form>
                                <a href="{{ route('leads.export') }}"
                                class="btn btn-warning waves-effect waves-light d-flex align-items-center me-3">
                                    <i class="bi bi-download"></i>
                                    <span>Download Excel</span>
                                </a>
                                <form id="leads-import-form" action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="d-flex align-items-center">
                                        <!-- Hidden file input -->
                                        <input type="file" name="file" id="leads-file-input" class="d-none" accept=".xlsx,.xls,.csv" required>
                                
                                        <!-- Button to trigger file input -->
                                        <button type="button" id="select-file-button" class="btn btn-primary d-flex align-items-center">
                                            <i class="bi bi-upload"></i>
                                            <span>Select and Upload Leads</span>
                                        </button>
                                
                                        <!-- Display selected file name -->
                                        <span id="selected-file-name" class="ms-3"></span>
                                    </div>
                                </form>

                                <!-- Show All Leads Button -->
                                @if ($statusName)
                                <a href="{{ route('leads.index') }}" class="btn btn-secondary">Show All Leads</a>
                                @endif
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
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
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
                                <th>Source</th>
                                 <th>Assignee</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @php
                        // dd($leads) ;
                        @endphp
                        <tbody>
                            @forelse ($uniqueLeads as $lead)
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
                                <td style="text-align: center;">{{ $lead['country_code'] }}{{ $lead['phone'] }}</td>
                                <!--<td class="truncate">{{ $lead['message'] }}</td>-->
                                <td>{{ $lead['source'] }}</td>
                                <td>
                                    <div class="btn-group">
                                        @php
                                            // Find the current assignee based on the assignee ID
                                            $currentAssignee = null;
                                            foreach ($userRoles as $userRole) {
                                                if ($userRole['id'] == $lead['assignee_id']) {
                                                    $currentAssignee = $userRole['name'];
                                                    break; 
                                                }
                                            }
                                            $assigneeName = $currentAssignee ?? 'Unassigned'; 
                                        @endphp
                                
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $assigneeName }} 
                                        </button>
                                        <div class="dropdown-menu">
                                            @foreach ($userRoles as $userRole)
                                                @foreach ($userRole['roles'] as $roleName)
                                                    <a class="dropdown-item change-assignee" href="#"
                                                        data-lead-id="{{ $lead['_id'] }}"
                                                        data-assignee-id="{{ $userRole['id'] }}"
                                                        data-column-name="{{ $userRole['name'] }}">
                                                        {{ $userRole['name'] }}-{{ $roleName }} 
                                                    </a>
                                                @endforeach
                                            @endforeach
                                        </div>
                                        
                                    </div>
                                </td>
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
                                    @can('lead_edit')
                                    <a href="{{ route('leads.edit', $lead['_id']) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    @endcan
                                    @can('lead_delete')
                                    <form action="{{ route('leads.destroy', $lead['_id']) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    @endcan
                                    @can('call_create')
                                    <a class="btn btn-success btn-sm btn-call"
                                        data-phone="{{ $lead['country_code'] }}{{ $lead['phone'] }}"
                                        onclick="makeCall(event, '{{ $lead['country_code'] }}{{ $lead['phone'] }}')">Call</a>
                                    @endcan
                                    @can('lead_message')
                                    <a class="btn btn-info btn-sm btn-sms" data-phone="{{ $lead['country_code'] }}{{ $lead['phone'] }}"
                                        onclick="sendMessage(event, '{{ $lead['country_code'] }}{{ $lead['phone'] }}')">Message</a>
                                    @endcan
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
    <div id="callStatus"></div> <!-- Element to show last call SID -->

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
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Initialize Pusher
    var pusher = new Pusher('ca3024112cfb52d49d71', {
        cluster: 'mt1',
        encrypted: true,
    });

    // Subscribe to the 'calls' channel
    var channel = pusher.subscribe('calls');

    // Bind to the 'CallEnded' event
    channel.bind('CallEnded', function(data) {
        console.log('Received CallEnded event:', data);
        alert('Call has ended. Call SID: ' + data.callSid); // Adjusted to match your PHP naming convention
        stopCallTimer(); // Stop the call timer
        $('#callModal').modal('hide'); 
        $('#callStatus').text('Last Call SID: ' + data.call_sid);
    });

    // Call timer functions
    var callTimerInterval;
    var callStartTime;

    function startCallTimer() {
        callStartTime = new Date(); // Start time
        callTimerInterval = setInterval(updateCallTimer, 1000); // Update every second
    }

    function updateCallTimer() {
        var now = new Date();
        var elapsedTime = Math.floor((now - callStartTime) / 1000); // Calculate elapsed time

        var hours = Math.floor(elapsedTime / 3600);
        var minutes = Math.floor((elapsedTime % 3600) / 60);
        var seconds = elapsedTime % 60;

        var formattedTime =
            (hours < 10 ? '0' : '') + hours + ':' +
            (minutes < 10 ? '0' : '') + minutes + ':' +
            (seconds < 10 ? '0' : '') + seconds;

        $('#callTimer').text(formattedTime); // Update timer display
    }

    function stopCallTimer() {
        clearInterval(callTimerInterval); // Stop the timer
        $('#callTimer').text('00:00:00'); // Reset display
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
                $('#callModal').modal('show');
                startCallTimer();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    $(document).ready(function() {
        $('#endCall').on('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            console.log("Ending call...");
            endCall(); // Call the endCall function
        });

        $('#callModal').on('hidden.bs.modal', function() {
            stopCallTimer(); // Stop the timer
            sessionStorage.removeItem('twilio_call_sid'); // Clear call SID
            console.log("Modal closed and timer stopped."); // Debug log
        });
    });

    function endCall() {
        $('#callModal').modal('hide'); // Hide the modal

        $.post('{{ route('twilio.end-call') }}', {
                _token: '{{ csrf_token() }}'
            },
            function(response) {
                if (response.success) {
                    stopCallTimer(); // Stop the call timer
                    alert(response.message); // Show success message
                } else {
                    alert('Failed to end call: ' + response.message); // Show error message
                }
            }).fail(function(xhr, status, error) {
                console.error('Error ending call:', error); // Log error for debugging
                alert('Error ending call. Please try again.'); // User feedback
            });
    }
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
                // if (checkedCount > 0) {
                //     $('#bulk-actions').show();
                // } else {
                //     $('#bulk-actions').hide();
                // }
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
            // $('#send-email').click(function(e) {
            //     e.preventDefault();
            //     var emails = $('.row-checkbox:checked').closest('tr').find('.email-column').map(function() {
            //         return $(this).text().trim(); // Extract text and trim any extra spaces
            //     }).get();

            //     // Display the collected email addresses in an alert
            //     // alert('Collected Emails: \n' + emails.join('\n'));


            //     $.ajax({
            //         url: '/email-send', // Update with your send email route
            //         type: 'POST',
            //         data: {
            //             _token: '{{ csrf_token() }}',
            //             emails: emails
            //         },
            //        success: function(response) {
            //        // Redirect to the view returned by the server
            //        window.location.href = response.redirect_url;
            //        },
            //         error: function(xhr) {
            //             alert('Error sending emails: ' + xhr.responseJSON.message);
            //         }
            //     });
            // });
            $('#send-email').click(function(e) {
                e.preventDefault();

                var emails = $('.row-checkbox:checked').closest('tr').find('.email-column').map(function() {
                    return $(this).text().trim(); // Extract text and trim any extra spaces
                }).get();

                // Convert emails array to a comma-separated string and set it as the value of the hidden input
                $('#emails-input').val(emails.join(','));

                // Submit the form
                $('#email-form').submit();
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var statusLinks = document.querySelectorAll('.change-assignee');
    
            statusLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    var leadId = this.getAttribute('data-lead-id');
                    var assigneeId = this.getAttribute('data-assignee-id');
                    var columnName = this.getAttribute('data-column-name');
                    var leadRow = this.closest('tr');
                    var statusButton = leadRow.querySelector('.dropdown-toggle');
    
                    // Create the spinner element
                    var spinner = document.createElement('div');
                    spinner.classList.add('spinner-border', 'spinner-border-sm', 'text-warning', 'm-1');
                    spinner.setAttribute('role', 'status');
                    var spinnerText = document.createElement('span');
                    spinnerText.classList.add('sr-only');
                    spinnerText.textContent = 'Loading...';
                    spinner.appendChild(spinnerText);
    
                    // Append the spinner to the button
                    statusButton.appendChild(spinner);
    
                    $.ajax({
                        url: "{{ route('leadboards.update_assignee') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            task_id: leadId,
                            assignee_id: assigneeId, // Change this to use the correct value
                            column_name: columnName
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Lead status updated successfully');
                                statusButton.textContent = columnName + ' ';
                                var icon = document.createElement('i');
                                // icon.classList.add('mdi', 'mdi-chevron-down');
                                statusButton.appendChild(icon);
                            } else {
                                toastr.success('Lead status updated successfully');
                                // Update the status button text without reloading
                                statusButton.textContent = columnName + ' ';
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
        document.getElementById('select-file-button').addEventListener('click', function () {
            // Trigger the hidden file input click
            document.getElementById('leads-file-input').click();
        });
    
        document.getElementById('leads-file-input').addEventListener('change', function () {
            // Get the selected file
            const fileInput = this;
            const fileName = fileInput.files[0] ? fileInput.files[0].name : '';
    
            // Display the file name next to the button
            document.getElementById('selected-file-name').textContent = fileName;
    
            // Automatically submit the form once a file is selected
            if (fileName) {
                document.getElementById('leads-import-form').submit();
            }
        });
    </script>
    @endsection