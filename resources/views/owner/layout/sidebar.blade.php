<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="#">SEAFOOD RESTO</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm mt-3">
      <img src="{{asset('assets/settings/logo.png')}}" width="40" alt="" srcset="" class="">
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="@if (Request::is('owner/dashboard*')) active @endif"><a class="nav-link" href="{{route('owner.dashboard')}}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
      <li class="@if (Request::is('owner/laporan*')) active @endif"><a class="nav-link" href="{{route('ownerlaporan.index')}}"><i class="fas fa-file-chart-pie"></i> <span>Laporan</span></a></li>
  </aside>
</div>