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
            .permissions-container {
                display: flex;
                flex-wrap: wrap; /* Allows items to wrap to the next line if necessary */
                gap: 10px; /* Adds space between items */
            }
            .form-check {
                display: flex;
                align-items: center;
                margin-right: 20px; /* Optional: Adds space between each checkbox */
            }
            .form-check-input {
                margin-right: 5px; /* Space between checkbox and label */
            }
        </style>
        
@endsection

@section('page-title')
    Role
@endsection

@section('body')

    <body data-sidebar="colored">
    @endsection

    @section('content')
    <div class="container mt-5">
        <h1>Role:- {{ $role->name }} 
            <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
        </h1>
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
           
            <div class="mb-3">
                <label for="permissions" class="form-label">Permissions</label>
                <div class="permissions-container">
                    @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}" {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>            
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        
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
