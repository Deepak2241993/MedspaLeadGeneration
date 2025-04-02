@extends('layouts.master')

@section('title')
    Role And Permission
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('build/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('build/libs/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ URL::asset('build/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
        rel="stylesheet" type="text/css" />
@endsection

@section('page-title')
    Create Permission
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')
    <div class="card mt-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h1 class="card-title mb-0" style="font-size: 2.1rem;">Create Permission</h1>
                <a href="{{ url('permissions') }}" class="btn btn-info">Back</a>
        </div>
    </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                            <form action="{{ route('permissions.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="module">Module</label>
                                            <select name="module" id="module" class="form-select" required>
                                                <option selected disabled>Select Module Name</option>
                                                <option value="user">User</option>
                                                <option value="role">Role</option>
                                                <option value="permission">Permission</option>
                                                <option value="lead">Lead</option>
                                                <option value="archived">Archived</option>
                                                <option value="email-template">Email Template</option>
                                                <option value="message">Message</option>
                                                <option value="call">Call</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Permission Name</label>
                                            <select name="permissions[]" id="name" class="form-select" multiple required>
                                                <option value="view">List/View</option>
                                                <option value="create">Create</option>
                                                <option value="edit">Edit</option>
                                                <option value="delete">Delete</option>
                                                <option value="message">Message</option>
                                                <option value="call">Call</option>
                                                <option value="restore">Restore</option>
                                                {{-- <option value="permissiontorole">Permission To Role</option> --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                            
                        
                    </div>
                </div>
            </div>
        @endsection

        @section('scripts')
            
            <!-- App js -->
            <script src="{{ URL::asset('build/js/app.js') }}"></script>
        @endsection
