@extends('layouts.master')

@section('title')
    Create Role
@endsection

@section('css')
    <!-- Tagify CSS for comma-separated phone numbers -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.5/tagify.css" rel="stylesheet" integrity="sha384-EhxHf/5eV+8f2uM15W8s4VzJ5/U47b4df9V73wrc76B6p/BVCjs8K3OJlX7L0Sp+" crossorigin="anonymous">
@endsection

@section('page-title')
    Create Role
@endsection

@section('body')

    <body data-sidebar="colored">
@endsection

@section('content')
    <div class="card mt-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h1 class="card-title mb-0" style="font-size: 2.1rem;">Create Role</h1>
            @can('role_create')
                <a href="{{ url('roles') }}" class="btn btn-danger float-end">Back</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ route('roles.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <!-- Phone Numbers Input Field -->
                            <div class="mb-3">
                                <label for="phone_numbers" class="form-label">Phone Numbers (comma-separated)</label>
                                <input type="text" class="form-control" id="phone_numbers" name="phone_numbers" placeholder="e.g., +918077477522, +918077477523">
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
    <!-- Tagify JS for comma-separated input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.9.5/tagify.min.js" integrity="sha384-QRd/ZKkxAlv0GphMgt3otVofLhJwRekEri+N+eJKd93HPDY0+Qu/9wBv3FtzObeN" crossorigin="anonymous"></script>
    <script>
        // Initialize Tagify on the phone numbers input
        var input = document.querySelector('#phone_numbers');
        new Tagify(input, {
            whitelist: [],  // Can add a custom list of phone numbers if needed
            delimiters: ",",  // Ensure the input is comma separated
            maxTags: 5  // Optional: Limit number of phone numbers
        });
    </script>
@endsection
