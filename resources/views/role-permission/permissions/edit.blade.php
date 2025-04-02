@extends('layouts.master')

@section('title')
    Edit Permissions
@endsection

@section('css')

@endsection

@section('page-title')
    Edit Permissions
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')
        <div class="card mt-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="card-title mb-0" style="font-size: 2.1rem;">Edit Permissions</h1>
                @can('permission_create')
                    <a href="{{ url('permissions') }}" class="btn btn-info">Back</a>
                @endcan
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="name" class="form-label">Permission Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $permission->name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="module" class="form-label">Module</label>
                                    <select name="module_name" id="module" class="form-control">
                                        <option value="" selected disabled>Select Module Name</option>
                                        <option value="user" {{ $permission->module_name === 'user' ? 'selected' : '' }}>
                                            User</option>
                                        <option value="role" {{ $permission->module_name === 'role' ? 'selected' : '' }}>
                                            Role</option>
                                        <option value="permission"
                                            {{ $permission->module_name === 'permission' ? 'selected' : '' }}>Permission
                                        </option>
                                        <option value="lead" {{ $permission->module_name === 'lead' ? 'selected' : '' }}>
                                            Lead</option>
                                        <option value="archived"
                                            {{ $permission->module_name === 'archived' ? 'selected' : '' }}>Archived
                                        </option>
                                        <option value="email-template"
                                            {{ $permission->module_name === 'email-template' ? 'selected' : '' }}>Email
                                            Template</option>
                                        <option value="message"
                                            {{ $permission->module_name === 'message' ? 'selected' : '' }}>Message</option>
                                        <option value="call" {{ $permission->module_name === 'call' ? 'selected' : '' }}>
                                            Call</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
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
