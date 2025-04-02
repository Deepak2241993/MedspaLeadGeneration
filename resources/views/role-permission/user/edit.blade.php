@extends('layouts.master')

@section('title')
Edit User
@endsection

@section('css')

@endsection

@section('page-title')
Edit User
@endsection

@section('body')

<body data-sidebar="colored">
    @endsection

    @section('content')
    <div class="card mt-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h1 class="card-title mb-0" style="font-size: 2.1rem;">Edit User</h1>
            <a href="{{ url('users') }}" class="btn btn-danger float-end">Back</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <form action="{{ url('users/' . $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" id="name"
                                    name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                    name="email" required>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="form-label">Phone</label>

                                <!-- Phone number input field -->
                                <input class="form-control" type="tel" id="phone" name="phone" placeholder="Phone Number" value="{{ $user->phone }}">

                                <!-- Hidden input for country code (populated from the database) -->
                                <input type="hidden" id="countryCode" name="country_code" value="{{ $user->country_code }}">

                                @error('phone')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Role</label>
                                <select name="roles[]" class="form-control" id="">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role }}"
                                        {{ in_array($role, $userRoles) ? 'selected' : '' }}>{{ $role }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')

    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const phoneInput = document.querySelector("#phone");
            const countryCodeInput = document.querySelector("#countryCode"); // Get the hidden country code input

            // Initialize intl-tel-input on the phone input field
            const iti = window.intlTelInput(phoneInput, {
                separateDialCode: true, // Display the country code separately
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js", // Utils for validation
                preferredCountries: ["us", "gb", "in"], // Preferred countries
            });

            // Function to set the selected country using dial code
            function setCountryFromDialCode(dialCode) {
                // Mapping of dial codes to ISO country codes
                const countryMapping = {
                    "1": "us", // USA (+1)
                    "44": "gb", // UK (+44)
                    "91": "in" // India (+91)
                };

                const country = countryMapping[dialCode];
                if (country) {
                    iti.setCountry(country); // Set the country based on the ISO2 code
                }
            }

            // Remove the '+' sign from the country code before using it
            const dialCode = countryCodeInput.value.replace('+', '');

            // Set the country based on the hidden country code value
            if (dialCode) {
                setCountryFromDialCode(dialCode);
            }

            // Listen for changes in the selected country and update the hidden country code input
            phoneInput.addEventListener("countrychange", function() {
                const selectedCountryData = iti.getSelectedCountryData();
                // Update the hidden input with the new dial code
                countryCodeInput.value = "+" + selectedCountryData.dialCode;
                console.log("New selected country dial code:", countryCodeInput.value); // For debugging
            });
        });
    </script>
    @endsection