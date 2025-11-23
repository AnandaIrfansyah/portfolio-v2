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
            <li class="menu-header">Setting</li>
            <li class="nav-item {{ Request::is('setting/tech-stack') ? 'active' : '' }}">
                <a href="{{ route('tech-stack.index') }}" class="nav-link">
                    <i class="fas fa-home"></i> <span>Tech Stack</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
