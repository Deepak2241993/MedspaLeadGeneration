@extends('layouts.master')
@section('title')
    Lead Edit
@endsection
@section('page-title')
    Edited Lead
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
                            
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 float-end">
                                <a href="{{ route('leads.index') }}" class="btn btn-primary" >
                                    <i class="fas fa-arrow-left"></i> 
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                    <form action="{{ route('leads.update', $lead['_id']) }}" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row mb-3">
                            <label for="first-name" class="col-sm-2 col-form-label">First Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="First Name" id="first-name" name="first_name" value="{{ $lead['first_name'] }}">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="last-name" class="col-sm-2 col-form-label">Last Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Last Name" id="last-name" name="last_name" value="{{ $lead['last_name'] }}">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="email-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" placeholder="bootstrap@example.com" id="email-input" name="email" value="{{ $lead['email'] }}">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="tel" placeholder="Phone Number" id="phone" name="phone" value="{{ $lead['phone'] }}">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">Text</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Text" id="text" name="message" value="{{ $lead['message'] }}">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="source" class="col-sm-2 col-form-label">Source</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Source" id="source" name="source" value="{{ $lead['source'] }}">
                                <input type="hidden" name="_id" value="{{$lead['_id'] }}">
                                <div id="messageError" class="error-message"></div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Update Lead</button>
                            </div>
                        </div>
                        <!-- end row -->

                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@section('scripts')
    <!-- bs custom file input plugin -->
    <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
