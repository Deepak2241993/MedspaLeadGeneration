@extends('layouts.master')
@section('title')
    Forms Elements
@endsection
@section('page-title')
    Forms Elements
@endsection
@section('body')

    <body data-sidebar="colored">
    @endsection
    @section('content')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Textual inputs</h4>
                        <p class="card-title-desc">Here are examples of <code class="highlighter-rouge">.form-control</code>
                            applied to each
                            textual HTML5 <code class="highlighter-rouge">&lt;input&gt;</code> <code
                                class="highlighter-rouge">type</code>.</p>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Text</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" placeholder="Artisanal kale"
                                    id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Search</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="search" placeholder="How do I shoot web"
                                    id="example-search-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="email" placeholder="bootstrap@example.com"
                                    id="example-email-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-url-input" class="col-sm-2 col-form-label">URL</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="url" placeholder="https://getbootstrap.com"
                                    id="example-url-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-tel-input" class="col-sm-2 col-form-label">Telephone</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="tel" placeholder="1-(555)-555-5555"
                                    id="example-tel-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-password-input" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" value="hunter2" id="example-password-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-number-input" class="col-sm-2 col-form-label">Number</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="number" value="42" id="example-number-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Date and time</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="datetime-local" value="2011-08-19T13:45:00"
                                    id="example-datetime-local-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-date-input" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-month-input" class="col-sm-2 col-form-label">Month</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="month" value="2020-03" id="example-month-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-week-input" class="col-sm-2 col-form-label">Week</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="week" value="2020-W14" id="example-week-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-time-input" class="col-sm-2 col-form-label">Time</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-color-input" class="col-sm-2 col-form-label">Color</label>
                            <div class="col-sm-10">
                                <input type="color" class="form-control form-control-color w-100"
                                    id="example-color-input" value="#086070" title="Choose your color">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Select</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sizing</h4>
                        <p class="card-title-desc">Set heights using classes like <code>.form-control-lg</code> and
                            <code>.form-control-sm</code>.</p>
                        <div>
                            <div class="mb-4">
                                <input class="form-control" type="text" placeholder="Default input">
                            </div>
                            <div class="mb-4">
                                <input class="form-control form-control-sm" type="text"
                                    placeholder=".form-control-sm">
                            </div>
                            <div>
                                <input class="form-control form-control-lg" type="text"
                                    placeholder=".form-control-lg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Range Inputs</h4>
                        <p class="card-title-desc">Set horizontally scrollable range inputs using
                            <code>.form-control-range</code>.</p>

                        <div>
                            <h5 class="font-size-14">Example</h5>
                            <input type="range" class="form-range" id="formControlRange">
                        </div>
                        <div class="mt-4">
                            <h5 class="font-size-14">Custom Range</h5>
                            <input type="range" class="form-range" id="customRange1">

                            <input type="range" class="form-range mt-3" min="0" max="5"
                                id="customRange2">
                        </div>
                    </div>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Checkboxes</h4>

                        <div class="row">
                            <div class="col-md-5">
                                <div>
                                    <h5 class="font-size-14 mb-4">Form Checkboxes</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck1">
                                        <label class="form-check-label" for="formCheck1">
                                            Form Checkbox
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="formCheck2" checked>
                                        <label class="form-check-label" for="formCheck2">
                                            Form Checkbox checked
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="mt-4 mt-lg-0">
                                    <h5 class="font-size-14 mb-4">Form Checkboxes Right</h5>
                                    <div>
                                        <div class="form-check form-check-right mb-3">
                                            <input class="form-check-input" type="checkbox" id="formCheckRight1">
                                            <label class="form-check-label" for="formCheckRight1">
                                                Form Checkbox Right
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-check form-check-right">
                                            <input class="form-check-input" type="checkbox" id="formCheckRight2" checked>
                                            <label class="form-check-label" for="formCheckRight2">
                                                Form Checkbox Right checked
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Radios</h4>

                        <div class="row">
                            <div class="col-md-5">
                                <div>
                                    <h5 class="font-size-14 mb-4">Form Radios</h5>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="formRadios"
                                            id="formRadios1" checked>
                                        <label class="form-check-label" for="formRadios1">
                                            Form Radio
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="formRadios"
                                            id="formRadios2">
                                        <label class="form-check-label" for="formRadios2">
                                            Form Radio checked
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 ms-auto">
                                <div class="mt-4 mt-lg-0">
                                    <h5 class="font-size-14 mb-4">Form Radios Right</h5>
                                    <div>
                                        <div class="form-check form-check-right mb-3">
                                            <input class="form-check-input" type="radio" name="formRadiosRight"
                                                id="formRadiosRight1" checked>
                                            <label class="form-check-label" for="formRadiosRight1">
                                                Form Radio Right
                                            </label>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="form-check form-check-right">
                                            <input class="form-check-input" type="radio" name="formRadiosRight"
                                                id="formRadiosRight2">
                                            <label class="form-check-label" for="formRadiosRight2">
                                                Form Radio Right checked
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inline Forms</h4>
                        <p class="card-title-desc">Use the <code>.form-inline</code> class to display a series of labels,
                            form controls, and buttons on a single horizontal row.</p>

                        <form class="row row-cols-lg-auto g-3 align-items-center">
                            <div class="col-12">
                                <label class="visually-hidden" for="inlineFormInputGroupUsername">Username</label>
                                <div class="input-group">
                                    <div class="input-group-text">@</div>
                                    <input type="text" class="form-control" id="inlineFormInputGroupUsername"
                                        placeholder="Username">
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                                <select class="form-select" id="inlineFormSelectPref">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                    <label class="form-check-label" for="inlineFormCheck">
                                        Remember me
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Auto sizing</h4>
                        <p class="card-title-desc">The example below uses a flexbox utility to vertically center the
                            contents and changes <code>.col</code> to <code>.col-auto</code> so that your columns only take
                            up as much space as needed. Put another way, the column sizes itself based on the contents.</p>

                        <form class="row gy-2 gx-3 align-items-center">
                            <div class="col-auto">
                                <label class="visually-hidden" for="autoSizingInput">Name</label>
                                <input type="text" class="form-control" id="autoSizingInput" placeholder="Jane Doe">
                            </div>
                            <div class="col-auto">
                                <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                                <div class="input-group">
                                    <div class="input-group-text">@</div>
                                    <input type="text" class="form-control" id="autoSizingInputGroup"
                                        placeholder="Username">
                                </div>
                            </div>
                            <div class="col-auto">
                                <label class="visually-hidden" for="autoSizingSelect">Preference</label>
                                <select class="form-select" id="autoSizingSelect">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                                    <label class="form-check-label" for="autoSizingCheck">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Floating labels</h5>
                        <p class="card-title-desc">Create beautifully simple form labels that float over your input fields.
                        </p>

                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingFirstnameInput"
                                            placeholder="Enter Your First Name">
                                        <label for="floatingFirstnameInput">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingLastnameInput"
                                            placeholder="Enter Your Last Name">
                                        <label for="floatingLastnameInput">Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingemailInput"
                                            placeholder="Enter Email address">
                                        <label for="floatingemailInput">Email address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelectGrid"
                                            aria-label="Floating label select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                        <label for="floatingSelectGrid">Works with selects</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="floatingCheck">
                                    <label class="form-check-label" for="floatingCheck">
                                        Check me out
                                    </label>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Switches</h4>
                        <p class="card-title-desc">A switch has the markup of a custom checkbox but uses the
                            <code>.form-switch</code> class to render a toggle switch. Switches also support the
                            <code>disabled</code> attribute.</p>


                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">

                            <div class="col">
                                <h5 class="font-size-14 mb-3"><u>Switch Examples</u></h5>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Default switch
                                            checkbox input</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                            checked="">
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch
                                            checkbox input</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="font-size-14 mb-3"><u>Switch Sizes</u></h5>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch form-switch-md" dir="ltr">
                                        <input class="form-check-input" type="checkbox" id="SwitchCheckSizemd">
                                        <label class="form-check-label" for="SwitchCheckSizemd">Medium Size Switch</label>
                                    </div>

                                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                                        <input class="form-check-input" type="checkbox" id="SwitchCheckSizelg"
                                            checked="">
                                        <label class="form-check-label" for="SwitchCheckSizelg">Large Size Switch</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="font-size-14 mb-3"><u>Disable Switch</u></h5>

                                <div class="d-flex flex-column gap-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDisabled"
                                            disabled="">
                                        <label class="form-check-label" for="flexSwitchCheckDisabled">Disabled
                                            Switch</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                            id="flexSwitchCheckCheckedDisabled" checked="" disabled="">
                                        <label class="form-check-label" for="flexSwitchCheckCheckedDisabled">Disabled
                                            Checked Switch</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">File browser</h4>
                        <p class="card-title-desc">The file input is the most gnarly of the bunch and requires additional
                            JavaScript if you’d like to hook them up with functional <em>Choose file…</em> and selected file
                            name text.</p>
                        <div class="input-group">
                            <input type="file" class="form-control" id="customFile">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Inline Form With Stack</h4>
                        <p class="card-title-desc">Create an inline form with <code>.hstack</code>:</p>

                        <div class="w-50">
                            <div class="hstack gap-3">
                                <input class="form-control me-auto" type="text" placeholder="Add your item here..."
                                    aria-label="Add your item here...">
                                <button type="button" class="btn btn-secondary">Submit</button>
                                <div class="vr"></div>
                                <button type="button" class="btn btn-outline-danger">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->
    @endsection
    @section('scripts')
        <!-- bs custom file input plugin -->
        <script src="{{ URL::asset('build/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/form-element.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
