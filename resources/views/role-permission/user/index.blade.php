@extends('layouts.master')

@section('title')
    Users
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
    Users
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')
        @include('role-permission.nav-links')
        <div class="card mt-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h1 class="card-title mb-0" style="font-size: 2.1rem;">Users</h1>
                @can('permission_create')
                    <a href="{{ url('users/create') }}" class="btn btn-warning float-end">Add New User</a>
                @endcan
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>Sr No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $lead)
                                    <tr>
                                        <td style="width: 60px;">
                                            <div class="form-check font-size-16 text-center">
                                                <input type="checkbox" class="row-checkbox" data-ids="{{ $lead['_id'] }}"
                                                    class="tasks-activeCheck2" id="tasks-activeCheck2">
                                                <label class="form-check-label" for="tasks-activeCheck2"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lead->name }}</td>
                                        <td>{{ $lead->email }}</td>
                                        <td>
                                            @if (!empty($lead->getRoleNames()))
                                                @foreach ($lead->getRoleNames() as $rolename)
                                                    @if ($rolename === 'Role Not Define')
                                                        <label class="badge bg-danger mx-1">{{ $rolename }}</label>
                                                    @else
                                                        <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </td>


                                        <td>
                                            <a href="{{ url('users/' . $lead->id . '/edit') }}"
                                                class="btn btn-sm btn-info">Edit</a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger"
                                                onclick="confirmDelete({{ $lead->id }})">Delete</a>


                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">No data found.</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    @endsection

    @section('scripts')
        <!-- Required datatable js -->
        <script src="{{ URL::asset('build/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/jszip/jszip.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/pdfmake.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/pdfmake/build/vfs_fonts.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

        <script src="{{ URL::asset('build/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

        <!-- Responsive examples -->
        <script src="{{ URL::asset('build/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ URL::asset('build/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

        <!-- Datatable init js -->
        <script src="{{ URL::asset('build/js/pages/datatables.init.js') }}"></script>
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
            function confirmDelete(userId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the delete route
                        window.location.href = '/users/' + userId + '/delete';
                    }
                });
            }
        </script>
    @endsection
