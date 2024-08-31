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
                    @php
                        dd($emailtemp);
                    @endphp
                    <form action="{{ route('email.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingFirstnameInput" name="title" value="{{ $emailtemp->title }}" placeholder="Enter Your First Name">
                                <label for="floatingFirstnameInput">Title</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select" name="status" id="floatingSelectGrid" aria-label="Floating label select example">
                                    <option value="1" {{ $emailtemp->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $emailtemp->status == 0 ? 'selected' : '' }}>In-Active</option>
                                </select>
                                <label for="floatingSelectGrid">Status</label>
                            </div>
                        </div>
                    </div>

                    <textarea id="elm1" name="area">{{ $emailtemp->html_code }}</textarea>
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@section('scripts')
    <!--tinymce js-->
    <script src="{{ URL::asset('build/libs/tinymce/tinymce.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>
    
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection