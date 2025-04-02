@extends('layouts.master')
@section('title')
Create Lead
@endsection
@section('page-title')
Create Lead
@endsection
@section('body')

<body data-sidebar="colored">
    @endsection
    @section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 float-end">
                                <a href="{{ route('leads.index') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(session('imperialheaders_success'))
                    <div class="alert alert-success">
                        {{ session('imperialheaders_success') }}
                    </div>
                    @endif
                    @if(session('imperialheaders_error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <form action="{{ route('leads.store') }}" method="POST" id="creatLead">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row mb-3">
                            <label for="first-name" class="col-sm-2 col-form-label">First Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="First Name" id="first-name" name="first_name">
                            </div>
                        </div>


                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="last-name" class="col-sm-2 col-form-label">Last Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Last Name" id="last-name" name="last_name">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="email-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" placeholder="Email" id="email-input" name="email">
                            </div>
                        </div>
                        <!-- end row -->
                        <!-- Phone number input field -->
                        <div class="row mb-3">
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <div class="iti-container">
                                    <input class="form-control" placeholder="Phone Number" id="phone" name="phone">
                                    <input type="hidden" id="countryCode" name="country_code">
                                    <small id="phone-feedback" class="form-text text-danger" style="display: none;"></small>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="text" class="col-sm-2 col-form-label">Text</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Text" id="text" name="message">
                            </div>
                        </div>
                        <!-- end row -->
                        <input class="form-control" type="hidden" placeholder="Source" id="source" name="source" value="crm">

                        <!-- end row -->
                        <div class="row mb-3">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Update Lead</button>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    @endsection
    @section('scripts')
    <!-- bs custom file input plugin -->
    <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>

    <!-- JavaScript -->
    <script>
        (function() {

            var input = document.getElementById('phone');
            var pattern = /^[6-9][0-9]{0,9}$/;
            var value = input.value;
            !pattern.test(value) && (input.value = value = '');
            input.addEventListener('input', function() {
                var currentValue = this.value;
                if (currentValue && !pattern.test(currentValue)) this.value = value;
                else value = currentValue;
            });
        })();
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.querySelector("#phone");
            const countryCodeInput = document.querySelector("#countryCode");

            // Initialize intl-tel-input
            const iti = window.intlTelInput(input, {
                initialCountry: "us",
                preferredCountries: ["us", "gb", "in"],
                separateDialCode: true,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
            });

            // Update the hidden country code input when the user selects a country
            input.addEventListener("countrychange", function() {
                const countryData = iti.getSelectedCountryData();
                countryCodeInput.value = `+${countryData.dialCode}`; // Store the dial code in the hidden input
            });

            // Form submit event listener
            document.querySelector("#creatLead").addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent form submission

                console.log("Number entered:", input.value);
                console.log("Is valid number:", iti.isValidNumber());
                console.log("Validation error code:", iti.getValidationError());

                if (iti.isValidNumber()) {
                    const simpleNumber = input.value.trim();
                    if (simpleNumber !== "") {
                        input.value = simpleNumber;
                        this.submit(); // Submit the form
                    } else {
                        alert("Please enter a valid phone number.");
                    }
                } else {
                    const errorCode = iti.getValidationError();
                    alert(`Please enter a valid phone number. Error code: ${errorCode}`);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#phone').on('blur', function() {
                var phone = $(this).val();
        
                // Clear previous feedback
                $('#phone-feedback').hide().text('');
                // $('#save-button').prop('disabled', true);
        
                // Make AJAX request to check phone number
                $.ajax({
                    url: '/check-phone-number', // The route to the controller method
                    method: 'POST',
                    data: {
                        phone: phone,
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        if (response.exists) {
                                // Show the feedback if the phone number exists
                                $('#phone-feedback').text(response.message).show();
                                $('#save-button').prop('disabled', true);
                            } else {
                                // Optional: handle case where phone does not exist
                                $('#phone-feedback').text(response.message).show();
                                $('#save-button').prop('disabled', false);
                            }
                    },
                    error: function(xhr) {
                        console.error('Error checking phone number:', xhr);
                    }
                });
            });
    });

</script>


    @endsection