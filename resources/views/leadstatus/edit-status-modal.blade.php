<link rel="stylesheet" href="{{ asset('vendor/css/bootstrap-colorpicker.css') }}" />

<style>
    #colorpicker .form-group {
        width: 87%;
    }
</style>


<form id="editStatus" method="PUT" class="ajax-form">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="modelHeading">Edit Lead Status</h5>
        <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">×</span>
        </button>
    </div>

    {{-- @php
        dd($leadStatusData);
    @endphp --}}
    <div class="modal-body">
        <div class="portlet-body">
            <div class="form-body">
                <div class="row">
                    <div class="col-sm-4 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="name" class="control-label">Lead Status<span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control" required placeholder="status" value="{{ $leadStatusData['name'] }}">
                        </div>
                    </div>

                    <div class="col-sm-4 col-md-12 col-lg-6">
                        <div id="colorpicker" class="input-group">
                            <div class="form-group my-3 text-left">
                                <label for="colorselector" class="control-label">Label Color<span class="required">*</span></label>
                                <div class="input-group">
                                    <input type="text" name="label_color" id="colorselector" value="{{ $leadStatusData['label_color'] }}" class="form-control height-35 f-15 light_text">
                                    <span class="input-group-text colorpicker-input-addon height-35"><i></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                        $maxPriority = 2;
                    @endphp
                    <div class="col-sm-4 col-md-6">
                        <div class="my-3">
                            <label for="priority" id="agentLabel">Position</label>
                            <select class="form-control select-picker" id="priority" data-live-search="true" name="priority">
                                @for($i=1; $i<= $maxPriority; $i++)
                                    <option @if($i == $leadStatusData['priority']) selected @endif>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
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

<script src="{{ asset('vendor/jquery/bootstrap-colorpicker.js') }}"></script>

<script>

    $('#colorpicker').colorpicker({"color": "{{ $leadStatusData['label_color'] }}"});

    $(".select-picker").selectpicker();

    // save status
    $('#save-status').click(function() {
        $.easyAjax({
            url: "{{route('admin.lead-status.update', $leadStatusData['_id'])}}",
            container: '#editStatus',
            type: "PUT",
            blockUI: true,
            disableButton: true,
            buttonSelector: "#save-status",
            data: $('#editStatus').serialize(),
            success: function(response) {
                if (response.status == "success") {
                    window.location.reload();
                }
            }
        })
    });

</script>
