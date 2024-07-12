<link rel="stylesheet" href="{{ asset('vendor/css/bootstrap-colorpicker.css') }}" />
<style>
    #colorpicker .form-group {
        width: 87%;
    }
</style>


<!-- Modal Form -->
<form id="createStatus" method="POST" class="ajax-form">
    <div class="modal-header">
        <h5 class="modal-title" id="modelHeading">Add New LeadStatus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <div class="modal-body">
        <div class="portlet-body">
            <div class="form-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label for="name">Lead Status</label>
                            <input type="text" id="name" name="name" class="form-control" required
                                placeholder="Status">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div id="colorpicker" class="input-group">
                            <div class="form-group my-3 text-left">
                                <label for="colorselector">Label Color</label>
                                <div class="input-group">
                                    <input type="text" name="label_color" id="colorselector" value="#16813D"
                                        class="form-control height-35 f-15 light_text">
                                    <div class="input-group-append">
                                        <span class="input-group-text colorpicker-input-addon height-35"><i></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('imperialheaders_success'))
                <div class="alert alert-success alert-block">
                    {{-- <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button> --}}
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="border-0 mr-3" data-dismiss="modal">Close</button>
        <button type="button" id="save-status" class="btn btn-primary">
            <i class="icon-check"></i> Save
        </button>
    </div>
</form>

<!-- Scripts -->
<!-- Scripts -->
<script src="{{ asset('vendor/jquery/bootstrap-colorpicker.js') }}"></script>
<script>
    $('#colorpicker').colorpicker({"color": "#16813D"});

    // save status
    $('#save-status').click(function() {
    $.easyAjax({
        url: "{{ route('admin.lead-status.create') }}",
        container: '#createStatus',
        type: "POST",
        blockUI: true,
        disableButton: true,
        buttonSelector: "#save-status",
        data: $('#createStatus').serialize() + "&_token={{ csrf_token() }}", // Add CSRF token
        success: function(response) {
            if (response.status == "success") {
                alert('Data saved successfully!');
                window.location.reload();
            }
        }
    });
});

</script>

