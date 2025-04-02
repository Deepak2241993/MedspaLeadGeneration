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
            right: 35px;
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
                <h1 class="card-title mb-0" style="font-size: 2.1rem;">Permissions</h1>
                @can('permission_create')
                    <a href="{{ route('permissions.create') }}" class="btn btn-info">Create Permissions</a>
                @endcan
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if ($permissions->isEmpty())
                            <p>No permissions found.</p>
                        @else
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                {{-- <th><input type="checkbox" id="check-all"></th> --}}
                                <th>Sr No.</th>
                                <th>Module</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $index => $permission)
                                <tr>
                                    {{-- <td style="width: 60px;">
                                        <div class="form-check font-size-16 text-center">
                                            <input type="checkbox" class="row-checkbox" data-ids="{{ $permission->id }}" id="checkbox-{{ $permission->id }}">
                                            <label class="form-check-label" for="checkbox-{{ $permission->id }}"></label>
                                        </div>
                                    </td> --}}
                                    <td>{{ $loop->iteration }}</td> <!-- Serial number column -->
                                    <td>{{ $permission->module_name }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @can('permission_edit')
                                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        @endcan
                                        @can('permission_delete')
                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this permission?')">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No data found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    </div>
                </div>
            </div>
        </div>
        @endif
        </div>
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
    @endsection
