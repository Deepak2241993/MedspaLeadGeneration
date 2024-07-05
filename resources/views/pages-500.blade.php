@extends('layouts.master-without-nav')
@section('title')
    500 Error
@endsection
@section('content')
        <div class="auth-error d-flex align-items-center min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <div>
                            <div class="text-center mb-4">
                                <div class="mt-5">
                                    <h1 class="error-title mt-5"><span>500!</span></h1>
                                    <h4 class="mt-2 text-uppercase mt-4">Internal Server Error</h4>
                                    <p class="mt-4 text-muted w-50 mx-auto">It will be as simple as Occidental in fact, it will Occidental to an English person</p>
                                </div>

                                <div class="mt-5 text-center">
                                    <a class="btn btn-primary waves-effect waves-light" href="index">Back to Dashboard</a>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection