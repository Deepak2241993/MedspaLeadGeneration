@extends('layouts.master')

@section('title')
    Role And Permissions
@endsection

@section('css')
    <style>
        /* Base button styles */
        .btn {
            position: relative;
            display: inline-flex;
            align-items: center;
            padding-right: 30px;
            /* Space for the arrow */
        }

        /* Active button styling */
        .active-btn {
            background-color: #343a40;
            /* Change to your theme color */
            color: #fff;
            border-color: #343a40;
            /* Ensure border matches */
        }

        /* Arrow indicator styles */
        .btn.active-btn .arrow-icon {
            position: absolute;
            right: 11px;
            /* Adjust as needed */
            top: 122%;
            transform: translateY(-50%);
            font-size: 40px;
            /* Adjust size as needed */
            color: #000000;
            /* Change color to match your button text color */
        }
    </style>
@endsection

@section('page-title')
    Roles And Permissions
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')
        @include('role-permission.nav-links')
        <div class="card mt-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="card-title mb-0" style="font-size: 2.1rem;">Roles</h1>
                @can('role_create')
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">Add Role</a>
                @endcan
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $role->name }}
                                        </td>
                                        @if ($role->name !== 'Super Admin' || auth()->user()->hasRole('Super Admin'))
                                            <td>
                                                @can('role_permissiontorole')
                                                    <a href="{{ route('roles.give-permissions', ['role' => $role->id]) }}" class="btn btn-info">Modules Permissions</a>
                                                @endcan
                                                @can('role_edit')
                                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                                                @endcan
                                                @can('role_delete')
                                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline-block delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                @endcan
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Find all alert messages
                var alerts = document.querySelectorAll('.alert');

                // Loop through each alert
                alerts.forEach(function(alert) {
                    // Set a timeout to remove the alert after 2 seconds (2000 milliseconds)
                    setTimeout(function() {
                        var bootstrapAlert = new bootstrap.Alert(alert);
                        bootstrapAlert.close();
                    }, 2000);
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.delete-form').forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        Swal.fire({
                            title: 'Are you sure?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endsection
