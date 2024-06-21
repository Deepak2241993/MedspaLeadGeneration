@extends('admin.layouts.app')

@php
    $pageTitle = 'Leads';
@endphp

@section('content')
    <div class="content-wrapper">
        {{-- <form method="POST" action="{{ route('admin.emails.index') }}" id="myFormEmailSend"> --}}
            {{-- @csrf --}}
            <input type="hidden" name="selectedIds[]" id="selectedIds">
            <div class="d-grid d-lg-flex d-md-flex action-bar">
                <div id="table-actions" class="flex-grow-1 align-items-center">
                    <button class="btn btn-danger btn-delete-selected" style="display:none;">Delete Selected</button>
                    <button class="btn btn-success btn-send-emails" style="display:none;">Send Emails</button>
                </div>
                <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                    <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary f-14 btn-active"
                        data-toggle="tooltip" data-original-title="Table View"><i class="side-icon bi bi-list-ul"></i></a>
                    <a href="{{ route('admin.leadboard') }}" class="btn btn-secondary f-14" data-toggle="tooltip"
                        data-original-title="Lead Status"><i class="side-icon bi bi-kanban"></i></a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <!-- Add this div where you want to display the success message -->
            <div id="success-message" style="display: none;" class="alert alert-success">
                <!-- Success message will be displayed here -->
            </div>

            <div class="d-flex flex-column w-tables rounded mt-3 bg-white table-responsive">
                <div id="leads-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"></div>

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover data-table border-0 w-100 dataTable no-footer" id="leads-table"
                            role="grid" aria-describedby="leads-table_info" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>Sr No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone No.</th>
                                    <th>Text</th>
                                    <th>Source</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{-- </form> --}}
    </div>
    <div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="callModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="callModalLabel">Call in Progress</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Call Time: <span id="callTimer">00:00</span></p>
                    <div class="d-flex justify-content-around">
                        <button id="endCall" class="btn btn-danger">End Call</button>
                        <button id="muteCall" class="btn btn-warning">Mute</button>
                        <button id="holdCall" class="btn btn-info">Hold</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        @include('admin.sections.datatable_js')

        <script>
            $(document).ready(function() {
                var table = $(".data-table").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.leads.index') }}",
                    columns: [{
                            data: 'checkbox',
                            name: 'checkbox',
                            orderable: false,
                            searchable: false,
                            width: '5%',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                return '<input type="checkbox" class="row-checkbox" data-id="' + full
                                    .id + '" data-email="' + full.email + '">';
                            }
                        },
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            width: '5%'
                        },
                        {
                            data: 'first_name',
                            name: 'first_name'
                        },
                        {
                            data: 'last_name',
                            name: 'last_name'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            className: 'email-column'
                        },
                        {
                            data: 'phone',
                            name: 'phone'
                        },
                        {
                            data: 'message',
                            name: 'message'
                        },
                        {
                            data: 'source',
                            name: 'source'
                        },
                        // {"data":"status","name":"status","title":"Status","orderable":true,"searchable":true},
                        // { data: 'mobile', name: 'mobile' },
                        {
                            data: 'action',
                            name: 'action',
                            width: '20%'
                        },
                    ],
                    Searching: true,
                    lengthChange: false,
                });

                // Check all functionality
                $('#check-all').click(function() {
                    $('.row-checkbox').prop('checked', this.checked);
                    toggleButtonVisibility();
                });

                // Individual checkbox selection
                $('.data-table').on('click', '.row-checkbox', function() {
                    toggleButtonVisibility();
                });

                // Delete Selected functionality
                $('.btn-delete-selected').click(function() {
                    var selectedIds = getSelectedIds();

                    // Check if any item is selected
                    if (selectedIds.length > 0) {
                        // Ask for confirmation before deleting
                        if (confirm('Are you sure you want to delete selected records?')) {
                            deleteSelectedRecords(selectedIds);
                        }
                    } else {
                        alert('Please select at least one record to delete.');
                    }
                });
                $(document).ready(function() {
                    $('.data-table').on('click', '.delete', function() {
                        var id = $(this).data('id');
                        var url = '/admin/lead/' +
                            id; // Adjust this URL based on your route setup

                        // Ask for confirmation before deleting
                        if (confirm('Are you sure you want to delete this Email Template?')) {
                            var deleteBtn = $(this); // Reference to the delete button

                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    console.log(response.message);
                                    // Assuming you want to remove the row from the DataTable
                                    var table = $('.data-table').DataTable();
                                    table.row(deleteBtn.closest('tr')).remove().draw(false);
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        }
                    });
                });

                // Function to toggle button visibility based on selected checkboxes
                function toggleButtonVisibility() {
                    var selectedCheckboxCount = $('.row-checkbox:checked').length;
                    if (selectedCheckboxCount >= 0) {
                        $('.btn-delete-selected, .btn-send-emails').show();
                    } else {
                        $('.btn-delete-selected, .btn-send-emails').hide();
                    }
                }

                // Function to get the IDs of selected checkboxes
                function getSelectedIds() {
                    var selectedIds = [];
                    $('.row-checkbox:checked').each(function() {
                        selectedIds.push($(this).closest('tr').find('.delete').data('id'));
                    });
                    return selectedIds;
                }

                // Function to delete selected records
                function deleteSelectedRecords(ids) {
                    $.ajax({
                        url: '{{ route('admin.leads.deleteAll') }}',
                        type: 'POST',
                        data: {
                            ids: ids,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response.message);
                            // Assuming you want to reload the page or update the table
                            // location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }

            });
        </script>
        {{-- <script>
            $("form").submit(function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Collect selected checkbox IDs
                var selectedIds = [];
                $("input[type='checkbox']:checked").each(function() {
                    selectedIds.push($(this).closest('tr').find('.row-checkbox').data('id'));
                });
                var filteredArray = selectedIds.filter(function(element) {
                    return element !== undefined;
                });

                // console.log(filteredArray);
                // Set the value of the hidden input field
                $("#selectedIds").val(filteredArray.join(','));

                // Submit the form directly using the form's submit method
                document.getElementById("myFormEmailSend").submit();
            });
        </script> --}}

      

        {{-- <script>
            $(document).ready(function() {
                $(document).on('click', '.btn-make-call', function() {
                    var id = $(this).data('id');
                    var number = $(this).data('number');
                    $.ajax({
                        url: '{{ route("admin.twilio.makeCall") }}',
                        method: 'get',
                        data: {
                            id: id,
                            number: number,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Handle success
                            alert('Call initiated successfully.');
                        },
                        error: function(xhr) {
                            // Handle error
                            alert('Error initiating call: ' + xhr.responseText);
                        }
                    });
                });
            });
            </script> --}}

            {{-- <script>
                $(document).ready(function() {
                    var timerInterval;

                    function startCallTimer() {
                        var startTime = new Date().getTime();

                        timerInterval = setInterval(function() {
                            var currentTime = new Date().getTime();
                            var elapsedTime = currentTime - startTime;

                            var minutes = Math.floor(elapsedTime / (1000 * 60));
                            var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

                            if (seconds < 10) {
                                seconds = "0" + seconds;
                            }

                            $('#callTimer').text(minutes + ":" + seconds);
                        }, 1000);
                    }

                    function stopCallTimer() {
                        clearInterval(timerInterval);
                        $('#callTimer').text("00:00");
                    }

                    $(document).on('click', '.btn-make-call', function() {
                        var id = $(this).data('id');
                        var number = $(this).data('number');

                        $.ajax({
                            url: '{{ route("admin.twilio.makeCall") }}',
                            method: 'GET',
                            data: {
                                id: id,
                                number: number,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                // Handle success
                                $('#callModal').modal('show');
                                startCallTimer();
                            },
                            error: function(xhr) {
                                // Handle error
                                alert('Error initiating call: ' + xhr.responseText);
                            }
                        });
                    });

                    $('#endCall').on('click', function() {
                        stopCallTimer();
                        $('#callModal').modal('hide');
                        // Add logic to end the call
                    });

                    $('#muteCall').on('click', function() {
                        // Add logic to mute the call
                    });

                    $('#holdCall').on('click', function() {
                        // Add logic to hold the call
                    });
                });
                </script> --}}
                <script>
                    $(document).ready(function() {
                        var timerInterval;
                        var currentCallSid;

                        function startCallTimer() {
                            var startTime = new Date().getTime();

                            timerInterval = setInterval(function() {
                                var currentTime = new Date().getTime();
                                var elapsedTime = currentTime - startTime;

                                var minutes = Math.floor(elapsedTime / (1000 * 60));
                                var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

                                if (seconds < 10) {
                                    seconds = "0" + seconds;
                                }

                                $('#callTimer').text(minutes + ":" + seconds);
                            }, 1000);
                        }

                        function stopCallTimer() {
                            clearInterval(timerInterval);
                            $('#callTimer').text("00:00");
                        }

                        $(document).on('click', '.btn-make-call', function() {
                            var id = $(this).data('id');
                            var number = $(this).data('number');

                            $.ajax({
                                url: '{{ route("admin.twilio.makeCall") }}',
                                method: 'GET',
                                data: {
                                    id: id,
                                    number: number,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    // Assuming the response contains the call SID
                                    currentCallSid = response.callSid;
                                    $('#callModal').modal('show');
                                    startCallTimer();
                                },
                                error: function(xhr) {
                                    alert('Error initiating call: ' + xhr.responseText);
                                }
                            });
                        });

                        $('#endCall').on('click', function() {
                            stopCallTimer();
                            $.ajax({
                                url: '{{ route("admin.twilio.endCall") }}',
                                method: 'POST',
                                data: {
                                    callSid: currentCallSid,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    alert('Call ended successfully.');
                                    $('#callModal').modal('hide');
                                },
                                error: function(xhr) {
                                    alert('Error ending call: ' + xhr.responseText);
                                }
                            });
                        });

                        $('#muteCall').on('click', function() {
                            $.ajax({
                                url: '{{ route("admin.twilio.muteCall") }}',
                                method: 'POST',
                                data: {
                                    callSid: currentCallSid,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    alert('Call muted successfully.');
                                },
                                error: function(xhr) {
                                    alert('Error muting call: ' + xhr.responseText);
                                }
                            });
                        });

                        $('#holdCall').on('click', function() {
                            $.ajax({
                                url: '{{ route("admin.twilio.holdCall") }}',
                                method: 'POST',
                                data: {
                                    callSid: currentCallSid,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    alert('Call held successfully.');
                                },
                                error: function(xhr) {
                                    alert('Error holding call: ' + xhr.responseText);
                                }
                            });
                        });
                    });
                    </script>


    @endpush
@endsection