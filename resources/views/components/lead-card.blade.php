@php
    $moveClass = ($draggable == 'true') ? 'move-disable' : '';
@endphp

<div class="card rounded bg-white border-grey b-shadow-4 m-1 mb-2 task-card "
    data-task-id="{{ $lead['_id'] }}" id="drag-task-{{ $lead['_id'] }}">
    <div class="card-body p-2">
        <div class="d-flex justify-content-between mb-2">
            <a href="#" class="f-12 f-w-500 text-dark mb-0 text-wrap openRightModal">{{ $lead['first_name'] }}
                {{ $lead['last_name'] }}

                @if (!empty($lead['status_id']))
                    <i class="fa fa-check-circle text-success" data-toggle="tooltip"
                        data-original-title="convertedClient"></i>
                @endif

            </a>
            <div class="d-flex mb-3 align-items-center">
                <i class="fa fa-phone f-11 text-lightest"></i><span
                    class="ml-2 f-11 text-lightest">{{ $lead['phone'] }}</span>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            @if (!empty($lead['email']))
                <div class="d-flex flex-wrap">
                    <div class="">
                        {{ $lead['email'] }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<!-- div end -->



{{-- @php
    $moveClass = ($draggable == 'true') ? 'move-disable' : '';
@endphp

<div class="card rounded bg-white border-grey b-shadow-4 m-1 mb-2  task-card"
    data-task-id="{{ $lead->id }}" id="drag-task-{{ $lead->id }}">
    <div class="card-body p-2">
        <div class="d-flex justify-content-between mb-2">
            <a href="" class="f-12 f-w-500 text-dark mb-0 text-wrap openRightModal">{{ $lead->name }}

                <i class="fa fa-check-circle text-success" data-toggle="tooltip" data-original-title="convertedClient"></i>

            </a>
            <div class="d-flex mb-3 align-items-center">
                <i class="fa fa-phone f-11 text-lightest"></i><span
                    class="ml-2 f-11 text-lightest">{{ $lead->phone }}</span>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            @if (!is_null($lead->email))
                <div class="d-flex flex-wrap">
                    <div class="">
                        {{ $lead->email }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div> --}}
<!-- div end -->
