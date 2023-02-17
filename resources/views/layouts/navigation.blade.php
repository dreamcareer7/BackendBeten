<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link ajax" href="{{ route('dashboard.crew.index') }}" data-execute-after="assignDT('dataTable')">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-group') }}"></use>
            </svg>
            Crew
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link ajax" href="{{ route('dashboard.users.index') }}" data-execute-after="assignDT('dataTable')">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            @lang('dashboard.users')
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link ajax" href="{{ route('dashboard.service.index') }}" data-execute-after="assignDT('dataTable')">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-apps-settings') }}"></use>
            </svg>
            Services
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link ajax" href="{{ route('dashboard.vehicle.index') }}" data-execute-after="assignDT('dataTable')">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-car-alt') }}"></use>
            </svg>
            Vehicles
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link ajax" href="{{ route('dashboard.group.index') }}" data-execute-after="assignDT('dataTable')">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-comment-bubble') }}"></use>
            </svg>
            Groups
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link ajax" href="{{ route('dashboard.client.index') }}" data-execute-after="assignDT('dataTable')">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-group') }}"></use>
            </svg>
            Clients
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link ajax" href="{{ route('dashboard.document.index') }}" data-execute-after="assignDT('dataTable')">
            {{-- <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-documents') }}"></use>
            </svg> --}}
            <svg class="nav-icon" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M22 24h-20v-24h14l6 6v18zm-7-23h-12v22h18v-16h-6v-6zm3 15v1h-12v-1h12zm0-3v1h-12v-1h12zm0-3v1h-12v-1h12zm-2-4h4.586l-4.586-4.586v4.586z"/></svg>
            Documents
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link ajax" href="{{ route('dashboard.contract.index') }}" data-execute-after="assignDT('dataTable')">
            {{-- <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-contract') }}"></use>
            </svg> --}}
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.019 10.13c-.282-.293-.268-.751.024-1.035l2.974-2.884c.145-.14.332-.211.517-.211.188 0 .375.073.518.22l-4.033 3.91zm-4.888 7.348c-.062.059-.093.139-.093.218 0 .167.136.304.304.304.076 0 .152-.029.212-.086l.499-.486-.422-.436-.5.486zm4.219-5.617l-1.71 1.657c-.918.891-1.387 1.753-1.819 2.958l.754.779c1.217-.395 2.094-.836 3.013-1.728l1.709-1.658-1.947-2.008zm4.985-5.106l-4.402 4.27 2.218 2.29 4.402-4.269c.323-.314.485-.73.485-1.146 0-1.392-1.687-2.13-2.703-1.145z"/></svg>
            Contracts
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link ajax" href="{{ route('dashboard.complaint.index') }}" data-execute-after="assignDT('dataTable')">
            {{-- <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-block') }}"></use>
            </svg> --}}
            <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" class="nav-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-1.5c-4.69 0-8.497-3.808-8.497-8.498s3.807-8.497 8.497-8.497 8.498 3.807 8.498 8.497-3.808 8.498-8.498 8.498zm0-6.5c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c.552 0 1-.448 1-1s-.448-1-1-1-1 .448-1 1 .448 1 1 1z" fill-rule="nonzero"/></svg>
            Complaints
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard.users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-spa') }}"></use>
            </svg>
            About Us
        </a>
    </li>

    <li class="nav-group" aria-expanded="false">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-star') }}"></use>
            </svg>
            Two-level menu
        </a>
        <ul class="nav-group-items" style="height: 0px;">
            <li class="nav-item">
                <a class="nav-link" href="#" target="_top">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-bug') }}"></use>
                    </svg>
                    Child menu
                </a>
            </li>
        </ul>
    </li>
</ul>
