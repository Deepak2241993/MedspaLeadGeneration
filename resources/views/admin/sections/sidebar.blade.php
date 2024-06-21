<!-- SIDEBAR START -->
<aside class="sidebar-dark">
    <!-- MOBILE CLOSE SIDEBAR PANEL START -->
    <div class="mobile-close-sidebar-panel w-100 h-100" onclick="closeMobileMenu()" id="mobile_close_panel"></div>
    <!-- MOBILE CLOSE SIDEBAR PANEL END -->

    <!-- MAIN SIDEBAR START -->
    <div class="main-sidebar" id="mobile_menu_collapse">
        <!-- SIDEBAR BRAND START -->
        <div class="sidebar-brand-box dropdown cursor-pointer">
            <div class="dropdown-toggle sidebar-brand d-flex align-items-center justify-content-between  w-100"
                type="link" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">


                    <!-- SIDEBAR BRAND NAME START -->
                    <div class="sidebar-brand-name">
                        <h1 class="mb-0 f-16 f-w-500 text-white-shade mt-0" data-placement="bottom" data-toggle="tooltip"
                            data-original-title="Forever Medspa">Forever Medspa
                            <i class="bg-light-green rounded-circle"></i>
                        </h1>
                    </div>
                    <!-- SIDEBAR BRAND NAME END -->
                    <!-- SIDEBAR BRAND LOGO START -->
                    <div class="sidebar-brand-logo">
                        <img src="{{ asset ('img\forever-white-1.png') }}" style="width: 100px; height: auto;">
                    </div>
                    <!-- SIDEBAR BRAND LOGO END -->
            <!-- DROPDOWN - INFORMATION -->
            <div class="dropdown-menu dropdown-menu-right sidebar-brand-dropdown ml-3"
                aria-labelledby="dropdownMenuLink" tabindex="0">
                <div class="d-flex justify-content-between align-items-center profile-box">
                    <a>
                            <div class="profileInfo d-flex align-items-center mr-1 flex-wrap">
                                <div class="profileImg mr-2">
                                    <img class="h-100" src="https://www.gravatar.com/avatar/ffd06f5fa02450841fc219791edee243.png?s=200&d=mp"
                                        alt="Forever Medspa &amp; Wellness Center">
                                </div>
                                {{-- <div class="ProfileData">
                                    <h3 class="f-15 f-w-500 text-dark" data-placement="bottom" data-toggle="tooltip"
                                        data-original-title="{{ user()->name }}">{{ user()->name }}</h3>
                                    <p class="mb-0 f-12 text-dark-grey">{{ user()->employeeDetail->designation->name ?? '' }}</p>
                                </div> --}}
                        </div>
                    </a>
                    {{-- <a href="{{ route('profile-settings.index') }}" data-toggle="tooltip"
                        data-original-title="{{ __('app.menu.profileSettings') }}">
                            <i class="side-icon bi bi-pencil-square"></i>
                    </a> --}}
                </div>


                    {{-- <a class="dropdown-item d-flex justify-content-between align-items-center f-15 text-dark invite-member"
                        href="javascript:;">
                        <span>@lang('app.inviteMember') {{ $companyName }}</span>
                        <i class="side-icon bi bi-person-plus"></i>
                    </a>
   --}}

                <a class="dropdown-item d-flex justify-content-between align-items-center f-15 text-dark"
                    href="javascript:;">
                    <label for="dark-theme-toggle">@lang('app.darkTheme')</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="dark-theme-toggle"
                            >
                        <label class="custom-control-label f-14" for="dark-theme-toggle"></label>
                    </div>
                </a>
                <a class="dropdown-item d-flex justify-content-between align-items-center f-15 text-dark"
                    href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    @lang('app.logout')
                    <i class="side-icon bi bi-power"></i>
                </a>
            </div>
        </div>
        <!-- SIDEBAR BRAND END -->

        <!-- SIDEBAR MENU START -->
        <div class="sidebar-menu" id="sideMenuScroll">
            @include('admin.sections.menu')
        </div>
        <!-- SIDEBAR MENU END -->
    </div>
    <!-- MAIN SIDEBAR END -->
    <!-- Sidebar Toggler -->
    <div
        class="text-center d-flex justify-content-between align-items-center position-fixed sidebarTogglerBox ">
        <button class="border-0 d-lg-block d-none text-lightest font-weight-bold" id="sidebarToggle"></button>

        <p class="mb-0 text-dark-grey px-1 py-0 rounded f-10">v</p>
    </div>
    <!-- Sidebar Toggler -->
</aside>
<!-- SIDEBAR END -->

<script>
    $(document).ready(function() {

        $('.invite-member').click(function() {
            const url = "";
            $(MODAL_LG + ' ' + MODAL_HEADING).html('...');
            $.ajaxModal(MODAL_LG, url);
        });

        $('#dark-theme-toggle').change(function() {
            const darkTheme = ($(this).is(':checked')) ? '1' : '0'

            $.easyAjax({
                type: 'POST',
                url: "",
                blockUI: true,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'darkTheme': darkTheme
                },
                success: function(response) {
                    if (response.status === 'success') {
                        // window.location.reload();
                    }
                }
            });

        });

    });
</script>
