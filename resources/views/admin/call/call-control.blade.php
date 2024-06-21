@extends('admin.layouts.app')

@php
    $pageTitle = "Call Control";
@endphp

@section('content')
<div class="container-fluid">
    <h1>Call Control</h1>
    <p>Call SID: {{ $callSid }}</p>

    <div id="callControl">
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
        let callSid = '{{ $callSid }}';
        fetch(`admin/twilio/hangup-call/${callSid}`, {
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
        let callSid = '{{ $callSid }}';
        fetch(`admin/twilio/hold-call/${callSid}`, {
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
