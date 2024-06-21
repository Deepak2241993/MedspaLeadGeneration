@php
$viewLeadAgentPermission = user()->permission('view_lead_agents');
$viewLeadCategoryPermission = user()->permission('view_lead_category');
$viewLeadSourcesPermission = user()->permission('view_lead_sources');
$addLeadAgentPermission = user()->permission('add_lead_agent');
$addLeadSourcesPermission = user()->permission('add_lead_sources');
$addLeadCategoryPermission = user()->permission('add_lead_category');
$addProductPermission = user()->permission('add_product');
@endphp

<link rel="stylesheet" href="{{ asset('vendor/css/dropzone.min.css') }}">

<div class="row">
    <div class="col-sm-12">
        <x-form id="save-lead-data-form" method="PUT">
            <div class="add-client bg-white rounded">
                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-bottom-grey">
                    @lang('modules.lead.leadDetails')</h4>

                <div class="row p-20">
                    <div class="col-lg-4 col-md-6">
                        <x-forms.select fieldId="salutation" :fieldLabel="__('modules.client.salutation')"
                            fieldName="salutation">
                            <option value="">--</option>
                            @foreach ($salutations as $salutation)
                                <option value="{{ $salutation->value }}" @selected($lead->salutation == $salutation)>{{ $salutation->label() }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <x-forms.text :fieldLabel="__('modules.lead.clientName')" fieldName="client_name"
                            fieldId="client_name" fieldPlaceholder="" fieldRequired="true"
                            :fieldValue="$lead->client_name" />
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <x-forms.email fieldId="client_email" :fieldLabel="__('modules.lead.clientEmail')"
                            fieldName="client_email" :fieldPlaceholder="__('placeholders.email')"
                            :fieldValue="$lead->client_email" :fieldHelp="__('modules.lead.leadEmailInfo')">
                        </x-forms.email>
                    </div>


                    @if ($viewLeadAgentPermission != 'none')
                        <div class="col-lg-4 col-md-6">
                            <x-forms.label class="my-3" fieldId="agent_id" :fieldLabel="__('modules.tickets.chooseAgents')">
                            </x-forms.label>
                            <x-forms.input-group>
                                <select class="form-control select-picker" name="agent_id" id="agent_id"
                                    data-live-search="true">
                                    <option value="">--</option>
                                    @foreach ($leadAgents as $emp)
                                        <x-user-option :user="$emp->user" :selected="$emp->id == $lead->agent_id" :userID="$emp->id" />
                                    @endforeach
                                </select>

                                @if ($addLeadAgentPermission == 'all' || $addLeadAgentPermission == 'added')
                                    <x-slot name="append">
                                        <button type="button"
                                            class="btn btn-outline-secondary border-grey add-lead-agent"
                                            data-toggle="tooltip" data-original-title="{{ __('app.add').'  '.__('app.new').' '.__('modules.tickets.agents') }}">@lang('app.add')</button>
                                    </x-slot>
                                @endif
                            </x-forms.input-group>
                        </div>
                    @endif

                    @if ($viewLeadSourcesPermission != 'none')
                        <div class="col-lg-4 col-md-6">
                            <x-forms.label class="my-3" fieldId="source_id" :fieldLabel="__('modules.lead.leadSource')">
                            </x-forms.label>
                            <x-forms.input-group>
                                <select class="form-control select-picker" name="source_id" id="source_id"
                                    data-live-search="true">
                                    <option value="">--</option>
                                    @foreach ($sources as $source)
                                        <option @if ($lead->source_id == $source->id) selected @endif value="{{ $source->id }}">
                                            {{ $source->type }}</option>
                                    @endforeach
                                </select>

                                @if ($addLeadSourcesPermission == 'all' || $addLeadSourcesPermission == 'added')
                                    <x-slot name="append">
                                        <button type="button"
                                            class="btn btn-outline-secondary border-grey add-lead-source"
                                            data-toggle="tooltip" data-original-title="{{ __('app.add').' '.__('modules.lead.leadSource') }}">@lang('app.add')</button>
                                    </x-slot>
                                @endif
                            </x-forms.input-group>
                        </div>
                    @endif

                    @if ($viewLeadCategoryPermission != 'none')
                        <div class="col-lg-4 col-md-6">
                            <x-forms.label class="my-3" fieldId="category_id" :fieldLabel="__('modules.lead.leadCategory')">
                            </x-forms.label>
                            <x-forms.input-group>
                                <select class="form-control select-picker" name="category_id" id="category_id"
                                    data-live-search="true">
                                    <option value="">--</option>
                                    @forelse($categories as $category)
                                        <option value="{{ $category->id }}" @if ($lead->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                                    @empty
                                        <option value="">@lang('messages.noCategoryAdded')</option>
                                    @endforelse
                                </select>

                                @if ($addLeadCategoryPermission == 'all' || $addLeadCategoryPermission == 'added')
                                    <x-slot name="append">
                                        <button type="button"
                                            class="btn btn-outline-secondary border-grey add-lead-category"
                                            data-toggle="tooltip" data-original-title="{{ __('app.add').' '.__('modules.lead.leadCategory') }}">@lang('app.add')</button>
                                    </x-slot>
                                @endif
                            </x-forms.input-group>
                        </div>
                    @endif

                    <div class="col-lg-4 col-md-6 my-3">
                        <x-forms.label fieldId="value" :fieldLabel="__('app.lead') .' '. __('app.value')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <x-slot name="prepend">
                                <span
                                    class="input-group-text f-14">{{!is_null($lead->currency_id) ? $lead->currency->currency_code : company()->currency->currency_code}} ( {{ !is_null($lead->currency_id) ? $lead->currency->currency_symbol : company()->currency->currency_symbol }} )</span>
                            </x-slot>
                            <input type="number" name="value" id="value" class="form-control height-35 f-14" value="{{$lead->value}}"/>
                        </x-forms.input-group>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <x-forms.label class=" mt-3" fieldId="next_follow_up" :fieldLabel="__('app.next_follow_up')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="next_follow_up" id="next_follow_up"
                                data-live-search="true" data-size="8">
                                <option @if ($lead->next_follow_up == 'yes') selected @endif value="yes"> @lang('app.yes')</option>
                                <option @if ($lead->next_follow_up == 'no') selected @endif value="no"> @lang('app.no')</option>
                            </select>
                        </x-forms.input-group>
                    </div>


                    <div class="col-md-6 col-lg-4">
                        <x-forms.label class="mt-3" fieldId="status" :fieldLabel="__('app.status')">
                        </x-forms.label>
                        <x-forms.input-group>
                            <select class="form-control select-picker" name="status" id="status" data-live-search="true"
                                data-size="8">
                                @forelse($status as $sts)
                                    <option @if ($lead->status_id == $sts->id) selected @endif value="{{ $sts->id }}">
                                        {{ $sts->type }}</option>
                                @empty
                                    <option value="">--</option>
                                @endforelse
                            </select>
                        </x-forms.input-group>
                    </div>

                    <div class="col-lg-4 mt-2">
                        <div class="form-group">
                            <x-forms.label fieldId="selectProduct" :fieldLabel="__('app.menu.products')" >
                            </x-forms.label>
                            <x-forms.input-group>
                                <select class="form-control select-picker" data-live-search="true" data-size="8"  name="product_id[]" multiple  id="add-products" title="{{ __('app.menu.selectProduct') }}">
                                    @foreach ($products as $item)
                                        <option @if(in_array($item->id, $productIds)) selected @endif data-content="{{ $item->name }}" value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($addProductPermission == 'all' || $addProductPermission == 'added')
                                    <x-slot name="append">
                                        <a href="{{ route('products.create') }}" data-redirect-url="no"
                                            class="btn btn-outline-secondary border-grey openRightModal"
                                            data-toggle="tooltip" data-original-title="{{ __('app.add').' '.__('modules.dashboard.newproduct') }}">@lang('app.add')</a>
                                    </x-slot>
                                @endif
                            </x-forms.input-group>
                        </div>
                    </div>

                </div>

                <h4 class="mb-0 p-20 f-21 font-weight-normal text-capitalize border-top-grey">
                    @lang('modules.lead.companyDetails')</h4>


                <div class="row p-20">

                    <div class="col-lg-3 col-md-6">
                        <x-forms.text :fieldLabel="__('modules.lead.companyName')" fieldName="company_name"
                            fieldId="company_name" :fieldPlaceholder="__('placeholders.company')"
                            :fieldValue="$lead->company_name" />
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <x-forms.text :fieldLabel="__('modules.lead.website')" fieldName="website" fieldId="website"
                            :fieldPlaceholder="__('placeholders.website')" :fieldValue="$lead->website" />
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <x-forms.tel fieldId="mobile" :fieldLabel="__('modules.lead.mobile')" fieldName="mobile"
                           :fieldPlaceholder="__('placeholders.mobile')" :fieldValue="$lead->mobile"></x-forms.tel>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <x-forms.text :fieldLabel="__('modules.client.officePhoneNumber')" fieldName="office"
                            fieldId="office" fieldPlaceholder="" :fieldValue="$lead->office" />
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <x-forms.select fieldId="country" :fieldLabel="__('app.country')" fieldName="country"
                            search="true">
                            <option value="">--</option>
                            @foreach ($countries as $item)
                                <option @if ($lead->country == $item->nicename) selected @endif data-tokens="{{ $item->iso3 }}"
                                    data-content="<span class='flag-icon flag-icon-{{ strtolower($item->iso) }} flag-icon-squared'></span> {{ $item->nicename }}"
                                    value="{{ $item->nicename }}">{{ $item->nicename }}</option>
                            @endforeach
                        </x-forms.select>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <x-forms.text :fieldLabel="__('modules.stripeCustomerAddress.state')" fieldName="state"
                            fieldId="state" :fieldPlaceholder="__('placeholders.state')" :fieldValue="$lead->state" />
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <x-forms.text :fieldLabel="__('modules.stripeCustomerAddress.city')" fieldName="city" :fieldValue="$lead->city"
                            fieldId="city" :fieldPlaceholder="__('placeholders.city')" />
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <x-forms.text :fieldLabel="__('modules.stripeCustomerAddress.postalCode')"
                            fieldName="postal_code" fieldId="postal_code" :fieldPlaceholder="__('placeholders.postalCode')"
                            :fieldValue="$lead->postal_code" />
                    </div>

                    <div class="col-md-12">
                        <div class="form-group my-3">
                            <x-forms.textarea class="mr-0 mr-lg-2 mr-md-2" :fieldLabel="__('app.address')"
                                fieldName="address" fieldId="address" :fieldPlaceholder="__('placeholders.address')"
                                :fieldValue="$lead->address">
                            </x-forms.textarea>
                        </div>
                    </div>
                </div>

                <x-forms.custom-field :fields="$fields" :model="$lead"></x-forms.custom-field>

                <x-form-actions>
                    <x-forms.button-primary id="save-lead-form" class="mr-3" icon="check">@lang('app.save')
                    </x-forms.button-primary>
                    <x-forms.button-cancel :link="route('tasks.index')" class="border-0">@lang('app.cancel')
                    </x-forms.button-cancel>
                </x-form-actions>

            </div>
        </x-form>

    </div>
</div>


<script>
    $(document).ready(function() {

        $('.custom-date-picker').each(function(ind, el) {
            datepicker(el, {
                position: 'bl',
                ...datepickerConfig
            });
        });

        $('#save-lead-form').click(function() {
            const url = "{{ route('leads.update', [$lead->id]) }}";
            $.easyAjax({
                url: url,
                container: '#save-lead-data-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                file: true,
                buttonSelector: "#save-lead-form",
                data: $('#save-lead-data-form').serialize(),
                success: function(response) {
                    window.location.href = response.redirectUrl;
                }
            });
        });

        $('body').on('click', '.add-lead-agent', function() {
            const url = '{{ route('lead-agent-settings.create') }}';
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('body').on('click', '.add-lead-source', function() {
            const url = '{{ route('lead-source-settings.create') }}';
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('body').on('click', '.add-lead-category', function() {
            var url = '{{ route('leadCategory.create') }}';
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('#create_task_category').click(function() {
            const url = "{{ route('taskCategory.create') }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('#department-setting').click(function() {
            const url = "{{ route('departments.create') }}";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('#client_view_task').change(function() {
            $('#clientNotification').toggleClass('d-none');
        });

        $('#set_time_estimate').change(function() {
            $('#set-time-estimate-fields').toggleClass('d-none');
        });

        $('#repeat-task').change(function() {
            $('#repeat-fields').toggleClass('d-none');
        });

        $('#dependent-task').change(function() {
            $('#dependent-fields').toggleClass('d-none');
        });

        $('.toggle-other-details').click(function() {
            $(this).find('svg').toggleClass('fa-chevron-down fa-chevron-up');
            $('#other-details').toggleClass('d-none');
        });

        $('#createTaskLabel').click(function() {
            const url = "{{ route('task-label.create') }}";
            $(MODAL_XL + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_XL, url);
        });

        $('#add-project').click(function() {
            $(MODAL_XL).modal('show');
            const url = "{{ route('projects.create') }}";
            $.easyAjax({
                url: url,
                blockUI: true,
                container: MODAL_XL,
                success: function(response) {
                    if (response.status == "success") {
                        $(MODAL_XL + ' .modal-body').html(response.html);
                        $(MODAL_XL + ' .modal-title').html(response.title);
                        init(MODAL_XL);
                    }
                }
            });
        });

        $('#add-employee').click(function() {
            $(MODAL_XL).modal('show');

            const url = "{{ route('employees.create') }}";

            $.easyAjax({
                url: url,
                blockUI: true,
                container: MODAL_XL,
                success: function(response) {
                    if (response.status == "success") {
                        $(MODAL_XL + ' .modal-body').html(response.html);
                        $(MODAL_XL + ' .modal-title').html(response.title);
                        init(MODAL_XL);
                    }
                }
            });
        });

        <x-forms.custom-field-filejs/>

        init(RIGHT_MODAL);
    });

    function checkboxChange(parentClass, id){
        let checkedData = '';
        $('.'+parentClass).find("input[type= 'checkbox']:checked").each(function () {
            checkedData = (checkedData !== '') ? checkedData+', '+$(this).val() : $(this).val();
        });
        $('#'+id).val(checkedData);
    }
</script>
