<aside class="main-sidebar sidebar-dark-primary ">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        {{-- <img src="{{ url('/logo.png') }}" alt="Logo" class="brand-image" /> --}}
        <span class="brand-text text-poppins fw-medium">
            Dashboard
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/item" class="nav-link {{ Request::is('item') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Barang</p>
                    </a>
                </li>
                <li class="nav-header font-weight-bold">Main</li>
                <li class="nav-item">
                    <a href="/purchase-order" class="nav-link {{ Request::is('purchase-order') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Purchase Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/sales-order" class="nav-link {{ Request::is('sales-order') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Sales Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/history" class="nav-link {{ Request::is('history') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat</p>
                    </a>
                </li>
                <li class="nav-header font-weight-bold">Setup</li>
                <li class="nav-item">
                    <a href="/user" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                {{-- @if (request()->session()->get('user')['role'] === 'Superuser')
                    <li class="nav-item">
                        <a href="/user" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endif --}}
            </ul>
        </nav>
    </div>
</aside>
