@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('page-title')
    Profile
@endsection
@section('css')

    <style>
        .badge {
            font-size: 1rem;
            font-weight: 600;
        }

        .bg-info {
            background-color: #17a2b8 !important;
            border: 1px solid #17a2b8;
        }

        .text-dark {
            color: #343a40 !important;
        }
        
    </style>
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title mb-0">Hello, {{ $user->name }}</h4>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="name-input" class="col-sm-2 col-form-label">
                                    <i class="fas fa-user"></i> Name
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-lg rounded-pill" type="text"
                                        placeholder="Enter your name" id="name-input" name="name"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email-input" class="col-sm-2 col-form-label">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-lg rounded-pill" type="email"
                                        placeholder="Enter your email" id="email-input" name="email"
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <label for="phone-input" class="col-sm-2 col-form-label">
                                    <i class="fas fa-phone"></i> Phone
                                </label>
                                <div class="col-sm-10">
                                    <input type="hidden" id="countryCode" name="country_code">
                                    <input class="form-control form-control-lg rounded-pill" type="tel" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone', $user->phone) }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label for="phone" class="col-sm-2 col-form-label">
                                    <i class="fas fa-phone"></i> Phone
                                </label>
                                <div class="col-sm-10">
                                    <!-- Phone number input field -->
                                    <input class="form-control form-control-lg rounded-pill" type="tel" id="phone" name="phone" placeholder="Phone Number" value="{{ old('phone', $user->phone) }}">
                            
                                    <!-- Hidden input for country code (populated from the database) -->
                                    <input type="hidden" id="countryCode" name="country_code" value="{{ old('country_code', $user->country_code) }}">
                                    
                                    @error('phone')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="profile-pic" class="col-sm-2 col-form-label">
                                    <i class="fas fa-image"></i> Profile Picture
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control-file" type="file" id="profile-pic" name="profile_pic">

                                    <div class="mt-2">
                                        @if ($user->profile_pic)
                                            @php
                                                // Generate the public URL for the profile picture
                                                $profilePicUrl = asset('uploads/profile_pics/' . $user->profile_pic);
                                            @endphp
                                            <!-- Display the image using the generated URL -->
                                            <img id="current-profile-pic" src="{{ $profilePicUrl }}" alt="Profile Picture"
                                                class="img-thumbnail rounded-circle" width="100">
                                        @else
                                            <!-- Display the default profile picture if none is set -->
                                            <img id="current-profile-pic" src="{{ asset('path_to_default_image') }}"
                                                alt="Default Profile Picture" class="img-thumbnail rounded-circle"
                                                width="100">
                                        @endif
                                    </div>                                    

                                    @error('profile_pic')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-3">
                                <label for="role" class="col-sm-2 col-form-label">
                                    <i class="fas fa-user-tag"></i> Role
                                </label>
                                <div class="col-sm-10">
                                    <div class="d-flex flex-wrap">
                                        @foreach ($roles as $role)
                                            @if (in_array($role->id, $userRoles))
                                                <div class="m-1">
                                                    <span class="badge bg-info text-dark px-3 py-2 rounded-pill">
                                                        {{ $role->name }}
                                                    </span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-lg btn-primary rounded-pill px-5">
                                        <i class="fas fa-save"></i> Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>




        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- Include Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
       <script>
    document.addEventListener("DOMContentLoaded", function () {
        const phoneInput = document.querySelector("#phone");
        const countryCodeInput = document.querySelector("#countryCode"); // Hidden country code input
        const countryCode = countryCodeInput.value; // Get the initial country code value

        // Initialize intl-tel-input on the phone input field
        const iti = window.intlTelInput(phoneInput, {
            separateDialCode: true, // Display the country code separately
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js", // Utils for validation
            preferredCountries: ["us", "gb", "in"], // Preferred countries
        });

        // Mapping of dial codes to ISO country codes (without the + sign)
        const countryMapping = {
            "1": "us", // USA
            "44": "gb", // UK
            "91": "in", // India
            // Add more mappings as needed
        };

        // Function to set the selected country using the dial code
        function setCountryFromDialCode(dialCode) {
            // Remove the "+" sign from dial code if present
            const cleanDialCode = dialCode.replace("+", "");
            const country = countryMapping[cleanDialCode];
            if (country) {
                iti.setCountry(country); // Set the country based on the ISO2 code
            }
        }

        // Set the initial country based on the hidden country code value
        if (countryCode) {
            setCountryFromDialCode(countryCode);
        }

        // Listen for changes in the hidden country code input (if updated dynamically)
        countryCodeInput.addEventListener('change', function() {
            setCountryFromDialCode(countryCodeInput.value);
        });

        // Update the hidden country code input when the country in intl-tel-input changes
        phoneInput.addEventListener("countrychange", function() {
            const selectedDialCode = iti.getSelectedCountryData().dialCode;
            countryCodeInput.value = `+${selectedDialCode}`;
        });

        // Log the selected country’s dial code for debugging
        console.log("Selected dial code: ", iti.getSelectedCountryData().dialCode);
    });
</script>

        
        
        
    @endsection
