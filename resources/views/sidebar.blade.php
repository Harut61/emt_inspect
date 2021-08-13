<div class="sidebar-wrapper sidebar-theme">
    <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>

    <nav id="sidebar">
        <ul class="navbar-nav theme-brand flex-row  d-none d-lg-flex">
            <img alt="logo" src="{{ asset('assets/img/logo.png') }}" class="theme-logo brand-logo">
        </ul>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="/" data-toggle="" aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <i class="flaticon-computer-6 ml-3"></i>
                        <span>Home</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="{{ route('vulnerability-timeline') }}" data-toggle="" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="flaticon-line-chart"></i>
                        <span>Vulnerability Timeline</span>
                    </div>
                    <div>
                        <i class="flaticon-right-arrow"></i>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="{{ route('vulnerability-list') }}" data-toggle="" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <i class="flaticon-list2"></i>
                        <span>Vulnerability List</span>
                    </div>
                    <div>
                        <i class="flaticon-right-arrow"></i>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="{{ route('vulnerability-health') }}" data-toggle="" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <i class="flaticon-3d-cube"></i>
                        <span>Server Health</span>
                    </div>
                    <div>
                        <i class="flaticon-right-arrow"></i>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="{{ route('error-logging') }}" data-toggle="" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i class="flaticon-copy-line"></i>
                        <span>Error Logging</span>
                    </div>
                    <div>
                        <i class="flaticon-right-arrow"></i>
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>
