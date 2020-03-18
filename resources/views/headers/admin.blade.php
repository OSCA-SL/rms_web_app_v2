<header class="c-header c-header-light c-header-fixed c-header-with-subheader">

    <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <span class="c-header-toggler-icon"></span>
    </button>
    <a class="c-header-brand d-sm-none" href="{{ route('home') }}">
        OSCA RMS
    </a>
    <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show">
        <span class="c-header-toggler-icon"></span>
    </button>
    <a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="{{ route('home') }}">
        OSCA RMS
    </a>
    <ul class="c-header-nav d-md-down-none"><li class="c-header-nav-item px-3">
            <a class="c-header-nav-link" href="{{ route('home') }}">
                Dashboard
            </a>
        </li>
    </ul>
    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown">
            <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="c-avatar">
                    <img class="c-avatar-img" src="{{ asset('assets/img/avatars/6.jpg') }}" alt="user@email.com">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2">
                    <strong>Settings</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('assets/icons/coreui/symbols/free-symbol-defs.svg#cui-user') }}"></use>
                    </svg>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                <button class="dropdown-item" type="submit">
                    <svg class="c-icon mr-2">
                        <use xlink:href="{{ asset('assets/icons/coreui/symbols/free-symbol-defs.svg#cui-account-logout') }}"></use>
                    </svg>
                    Logout
                </button>
                </form>
            </div>
        </li>
    </ul>
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
        </ol>
    </div>
</header>
