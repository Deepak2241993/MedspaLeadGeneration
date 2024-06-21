@extends('admin.layouts.app')

@php
    $pageTitle = "Make a Call";
@endphp

@section('content')
<div class="container-fluid">
    <h1>Make a Call</h1>

    <form method="POST" action="{{ route('admin.call.make.post') }}">
        @csrf
        <label for="recipient_number">Recipient Number:</label><br>
        <input type="text" id="recipient_number" name="recipient_number" required><br><br>
        <button type="submit" class="btn btn-primary">Call</button>
    </form>

    <!-- Call Cut and Hold Buttons -->
    <div id="callControl" style="display: none;">
        <button type="button" class="btn btn-danger" id="cutCall">Cut Call</button>
        <button type="button" class="btn btn-warning" id="holdCall">Hold Call</button>
    </div>
</div>

<!-- JavaScript to handle button actions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('cutCall').addEventListener('click', function() {
            cutCall();
        });

        document.getElementById('holdCall').addEventListener('click', function() {
            holdCall();
        });
    });

    function cutCall() {
        // Call SID should be dynamically retrieved after the call is made
        let callSid = 'YOUR_CALL_SID'; // Replace this with the actual call SID
        fetch(`/twilio/hangup-call/${callSid}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert('Call cut!');
        })
        .catch(error => console.error('Error:', error));
    }

    function holdCall() {
        // Call SID should be dynamically retrieved after the call is made
        let callSid = 'YOUR_CALL_SID'; // Replace this with the actual call SID
        fetch(`/twilio/hold-call/${callSid}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert('Call on hold!');
        })
        .catch(error => console.error('Error:', error));
    }
</script>

@endsection
