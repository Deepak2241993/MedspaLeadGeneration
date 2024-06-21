@extends('admin.layouts.app')

@php
    $pageTitle = 'Edit Email Template';
@endphp
@include('admin.sections.leadboad_css')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="card-header py-2">
            <h1 class="h3 mb-2 text-gray-800">Update {{ $emailtemp->title }} Email Template</h1>
        </div>
        <div class="card shadow mb-4">
            {{-- <div class="card-header py-3">
           <h6 class="m-0 font-weight-bold text-primary">Create Email Template</h6>
       </div> --}}
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <a href="{{ route('admin.email.index') }}" class="btn btn-primary btn-back">Back</a>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.email.update', $emailtemp->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row p-20">
                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group my-3">
                                                <label for="" class="f-14 text-daek-grey">Title <sub
                                                        class="f-14 mr-1">*</sub> </label>
                                                <input type="text" name="title" class="form-control"
                                                    placeholder="Title" value="{{ $emailtemp->title }}">
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="" class="f-14 text-daek-grey ">Create Template<sub
                                                    class="f-14 mr-1">*</sub> </label>
                                            <textarea id="summernote" name="html_code">{{ $emailtemp->html_code }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 mt-2">
                                            <div class="form-group">
                                                <label for="" class="f-14 text-dark-grey">Status<sub
                                                        class="f-14 mr-1">*</sub> </label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ $emailtemp->status == 1 ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0" {{ $emailtemp->status == 0 ? 'selected' : '' }}>
                                                        In-Active</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
