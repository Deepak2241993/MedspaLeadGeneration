<ul>
    <!-- NAV ITEM - DASHBOARD COLLAPSE MENU-->
    <li class="accordionItem ">

        <a class="nav-item text-lightest f-15 sidebar-text-color accordionItemHeading " href="{{ route('admin.dashboard') }}"
            title="Dashboard">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                <path fill-rule="evenodd"
                    d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
            </svg>
            <span class="pl-3">Dashboard</span>

        </a>
    </li>

    <!-- NAV ITEM - CUSTOMERS COLLAPASE MENU -->
    <li class="accordionItem closeIt">

        <a class="nav-item text-lightest f-15 sidebar-text-color" href="{{ route('admin.leads.index') }}" title="Leads">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person" viewBox="0 0 16 16">
                <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
            </svg>
            <span class="pl-3">Leads</span>
        </a>


    </li>
    {{-- <!-- NAV ITEM - SETTINGS -->
    <li class="accordionItem closeIt">

        <a class="nav-item text-lightest f-15 sidebar-text-color" href="" title="Settings">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-gear" viewBox="0 0 16 16">
                <path
                    d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                <path
                    d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
            </svg>
            <span class="pl-3">Settings</span>
        </a>


    </li> --}}
    <!-- NAV ITEM - EMAIL TEMPLATE MENU -->
    <li class="accordionItem closeIt">

        <a class="nav-item text-lightest f-15 sidebar-text-color" href="{{ route('admin.email.index')}}"
            title="Email Tepmplates">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-massage" viewBox="0 0 16 16">
                <path
                    d="M12,5c-1.77,0-3,1.18-3,3v0c0,1.65-1.35,3-3,3s-3-1.35-3-3v0c0-2.76,2.24-5,5-5s5,2.24,5,5v0c0,1.65-1.35,3-3,3v0c-1.77,0-3,1.23-3,3.01v0.54c0,0.38,0.31,0.68,0.68,0.68h7.64c0.38,0,0.68-0.31,0.68-0.68v-0.54c0-1.78-1.23-3.01-3-3.01V8C15,6.18,13.77,5,12,5z M5,8v0c0-1.1,0.9-2,2-2s2,0.9,2,2v0c0,1.1-0.9,2-2,2S5,9.1,5,8z M13,15.54V15c0-1.1-0.9-2-2-2s-2,0.9-2,2v0.54c-0.05,0-0.1,0-0.15,0.01C7.34,15.84,6,16.83,6,18v1h9v-1C15,16.83,13.66,15.84,13.15,15.54C13.1,15.53,13.05,15.54,13,15.54z" />
            </svg>
            <span class="pl-3">Email Template</span>
        </a>


    </li>
    <li class="accordionItem closeIt">

        <a class="nav-item text-lightest f-15 sidebar-text-color" href="{{ route('admin.leads.archived')}}"
            title="Email Tepmplates">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-massage" viewBox="0 0 16 16">
                <path
                    d="M12,5c-1.77,0-3,1.18-3,3v0c0,1.65-1.35,3-3,3s-3-1.35-3-3v0c0-2.76,2.24-5,5-5s5,2.24,5,5v0c0,1.65-1.35,3-3,3v0c-1.77,0-3,1.23-3,3.01v0.54c0,0.38,0.31,0.68,0.68,0.68h7.64c0.38,0,0.68-0.31,0.68-0.68v-0.54c0-1.78-1.23-3.01-3-3.01V8C15,6.18,13.77,5,12,5z M5,8v0c0-1.1,0.9-2,2-2s2,0.9,2,2v0c0,1.1-0.9,2-2,2S5,9.1,5,8z M13,15.54V15c0-1.1-0.9-2-2-2s-2,0.9-2,2v0.54c-0.05,0-0.1,0-0.15,0.01C7.34,15.84,6,16.83,6,18v1h9v-1C15,16.83,13.66,15.84,13.15,15.54C13.1,15.53,13.05,15.54,13,15.54z" />
            </svg>
            <span class="pl-3">Archived Leads</span>
        </a>


    </li>
    <li class="accordionItem closeIt">

        <a class="nav-item text-lightest f-15 sidebar-text-color" href="{{ route('admin.massage.index')}}"
            title="Email Tepmplates">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-massage" viewBox="0 0 16 16">
                <path
                    d="M12,5c-1.77,0-3,1.18-3,3v0c0,1.65-1.35,3-3,3s-3-1.35-3-3v0c0-2.76,2.24-5,5-5s5,2.24,5,5v0c0,1.65-1.35,3-3,3v0c-1.77,0-3,1.23-3,3.01v0.54c0,0.38,0.31,0.68,0.68,0.68h7.64c0.38,0,0.68-0.31,0.68-0.68v-0.54c0-1.78-1.23-3.01-3-3.01V8C15,6.18,13.77,5,12,5z M5,8v0c0-1.1,0.9-2,2-2s2,0.9,2,2v0c0,1.1-0.9,2-2,2S5,9.1,5,8z M13,15.54V15c0-1.1-0.9-2-2-2s-2,0.9-2,2v0.54c-0.05,0-0.1,0-0.15,0.01C7.34,15.84,6,16.83,6,18v1h9v-1C15,16.83,13.66,15.84,13.15,15.54C13.1,15.53,13.05,15.54,13,15.54z" />
            </svg>
            <span class="pl-3">Message Menu</span>
        </a>


    </li>
    {{-- <li class="accordionItem closeIt">

        <a class="nav-item text-lightest f-15 sidebar-text-color" href="{{ route('admin.call.make') }}"
            title="Email Tepmplates">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-massage" viewBox="0 0 16 16">
                <path
                    d="M12,5c-1.77,0-3,1.18-3,3v0c0,1.65-1.35,3-3,3s-3-1.35-3-3v0c0-2.76,2.24-5,5-5s5,2.24,5,5v0c0,1.65-1.35,3-3,3v0c-1.77,0-3,1.23-3,3.01v0.54c0,0.38,0.31,0.68,0.68,0.68h7.64c0.38,0,0.68-0.31,0.68-0.68v-0.54c0-1.78-1.23-3.01-3-3.01V8C15,6.18,13.77,5,12,5z M5,8v0c0-1.1,0.9-2,2-2s2,0.9,2,2v0c0,1.1-0.9,2-2,2S5,9.1,5,8z M13,15.54V15c0-1.1-0.9-2-2-2s-2,0.9-2,2v0.54c-0.05,0-0.1,0-0.15,0.01C7.34,15.84,6,16.83,6,18v1h9v-1C15,16.83,13.66,15.84,13.15,15.54C13.1,15.53,13.05,15.54,13,15.54z" />
            </svg>
            <span class="pl-3">Make Call</span>
        </a>


    </li>
 --}}


</ul>

