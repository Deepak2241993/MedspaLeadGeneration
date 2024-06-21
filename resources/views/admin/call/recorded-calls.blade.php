@extends('admin.layouts.app')

@php
    $pageTitle = "Recorded Calls";
@endphp

@section('content')
    <div class="container-fluid">
        <h1>Recorded Calls</h1>

        @foreach ($recordedCalls as $call)
            <div>
                <p>From: {{ $call->from }}</p>
                <p>To: {{ $call->to }}</p>
                <p>Duration: {{ $call->duration }} seconds</p>
                <p>Recording Status: {{ $call->recordings->isEmpty() ? 'Not Recorded' : 'Recorded' }}</p>
                @foreach ($call->recordings->toArray() as $recording)
                    <p>Recording Duration: {{ $recording->duration }} seconds</p>
                    <p>Recording URL: <a href="{{ $recording->uri }}">{{ $recording->uri }}</a></p>
                @endforeach
            </div>
            <hr>
        @endforeach
    </div>
@endsection
