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
@endsection

@section('page-title')
    Leads
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')
    <div class="content-wrapper">
        <!-- Add Task Export Buttons Start -->
        <div class="d-grid d-lg-flex d-md-flex action-bar">
            <div id="table-actions" class="flex-grow-1 align-items-center">

            </div>
            <div class="btn-group mt-2 mt-lg-0 mt-md-0 ml-0 ml-lg-3 ml-md-3" role="group">
                <a href="{{ route('leads.index')}}" class="btn btn-secondary f-14 btn-active" data-toggle="tooltip" data-original-title="Table View"><i class="uim uim-grip-horizontal-line"></i></a>
                <a href="{{ route('leadboard')}}" class="btn btn-secondary f-14" data-toggle="tooltip" data-original-title="Lead Status"><i class=" uim uim-columns"></i></a>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $lead)
                                    <tr>
                                        <td style="width: 60px;">
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="row-checkbox" data-ids="{{ $lead['_id'] }}"
                                                    class="tasks-activeCheck2" id="tasks-activeCheck2">
                                                <label class="form-check-label" for="tasks-activeCheck2"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lead['first_name'] }}</td>
                                        <td>{{ $lead['last_name'] }}</td>
                                        <td>{{ $lead['email'] }}</td>
                                        <td>{{ $lead['phone'] }}</td>
                                        <td>{{ $lead['message'] }}</td>
                                        <td>{{ $lead['source'] }}</td>
                                        <td>
                                            <a href="{{ route('leads.edit', $lead['_id']) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('leads.destroy', $lead['_id']) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            <a class="btn btn-success btn-sm btn-call" data-phone="{{ $lead['phone'] }}"
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
    @endsection
