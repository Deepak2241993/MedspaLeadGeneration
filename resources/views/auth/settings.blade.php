@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('page-title')
    Profile
@endsection
@section('css')
    <style>
        .badge {
    font-size: 1rem;
    font-weight: 600;
}

.bg-info {
    background-color: #17a2b8 !important;
    border: 1px solid #17a2b8;
}

.text-dark {
    color: #343a40 !important;
}

    </style>
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-cogs"></i> Change Password
                    </div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
    
                            <div class="mb-3">
                                <label for="current-password" class="form-label">
                                    Current Password
                                </label>
                                <input type="password" id="current-password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                                @error('current_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="new-password" class="form-label">
                                    New Password
                                </label>
                                <input type="password" id="new-password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>
                                @error('new_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="new-password-confirm" class="form-label">
                                    Confirm New Password
                                </label>
                                <input type="password" id="new-password-confirm" class="form-control" name="new_password_confirmation" required>
                            </div>
    
                            <button type="submit" class="btn btn-primary">
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <!-- end row -->
    @endsection
    @section('scripts')
        <!-- Include Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
