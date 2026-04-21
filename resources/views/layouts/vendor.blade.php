@extends('layouts.main')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" id="vendor-sidebar">
        <div class="sidebar-heading">Main</div>
        <a class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}" href="{{ route('vendor.dashboard') }}" id="sidebar-vendor-dashboard">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="sidebar-heading">Products</div>
        <a class="nav-link {{ request()->routeIs('vendor.products.*') ? 'active' : '' }}" href="{{ route('vendor.products.index') }}" id="sidebar-vendor-products">
            <i class="bi bi-box-seam"></i> My Products
        </a>
        <a class="nav-link {{ request()->routeIs('vendor.products.create') ? 'active' : '' }}" href="{{ route('vendor.products.create') }}" id="sidebar-vendor-add-product">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>

        <div class="sidebar-heading">Orders</div>
        <a class="nav-link {{ request()->routeIs('vendor.orders.*') ? 'active' : '' }}" href="{{ route('vendor.orders.index') }}" id="sidebar-vendor-orders">
            <i class="bi bi-receipt"></i> Orders
        </a>

        <div class="sidebar-heading">Financials</div>
        <a class="nav-link {{ request()->routeIs('vendor.earnings.*') ? 'active' : '' }}" href="{{ route('vendor.earnings.index') }}" id="sidebar-vendor-earnings">
            <i class="bi bi-wallet2"></i> Earnings & Payouts
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content-with-sidebar">
        @yield('vendor-content')
    </div>
</div>
@endsection
