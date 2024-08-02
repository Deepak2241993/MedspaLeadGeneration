@php
    $moveClass = ($draggable == 'true') ? 'move-disable' : '';
@endphp

<div class="card rounded bg-white border-grey b-shadow-4 m-1 mb-2 task-card "
data-task-id="{{ $lead['_id'] }}" id="drag-task-{{ $lead['_id'] }}">
    <div class="card-body p-2">
        <div class="d-flex justify-content-between mb-2">
            <a href="#" class="f-12 f-w-500 text-dark mb-0 text-wrap openRightModal">{{ $lead['first_name'] }}
                {{ $lead['last_name'] }}

                @if (!empty($lead['status_id']))
                    <i class="fa fa-check-circle text-success" data-toggle="tooltip"
                        data-original-title="convertedClient"></i>
                @endif

            </a>
            <div class="d-flex mb-3 align-items-center">
                <a class="mdi-file-phone text-lightest btn btn-success btn-sm btn-call" data-phone="{{ $lead['phone'] }}"
                                                onclick="makeCall(event, '{{ $lead['phone'] }}')"></a>
                {{-- <i class="fa fa-phone f-11 text-lightest"></i><span
                    class="ml-2 f-11 text-lightest">{{ $lead['phone'] }}</span> --}}
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            @if (!empty($lead['email']))
            <div class="d-flex flex-wrap">
                <div class="">
                    {{ $lead['email'] }}
                </div>
            </div>
        @endif

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

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js"></script>

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

        var url = "{{ route('make-call') }}";

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
