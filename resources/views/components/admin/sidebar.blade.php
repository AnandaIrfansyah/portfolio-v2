<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('author.dashboard') }}" class="nav-link">
                    <i class="fas fa-home"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Menu</li>
            <li class="nav-item {{ Request::is('menu/projects') ? 'active' : '' }}">
                <a href="{{ route('projects.index') }}" class="nav-link">
                    <i class="fas fa-laptop-code"></i> <span>Projects</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('menu/publications') ? 'active' : '' }}">
                <a href="{{ route('publications.index') }}" class="nav-link">
                    <i class="fas fa-book"></i> <span>Publications</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('menu/about') ? 'active' : '' }}">
                <a href="{{ route('abouts.index') }}" class="nav-link">
                    <i class="fas fa-user"></i> <span>About</span>
                </a>
            </li>

            {{-- <li
                class="nav-item dropdown {{ Request::is('menu/about*') || Request::is('menu/educations*') || Request::is('menu/certifications*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-database"></i> <span>About Management</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('menu/about*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('about.index') }}">Intro & CV</a>
                    </li>
                    <li class="{{ Request::is('menu/educations*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('about.index') }}">Experiences</a>
                    </li>
                    <li class="{{ Request::is('menu/certifications*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('about.index') }}">Educations</a>
                    </li>
                    <li class="{{ Request::is('menu/certifications*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('about.index') }}">Certifications</a>
                    </li>
                </ul>
            </li> --}}

            <li class="menu-header">Setting</li>
            <li class="nav-item {{ Request::is('setting/tech-stack') ? 'active' : '' }}">
                <a href="{{ route('tech-stack.index') }}" class="nav-link">
                    <i class="fas fa-tools"></i> <span>Tech Stack</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
