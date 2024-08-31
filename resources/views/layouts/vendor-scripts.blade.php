<!-- JAVASCRIPT -->
<script src="{{ URL::asset('build/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>
<!-- Icon -->
<script src="https://unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>
<!-- Summernote -->
<script src="{{ URL::asset('build/summernote/summernote.min.js') }} "></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300, // set height
            focus: true  // set focus to editable area after initializing summernote
        });

        // Ensure tooltips are initialized (for Bootstrap 5)
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>
@yield('scripts')