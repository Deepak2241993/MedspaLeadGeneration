@extends('layouts.master')

@php
    $pageTitle = 'Send Email';
@endphp
@section('content')
<body data-sidebar="colored">
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="card-header py-2">
        <h1 class="h3 mb-2 text-gray-800">Send Email Template</h1>
    </div>
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary">Create Email Template</h6>
   </div> --}}
        <div class="card-body">
            <div class="row">
                <div class="w-100 border-top-grey d-block justify-content-start px-4 py-3 text-right">
                    <a href="{{ route('email.index') }}" class="btn btn-primary btn-back">Back</a>
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
                    <form action="{{ route('emails.sendEmails') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row p-20">
                            <div class="col-xs-12 col-sm-12 col-md-12">

                                {{-- @php
                                foreach ($uniqueEmails as $key => $value) {
                                    echo $value;
                                }
                                    // print_r($emails); die;
                                @endphp --}}

                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="" class="f-14 text-daek-grey">To <sub
                                                    class="f-14 mr-1">*</sub> </label>

                                            <input type="text" readonly name="to" class="form-control"
                                                placeholder="To" value="@php
                                                foreach ($uniqueEmails as $email) {
                                                    echo $email . ",";
                                                }
                                                    // print_r($value); die;
                                                @endphp">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="" class="f-14 text-daek-grey">Subject <sub
                                                    class="f-14 mr-1">*</sub> </label>
                                            <input type="text" name="subject" class="form-control height-10 f-14"
                                                placeholder="Subject" ">
                                            {{-- <div class="slug-container"><span>{{URL::to('/')}}/</span><input type="text" name="slug" class="form-control" placeholder=""></div> --}}
                                        </div>
                                    </div>
                                {{-- </div>
                                <div class="row"> --}}
                                    <div class="col-md-4 dropdown">
                                    <div class="form-group my-3">
                                        <label for="html_code" class="f-14 text-dark-grey">Email Template<sub class="f-14 mr-1">*</sub></label>
                                        <select id="html_code" name="selectedTemplate" class="form-control form-group mb-0">
                                            <!-- Add a default option or leave it empty based on your requirement -->
                                            <option value="">Select Email Template</option>
                                            <!-- Iterate through your dynamic options and populate the dropdown -->
                                            @foreach($emailTemplates as $template)
                                                <option value="{{ $template['_id'] }}">{{ $template['title'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" class="f-14 text-daek-grey ">Create Template<sub
                                                class="f-14 mr-1">*</sub> </label>
                                        <textarea id="summernote" name="html_code"></textarea>
                                    </div>
                                </div>


                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Send Email</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            // Attach an event listener to the dropdown
            $('#html_code').on('change', function () {
                // Get the selected option value
                var selectedTemplateId = $(this).val();
    
                // You may want to perform additional checks or actions here
    
                // Assuming 'summernote' is the ID of your Summernote textarea
                // Set the Summernote content based on the selected dropdown value
                $('#summernote').val(getTemplateHtmlById(selectedTemplateId));
            });
    
            // Function to get the HTML code for a given template ID
            function getTemplateHtmlById(templateId) {
                // Assuming $emailTemplates is an array with template information
                // You may need to adapt this part based on your actual data structure
                var template = $emailTemplates.find(function (item) {
                    return item.id == templateId;
                });
    
                return template ? template.html_code : '';
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            // Listen for changes in the selected email template dropdown
            $('#html_code').change(function() {
                // Check if a template is selected
                var selectedTemplateId = $(this).val();
    
                if (selectedTemplateId !== "") {
                    // If a template is selected, disable the custom template textarea
                    $('#summernote').prop('disabled', true).val('');
                } else {
                    // If no template is selected, enable the custom template textarea
                    $('#summernote').prop('disabled', false);
                }
            });
    
            // Submit the form
            $('form').submit(function(event) {
                // Check if a template is selected
                var selectedTemplateId = $('#html_code').val();
    
                // If no template is selected and the custom template is empty, prevent form submission
                if (selectedTemplateId === "" && $('#summernote').val() === "") {
                    event.preventDefault();
                    alert('Please select an email template or provide a custom template.');
                }
    
                // Optionally, you can remove the HTML textarea value if a template is selected
                if (selectedTemplateId !== "") {
                    $('#summernote').val('');
                }
            });
        });
    </script>
    
@endsection
