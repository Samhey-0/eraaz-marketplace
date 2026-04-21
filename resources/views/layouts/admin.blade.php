@extends('layouts.main')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" id="admin-sidebar">
        <div class="sidebar-heading">Main</div>
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}" id="sidebar-admin-dashboard">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="sidebar-heading">Management</div>
        <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}" id="sidebar-admin-categories">
            <i class="bi bi-tags"></i> Categories
        </a>
        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}" id="sidebar-admin-products">
            <i class="bi bi-box-seam"></i> Products
        </a>
        <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}" id="sidebar-admin-orders">
            <i class="bi bi-receipt"></i> Orders
        </a>
        <a class="nav-link {{ request()->routeIs('admin.payouts.*') ? 'active' : '' }}" href="{{ route('admin.payouts.index') }}" id="sidebar-admin-payouts">
            <i class="bi bi-wallet2"></i> Payouts
        </a>

        <div class="sidebar-heading">Users</div>
        <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}" id="sidebar-admin-users">
            <i class="bi bi-people"></i> Users
        </a>
        <a class="nav-link {{ request()->routeIs('admin.vendor-requests.*') ? 'active' : '' }}" href="{{ route('admin.vendor-requests.index') }}" id="sidebar-admin-vendors">
            <i class="bi bi-shop-window"></i> Vendor Requests
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content-with-sidebar">
        @yield('admin-content')
    </div>
</div>
@endsection
