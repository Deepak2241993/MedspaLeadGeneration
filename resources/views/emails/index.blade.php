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
        <div class="card-body">
            <div class="row">
                <div class="w-100 border-top-grey d-block justify-content-start px-4 py-3 text-right">
                    <a href="{{ route('leads.index') }}" class="btn btn-primary btn-back">Back</a>
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
                    <form id="emailForm" method="POST" action="{{ route('emails.send') }}">
                        @csrf
                        <div class="row p-20">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="to" class="f-14 text-dark-grey">To <sub class="f-14 mr-1">*</sub></label>
                                            <input type="text" readonly name="to" id="to" class="form-control" placeholder="To"
                                                value="{{ implode(',', $uniqueEmails) }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="subject" class="f-14 text-dark-grey">Subject <sub class="f-14 mr-1">*</sub></label>
                                            <input type="text" name="subject" id="subject" class="form-control height-10 f-14"
                                                placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group my-3">
                                            <label for="selectedTemplate" class="f-14 text-dark-grey">Email Template<sub class="f-14 mr-1">*</sub></label>
                                            <select id="selectedTemplate" name="selectedTemplate" class="form-control mb-0">
                                                <option value="">Select Email Template</option>
                                                @foreach($emailTemplates as $template)
                                                    <option value="{{ $template['_id'] }}" data-html_code="{{ $template['html_code'] }}">{{ $template['title'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="htmlcode" class="f-14 text-dark-grey">
                                            Create Template<sub class="f-14 mr-1">*</sub>
                                        </label>
                                        <textarea name="html_code" id="summernote" cols="30" rows="10" class="summernote"
                                            placeholder="html_code"></textarea>
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
@endsection

@section('scripts')


<!-- init js -->
<script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>

<!-- App js -->
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#emailForm').on('submit', function (e) {
            e.preventDefault();
            var $submitButton = $('#emailForm button[type="submit"]');
            $submitButton.prop('disabled', true);

            var formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: $(this).attr('action'), // Use the form action attribute for the URL
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status === 'success') {
                        // alert('Email sent successfully!');
                        $('#emailForm')[0].reset();
                        $('#summernote').summernote('reset'); // Clear Summernote content
                        
                        // Redirect to leads index page after successful email sending
                        window.location.href = response.redirect_url;
                    } else {
                        // If there are invalid emails or other issues, show the relevant message
                        alert('Failed to send some emails. Invalid emails: ' + (response.invalid_emails ? response.invalid_emails.join(', ') : 'None') + '.');
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert('An error occurred. Please check the console for more details.');
                },
                complete: function() {
                    // Always enable the submit button after request completes, regardless of success or failure
                    $submitButton.prop('disabled', false);
                }
            });
        });


        // Update Summernote editor content when a template is selected
        $('#selectedTemplate').on('change', function () {
            // Get the selected option
            var selectedOption = $(this).find('option:selected');
            
            // Get the HTML code associated with the selected template
            var templateContent = selectedOption.data('html_code') || ''; // Default to empty string if no content
            
            // Set the content in the Summernote editor
            $('#summernote').summernote('code', templateContent);
        });


       
    });
</script>
@endsection