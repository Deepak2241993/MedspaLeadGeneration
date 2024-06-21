@extends('admin.layouts.app')

@php
    $pageTitle = 'Send Message';
@endphp

@section('content')
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <h2 class="text-center mb-4">Bootstrap Form</h2>
                    @if($success = \Session::get('success'))
                        <div class="alert alert-success">{{ $success }}</div>                        
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.massageSubmitForm')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="number">Number:</label>
                            <input type="text" class="form-control" id="number" name="number" placeholder="Enter a number">
                        </div>
                        <div class="form-group">
                            <label for="message">Text Message:</label>
                            <input type="text" class="form-control" id="message" name="message" placeholder="Enter a text message">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
@endsection