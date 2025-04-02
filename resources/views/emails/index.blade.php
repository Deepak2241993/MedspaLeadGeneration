@extends('layouts.master')

@section('title', 'Send Emails')

@section('page-title', 'Send Emails')

@section('content')

    <body data-sidebar="colored">
        <div class="card mt-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h3 class="mb-0 text-gray-800">Send Email With Template</h3>
                <a href="{{ route('leads.index') }}" class="btn btn-info">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    @if (Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> <strong>{{ Session::get('success') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="emailForm" method="POST" action="{{ route('emails.send') }}" class="p-4">
                        @csrf

                        <div class="row g-3">
                            <!-- To Field -->
                            <div class="col-md-4">
                                <label for="to" class="form-label">Recipient Email <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="to" id="to" class="form-control"
                                    placeholder="Add recipient's email"
                                    value="{{ isset($uniqueEmails) && count($uniqueEmails) > 0 ? implode(',', $uniqueEmails) : '' }}"
                                    {{ isset($uniqueEmails) && count($uniqueEmails) > 0 ? 'readonly' : '' }}>
                                <span class="text-danger" id="error-to"></span>
                            </div>

                            <!-- Subject Field -->
                            <div class="col-md-4">
                                <label for="subject" class="form-label">Email Subject <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="subject" id="subject" class="form-control"
                                    placeholder="Enter email subject">
                                <span class="text-danger" id="error-subject"></span>
                            </div>

                            <!-- Email Template Dropdown -->
                            <div class="col-md-4">
                                <label for="selectedTemplate" class="form-label">Email Template <span
                                        class="text-danger">*</span></label>
                                <select id="selectedTemplate" name="selectedTemplate" class="form-select">
                                    <option value="">Select Email Template</option>
                                    @foreach ($emailTemplates as $template)
                                        <option value="{{ $template['_id'] }}"
                                            data-html_code="{{ $template['html_code'] }}">
                                            {{ $template['title'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- HTML Code Field (Summernote) -->
                        <div class="mt-4">
                            <label for="htmlcode" class="form-label">Create Template <span
                                    class="text-danger">*</span></label>
                            <textarea name="html_code" id="summernote" class="summernote form-control" placeholder="Write your email template here"></textarea>
                            <span class="text-danger" id="error-html_code"></span>
                        </div>

                        <!-- Submit Button with Spinner -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary" id="submitButton">
                                <span class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span>
                                <span id="buttonText">Send Email</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </body>
@endsection

@section('scripts')
    <!-- Summernote Init -->
    <script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>
    <!-- App JS -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('to');
            if (emailInput.value === '') {
                emailInput.removeAttribute('readonly');
            }
            emailInput.addEventListener('input', function() {
                if (emailInput.value === '') {
                    emailInput.removeAttribute('readonly');
                }
            });
        });

        $(document).ready(function() {
            $('#emailForm').on('submit', function(e) {
                e.preventDefault();
                var $submitButton = $('#submitButton');
                var $spinner = $submitButton.find('.spinner-border');
                var $buttonText = $('#buttonText');

                // Show spinner and hide button text
                $spinner.removeClass('d-none');
                $buttonText.addClass('d-none');
                $submitButton.prop('disabled', true);

                var formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#emailForm')[0].reset();
                            $('#summernote').summernote('reset');
                            window.location.href = response.redirect_url;
                        } else {
                            let errorMessage = 'Failed to send some emails. ';
                            if (response.invalid_emails) {
                                errorMessage += 'Invalid emails: ' + response.invalid_emails
                                    .join(', ') + '. ';
                            }
                            if (response.failed_emails) {
                                errorMessage += 'Failed to send to: ' + response.failed_emails
                                    .join(', ') + '.';
                            }
                            alert(errorMessage);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                $('#error-' + field).text(messages.join(', '));
                            });
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        // Hide spinner and show button text
                        $spinner.addClass('d-none');
                        $buttonText.removeClass('d-none');
                        $submitButton.prop('disabled', false);
                    }
                });
            });

            $('#selectedTemplate').on('change', function() {
                var templateContent = $(this).find('option:selected').data('html_code') || '';
                $('#summernote').summernote('code', templateContent);
            });
        });
    </script>
@endsection
