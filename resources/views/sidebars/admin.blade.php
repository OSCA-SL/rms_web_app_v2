<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        OSCA RMS
    </div>
    <ul class="c-sidebar-nav" id="s-nav-ul">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link {{ Route::is('home') ? 'c-active' : '' }}" href="{{ route('home') }}">
                <i class="cil-speedometer c-sidebar-nav-icon"></i>
                Home
            </a>
        </li>
        <li class="c-sidebar-nav-title">Users</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="#">
                <i class="fas fa-user c-sidebar-nav-icon"></i>
                View Users
            </a>
        </li>

        <li class="c-sidebar-nav-title">Artists</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('artists.index') }}">
                <i class="fas fa-user-tie c-sidebar-nav-icon"></i>
                View Artists
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="#">
                <i class="fas fa-microphone-alt c-sidebar-nav-icon"></i>
                Add New Artist
            </a>
        </li>

        <li class="c-sidebar-nav-title">Songs</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="#">
                <i class="fas fa-volume-up c-sidebar-nav-icon"></i>
                View Songs
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="#">
                <i class="fas fa-file-audio c-sidebar-nav-icon"></i>
                Add New Song
            </a>
        </li>

        <li class="c-sidebar-nav-title">Channels</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="#">
                <i class="fas fa-broadcast-tower c-sidebar-nav-icon"></i>
                View Channels List
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="#">
                <i class="fas fa-money-check-alt c-sidebar-nav-icon"></i>
                Channel Fees
            </a>
        </li>

        <li class="c-sidebar-nav-title">Reports</li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="#">
                <i class="fas fa-chart-line c-sidebar-nav-icon"></i>
                Generate Reports
            </a>
        </li>
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div>
