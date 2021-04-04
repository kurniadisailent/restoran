<div class="main-sidebar">
    <aside id="">
        <div class="sidebar-brand">
            <a href="#">SEAFOOD RESTO</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm mt-3">
            <img src="{{asset('assets/settings/logo3.png')}}" width="40" alt="" srcset="" class="">
        </div>
        <ul class="sidebar-menu">
            <li class="@if (Request::is('admin/dashboard*')) active @endif"><a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li class="@if (Request::is('admin/menu*')) active @endif"><a class="nav-link" href="{{route('menu.index')}}"><i class="fas fa-fw fa-folder"></i> <span>Menu</span></a></li>
            <li class="@if (Request::is('admin/meja*')) active @endif"><a class="nav-link" href="{{route('meja.index')}}"><i class="fas fa-fw fa-folder"></i> <span>Meja</span></a></li>
            <li class="@if (Request::is('admin/owneraccount*')) active @endif"><a class="nav-link" href="{{route('owneraccount.index')}}"><i class="fas fa-fw fa-folder"></i> <span>Owner</span></a></li>
            <li class="@if (Request::is('admin/adminaccount*')) active @endif"><a class="nav-link" href="{{route('adminaccount.index')}}"><i class="fas fa-fw fa-folder"></i> <span>Admin</span></a></li>
            <li class="@if (Request::is('admin/kasiraccount*')) active @endif"><a class="nav-link" href="{{route('kasiraccount.index')}}"><i class="fas fa-fw fa-folder"></i> <span>Kasir</span></a></li>
            <li class="@if (Request::is('admin/waiteraccount*')) active @endif"><a class="nav-link" href="{{route('waiteraccount.index')}}"><i class="fas fa-fw fa-folder"></i><span>Waiter</span></a></li>
            <li class="@if (Request::is('admin/pelangganaccount*')) active @endif"><a class="nav-link" href="{{route('pelangganaccount.index')}}"><i class="fas fa-folder"></i> <span>Pelanggan</span></a></li>
            <li class="nav-item dropdown dropdown @if (Request::is('admin/entriorder*') || Request::is('admin/order*') ) active @endif">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Menu Order </span></a>
                <ul class="dropdown-menu">
                    <li class="@if (Request::is('admin/order*')) active @endif"><a class="nav-link" href="{{route('adminorder.index')}}"></i> <span>Order</span></a></li>
                    <li class="@if (Request::is('admin/entriorder*')) active @endif"><a class="nav-link" href="{{route('adminentriorder.index')}}">Entri Order</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown @if (Request::is('admin/entritransaksi*') || Request::is('admin/transaksi*') ) active @endif">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Menu Transaksi </span></a>
                <ul class="dropdown-menu">
                    <li class="@if (Request::is('admin/transaksi*')) active @endif"><a class="nav-link" href="{{route('admin.transaksi')}}">Transaksi</a></li>
                    <li class="@if (Request::is('admin/entritransaksi*')) active @endif"><a class="nav-link {{ Request::is('admin/entritransaksi/*') ? 'active':''}}" href="{{route('adminentritransaksi.index')}}">Entri Transaksi</a></li>
                </ul>
            </li>
            <li class="@if (Request::is('admin/laporan*')) active @endif"><a class="nav-link" href="{{route('adminlaporan.index')}}"><i class="fas fa-folder"></i> <span>Laporan</span></a></li>
        </ul>
    </aside>
</div>