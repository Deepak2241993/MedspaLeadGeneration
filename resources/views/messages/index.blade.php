<!-- resources/views/messages/index.blade.php -->
@extends('admin.layouts.app')

@php
    $pageTitle = 'Massage Dashboard';
@endphp



@section('content')
    <h1>Messages</h1>
    <ul>
        @foreach($messages as $message)
            <li>{{ $message->content }}</li>
            <a href="">View</a>
            <a href="">Edit</a>
            <form action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        @endforeach
    </ul>
@endsection
