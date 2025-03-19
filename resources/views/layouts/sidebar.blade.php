<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh; position: fixed;">
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4 fw-bold">Security PRO</span>
    </a>
    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('role') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('role') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Role
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('users') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>
        <li>
            <a href="{{ route('owners') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('owners') ? 'active' : '' }}">
                <i class="bi bi-person-badge me-2"></i> Owners
            </a>
        </li>
        <li>
            <a href="{{ route('settings') }}" class="nav-link d-flex align-items-center {{ request()->routeIs('settings') ? 'active' : '' }}">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </li>
    </ul>
</div>

<!-- Bootstrap Icons (Make sure this is included in your layout if not already) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
