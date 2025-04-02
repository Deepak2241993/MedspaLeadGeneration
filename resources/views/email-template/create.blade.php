@extends('layouts.master')

@section('title', 'Create Email Template')

@section('page-title', 'Create Email Template')

@section('body')
<body data-sidebar="colored">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-left mb-3">
                        <a href="{{ route('email.index') }}" class="btn btn-primary btn-back">Back</a>
                    </div>
                    
                    @if ($message = Session::get('imperialheaders_success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                  <form action="{{ route('email.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="floatingTitleInput" name="title" placeholder="Enter the title">
                                        <label for="floatingTitleInput">Title</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" name="status" id="floatingStatusSelect" aria-label="Status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <label for="floatingStatusSelect">Status</label>
                                    </div>
                                </div>
                            </div>

                    <div class="mb-4">
                                <label for="htmlcode" class="form-label">
                                    Create Template <span class="text-danger">*</span>
                                </label>
                                <textarea name="html_code" id="summernote" cols="30" rows="10" class="form-control" placeholder="Enter HTML code here"></textarea>
                            </div>
                    <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    

    <!-- init js -->
    <script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>
    
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
    // Initialize Summernote
    $('#summernote').summernote({
        height: 300,   // Set editor height
        minHeight: null, // Set minimum height of editor
        maxHeight: null, // Set maximum height of editor
        focus: true    // Set focus to editable area after initializing summernote
    });

    // Ensure the content is synced with the textarea on form submission
    $('form').on('submit', function() {
        // Synchronize the content of Summernote with the textarea
        $('#summernote').val($('#summernote').summernote('code'));
    });
});

    </script>
@endsection
