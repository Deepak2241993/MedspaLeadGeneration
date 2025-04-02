@extends('layouts.master')

@section('title')
    Give Permissions
@endsection

@section('css')
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
    
    <!-- Custom Styles -->
    <style>
        .permissions-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* Space between items */
        }

        .permissions-container .module {
            flex: 1 1 calc(33.333% - 15px); /* Adjust flex-basis to fit 3 items per row with gap */
            box-sizing: border-box;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 1rem;
            margin-bottom: 1rem;
            transition: box-shadow 0.3s ease;
            background-color: #f9f9f9;
        }

        .permissions-container .module:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .module-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .module-header h5 {
            margin: 0;
            font-size: 1.5rem; /* Adjust font size as needed */
            font-weight: bold;
        }

        .select-all-buttons {
            display: flex;
            gap: 10px; /* Space between buttons */
        }

        .select-all-buttons .btn {
            cursor: pointer;
            font-size: 0.875rem; /* Slightly smaller font size for buttons */
        }

        .permissions-container .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .permissions-container .form-check-input {
            margin-right: 10px;
        }

        .permissions-container .form-check-label {
            font-size: 1rem;
        }

        .btn-confirm {
            background-color: #28a745;
            color: white;
        }

        .btn-confirm:hover {
            background-color: #218838;
        }

        .alert {
            margin-top: 1rem;
        }

        @media (max-width: 768px) {
            .permissions-container .module {
                flex: 1 1 100%; /* Full width on smaller screens */
            }
        }
    </style>
@endsection

@section('page-title')
    Give Permissions
@endsection

@section('body')
<body data-sidebar="colored">
@endsection

@section('content')
    <div class="container mt-5">
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

        <div class="card">
            <div class="card-header">
                <h1>{{ $role->name }} <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a></h1>
            </div>
            <div class="card-body">
                <form id="permissions-form" action="{{ route('roles.moduleUpdate', $role->id) }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}

                    <div class="mb-3">
                        <div class="permissions-container">
                            @foreach ($permissions->groupBy('module_name') as $moduleName => $modulePermissions)
                                <div class="module" data-module="{{ $moduleName }}">
                                    <div class="module-header">
                                        <h5>{{ ucfirst($moduleName) }}</h5>
                                        <div class="select-all-buttons">
                                            <button type="button" class="btn btn-outline-primary select-all" data-action="select" title="Select all permissions">Select All</button>
                                            <button type="button" class="btn btn-outline-secondary select-all" data-action="deselect" title="Deselect all permissions">Deselect All</button>
                                        </div>
                                    </div>
                                    @foreach ($modulePermissions as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input permission-checkbox" type="checkbox" name="permissions[]"
                                                value="{{ $permission->name }}" id="permission-{{ $permission->id }}"
                                                {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                {{ ucfirst($permission->name) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-primary" id="save-btn">Save All</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.select-all').forEach(button => {
                button.addEventListener('click', () => {
                    const action = button.getAttribute('data-action');
                    const moduleName = button.closest('.module').getAttribute('data-module');
                    
                    document.querySelectorAll(`.module[data-module="${moduleName}"] .permission-checkbox`).forEach(checkbox => {
                        checkbox.checked = action === 'select';
                    });
                });
            });

            document.getElementById('save-btn').addEventListener('click', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to save these changes?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, save it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('permissions-form').submit();
                    }
                });
            });
        });
    </script>
@endsection
