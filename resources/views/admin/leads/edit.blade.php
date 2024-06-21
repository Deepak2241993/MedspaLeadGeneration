@extends('admin.layouts.app')

@php
    $pageTitle = "Leads Edit";
@endphp

@section('content')
<div class="container-fluid">


    {{-- @php
    dd($result['data']['email']);
    die;
@endphp --}}




    <!-- Page Heading -->
    <div class="card-header py-2">
        <h1 class="h3 mb-2 text-gray-800">Update {{ $result['data']['first_name']}} Details</h1>
    </div>
    <div class="card shadow mb-4">
       <h6 class="m-0 font-weight-bold text-primary"></h6>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                    <a href="{{ route('admin.leads.index') }}" class="btn btn-primary btn-back">Back</a>
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
                    <form id="updateForm" action="{{ route('admin.leads.update', $result['data']['_id']) }}"  method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PUT') --}}
                        <div class="row p-20">
                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="" class="f-14 text-daek-grey">First Name<sub
                                                    class="f-14 mr-1">*</sub> </label>
                                            <input type="text" id="name" name="first_name" class="form-control"
                                                placeholder="first_name" value="{{ $result['data']['first_name'] }}">
                                                <div id="nameError" class="error-message"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="" class="f-14 text-daek-grey">Last Name<sub
                                                    class="f-14 mr-1">*</sub> </label>
                                            <input type="text" id="last_name" name="last_name" class="form-control"
                                                placeholder="last_name" value="{{ $result['data']['last_name'] }}">
                                                <div id="nameError" class="error-message"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="" class="f-14 text-daek-grey">Email<sub
                                                    class="f-14 mr-1">*</sub> </label>
                                            <input type="text" id="email" name="email" class="form-control height-10 f-14"
                                                placeholder="Email" value="{{ $result['data']['email'] }}">
                                                <div id="emailError" class="error-message"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="" class="f-14 text-daek-grey">Phone<sub
                                                    class="f-14 mr-1">*</sub> </label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                placeholder="Phone" value="{{ $result['data']['phone'] }}">
                                                <div id="phoneError" class="error-message"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="" class="f-14 text-daek-grey">Message <sub
                                                    class="f-14 mr-1">*</sub> </label>
                                            <input type="text" id="message" name="message" class="form-control height-10 f-14"
                                                placeholder="Subject" value="{{$result['data']['message'] }}">
                                                <div id="messageError" class="error-message"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="" class="f-14 text-daek-grey">Source <sub
                                                    class="f-14 mr-1">*</sub> </label>
                                            <input type="text" id="source" name="source" class="form-control height-10 f-14"
                                                placeholder="Source" value="{{$result['data']['source'] }}">
                                                <input type="hidden" name="_id" value="{{$result['data']['_id'] }}">
                                                <div id="messageError" class="error-message"></div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group my-3">
                                            <label for="" class="f-14 text-daek-grey">Mobile <sub
                                                    class="f-14 mr-1">*</sub> </label>
                                            <input type="text" id="mobile" name="mobile" class="form-control height-10 f-14"
                                                placeholder="mobile" value="{{ $result->mobile }}">
                                                <div id="mobileError" class="error-message"></div>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                <button type="submit" class="btn btn-primary" id="updateBtn">Update</button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
    {{-- <script>
        document.getElementById('updateBtn').addEventListener('click', function() {
            if (confirm('Are you sure you want to update this lead?')) {
                document.getElementById('updateForm').submit();
            }
        });
    </script> --}}
    <script>
        (function() {

                var input = document.getElementById('phone');
                var pattern = /^[6-9][0-9]{0,9}$/;
                var value = input.value;
                !pattern.test(value) && (input.value = value = '');
                input.addEventListener('input', function() {
                    var currentValue = this.value;
                    if(currentValue && !pattern.test(currentValue)) this.value = value;
                    else value = currentValue;
                });
            })();
      </script>
    <script>
        (function() {

                var input = document.getElementById('mobile');
                var pattern = /^[6-9][0-9]{0,9}$/;
                var value = input.value;
                !pattern.test(value) && (input.value = value = '');
                input.addEventListener('input', function() {
                    var currentValue = this.value;
                    if(currentValue && !pattern.test(currentValue)) this.value = value;
                    else value = currentValue;
                });
            })();
      </script>
      <script>
        // Example Validation Script for 'Name' Field
document.getElementById('updateForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    if (confirm('Are you sure you want to update this lead?')) {
        if (validateForm()) {
            this.submit(); // Submit the form if validation passes
        }
    }
});

function validateForm() {
    let isValid = true;

    // Validation logic for Name field
    const name = $('#name').val();
    var nameRegex = /^[a-zA-Z\s]+$/; // Regular expression to allow only letters and spaces
    if (!nameRegex.test(name)) {
        $("#nameError").html("Please enter a valid name (only letters and spaces allowed).").slideDown();
        isValid = false;

        setTimeout(function () {
            $("#nameError").empty().slideUp();
        }, 5000);
    } else if (name.length === 0 || name.length > 50) {
        $("#nameError").html("Name is required and should be less than 50 characters.").slideDown();
        isValid = false;

        setTimeout(function () {
            $("#nameError").empty().slideUp();
        }, 5000);
    } else {
        $("#nameError").empty();
    }

     // Validation logic for Email
     const email = $('#email').val();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $("#emailError").html("Please enter a valid email address.").slideDown();
            isValid = false;

            setTimeout(function () {
                $("#emailError").empty().slideUp();
            }, 5000);
        } else {
            $("#emailError").empty();
        }

        // Validation logic for Phone
        const phone = $('#phone').val();
        const phoneRegex = /^(9|8|7|6)\d{9}$/; // Matches a 10-digit number starting with 9, 8, or 6
        if (!phoneRegex.test(phone)) {
            $("#phoneError").html("Please enter a valid phone number").slideDown();
            isValid = false;

            setTimeout(function () {
                $("#phoneError").empty().slideUp();
            }, 5000);
        } else {
            $("#phoneError").empty();
        }

        // Validation logic for Text Message
        const message = $('#message').val();
        const wordCount = message.split(/\s+/).filter(function (word) {
            return word.length > 0;
        }).length;

        if (wordCount < 2) {
            $("#messageError").html("Text message should contain at least 20 words.").slideDown();
            isValid = false;

            setTimeout(function () {
                $("#messageError").empty().slideUp();
            }, 5000);
        } else {
            $("#messageError").empty();
        }

        // Validation logic for Mobile (optional)
        const mobile = $('#mobile').val();
        // Add your optional mobile validation logic here if needed

    return isValid;
}

      </script>


@endsection
