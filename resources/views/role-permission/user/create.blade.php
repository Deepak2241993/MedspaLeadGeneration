@extends('layouts.master')

@section('title')
    Add New User
@endsection

@section('css')
@endsection

@section('page-title')
    Add New User
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')
        <div class="card mt-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="card-title mb-0" style="font-size: 2.1rem;">Add New User</h1>
                <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            {{-- Display validation errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="roles" class="form-label">Role</label>
                                    <select name="roles[]" class="form-control" multiple id="roles">
                                        <option value="" disabled>Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}" {{ in_array($role, old('roles', [])) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
