@extends('layouts.master')

@section('title', 'Form Editor')

@section('page-title', 'Form Editor')

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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingFirstnameInput" name="title" placeholder="Enter Your First Name">
                                <label for="floatingFirstnameInput">Title</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="status" id="floatingSelectGrid" aria-label="Floating label select example">
                                    <option value="1">Active</option>
                                    <option value="0">In-Active</option>
                                </select>
                                <label for="floatingSelectGrid">Status</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label for="htmlcode" class="f-14 text-dark-grey">
                                Create Template<sub class="f-14 mr-1">*</sub>
                            </label>
                            <textarea name="html_code" id="summernote" cols="30" rows="10" class="summernote" placeholder="html_code"></textarea>

                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
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
