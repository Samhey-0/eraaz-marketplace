<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Multi-Vendor E-Commerce Marketplace - Shop from multiple vendors in one place">

    <title>@yield('title', config('app.name', 'Eraaz Marketplace'))</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Notyf CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --primary-light: #818cf8;
            --secondary: #0ea5e9;
            --accent: #f43f5e;
            --success: #10b981;
            --danger: #ef4444;
            --dark: #0f172a;
            --darker: #020617;
            --light-bg: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.7);
            --border-color: rgba(255, 255, 255, 0.5);
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-muted: #94a3b8;
            --gradient-primary: linear-gradient(135deg, #4f46e5, #ec4899);
            --gradient-secondary: linear-gradient(135deg, #0ea5e9, #4f46e5);
            --gradient-accent: linear-gradient(135deg, #f43f5e, #f97316);
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-glow: 0 0 20px rgba(79, 70, 229, 0.4);
            --radius-sm: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --glass-bg: rgba(255, 255, 255, 0.6);
            --glass-border: 1px solid rgba(255, 255, 255, 0.8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @keyframes gradient-bg {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
            /* Premium animated mesh gradient background */
            background: linear-gradient(-45deg, #f8fafc, #e0e7ff, #f1f5f9, #fce7f3);
            background-size: 400% 400%;
            animation: gradient-bg 15s ease infinite;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(2, 6, 23, 0.85); /* Transparent dark for glass effect */
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            padding: 1rem 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            transition: var(--transition);
        }

        .navbar-custom .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .navbar-custom .navbar-brand:hover {
            transform: scale(1.02);
            text-shadow: var(--shadow-glow);
        }

        .brand-text-container {
            display: flex;
            flex-direction: column;
            line-height: 1;
            justify-content: center;
        }

        .brand-tagline {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            background: linear-gradient(90deg, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.8;
            margin-top: 2px;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }

        .floating-logo {
            animation: floating 6s ease-in-out infinite;
        }

        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            transition: var(--transition);
            margin: 0 0.2rem;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255,255,255,0.05);
        }

        .navbar-custom .btn-cart {
            position: relative;
            color: rgba(255,255,255,0.9);
            font-size: 1.2rem;
            transition: var(--transition);
        }
        
        .navbar-custom .btn-cart:hover {
            transform: translateY(-3px) scale(1.1);
            color: var(--primary-light);
        }

        .navbar-custom .btn-cart .badge {
            position: absolute;
            top: -5px;
            right: -8px;
            font-size: 0.65rem;
            background: var(--gradient-accent);
            border: 2px solid var(--darker);
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(244, 63, 94, 0.5);
            animation: pulse-badge 2s infinite;
        }
        
        @keyframes pulse-badge {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(244, 63, 94, 0.7); }
            70% { transform: scale(1.05); box-shadow: 0 0 0 5px rgba(244, 63, 94, 0); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(244, 63, 94, 0); }
        }

        /* Buttons */
        .btn-primary-custom {
            background: var(--gradient-primary);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 0.7rem 1.75rem;
            border-radius: var(--radius-md);
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
            letter-spacing: 0.3px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0; left: -100%; width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
            z-index: -1;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.5);
            color: #fff;
        }
        
        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-secondary-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 2px solid var(--primary);
            color: var(--primary);
            font-weight: 700;
            padding: 0.6rem 1.65rem;
            border-radius: var(--radius-md);
            transition: var(--transition);
            letter-spacing: 0.3px;
        }

        .btn-secondary-custom:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #10b981, #059669);
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: var(--radius-md);
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }
        
        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.5);
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: var(--radius-md);
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        }
        
        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(239, 68, 68, 0.5);
        }

        /* Cards and Glassmorphism */
        .card-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: var(--glass-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            overflow: hidden;
            position: relative;
        }

        .card-custom:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-6px);
            border-color: rgba(255,255,255,1);
        }

        /* Product Cards */
        .product-card {
            border: var(--glass-border);
            border-radius: var(--radius-xl);
            overflow: hidden;
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: var(--shadow-md);
            transition: var(--transition);
        }

        .product-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-light);
        }

        .product-card .product-image {
            height: 220px;
            object-fit: cover;
            width: 100%;
            transition: var(--transition);
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-card .image-wrapper {
            overflow: hidden;
            position: relative;
        }

        .product-card .category-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(10px);
            color: #fff;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-card .price {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--primary);
        }

        /* Stat Cards */
        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            border: var(--glass-border);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            transition: var(--transition);
        }

        .stat-card.purple::before { background: var(--gradient-primary); }
        .stat-card.blue::before { background: var(--gradient-secondary); }
        .stat-card.amber::before { background: var(--gradient-accent); }
        .stat-card.green::before { background: linear-gradient(135deg, #10b981, #059669); }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
            border-color: rgba(255,255,255,1);
        }
        
        .stat-card:hover::before {
            height: 100%;
            opacity: 0.05;
        }

        .stat-card .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: var(--transition);
            box-shadow: inset 0 2px 4px rgba(255,255,255,0.5);
        }

        .stat-card:hover .stat-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .stat-card.purple .stat-icon { background: rgba(99,102,241,0.15); color: var(--primary); border: 1px solid rgba(99,102,241,0.2); }
        .stat-card.blue .stat-icon { background: rgba(14,165,233,0.15); color: var(--secondary); border: 1px solid rgba(14,165,233,0.2); }
        .stat-card.amber .stat-icon { background: rgba(245,158,11,0.15); color: var(--accent); border: 1px solid rgba(245,158,11,0.2); }
        .stat-card.green .stat-icon { background: rgba(16,185,129,0.15); color: var(--success); border: 1px solid rgba(16,185,129,0.2); }

        .stat-card .stat-number {
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.2;
        }

        .stat-card .stat-label {
            font-size: 0.9rem;
            color: var(--text-secondary);
            font-weight: 600;
        }

        /* Sidebar */
        .sidebar {
            background: rgba(2, 6, 23, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            min-height: calc(100vh - 64px);
            padding: 1.5rem 0;
            width: 260px;
            position: fixed;
            top: 64px;
            left: 0;
            z-index: 100;
            overflow-y: auto;
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.6);
            padding: 0.8rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 500;
            transition: var(--transition);
            border-left: 3px solid transparent;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 0.2rem 1rem;
            border-radius: var(--radius-md);
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
            transition: var(--transition);
        }

        .sidebar .nav-link:hover i {
            color: var(--primary-light);
            transform: scale(1.1);
        }

        .sidebar .sidebar-heading {
            color: rgba(255,255,255,0.4);
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 1.5rem 1.7rem 0.7rem;
        }

        .main-content-with-sidebar {
            margin-left: 260px;
            padding: 2.5rem;
            min-height: calc(100vh - 64px);
        }

        /* Tables */
        .table-custom {
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: var(--glass-border);
        }

        .table-custom thead th {
            background: rgba(15, 23, 42, 0.03);
            color: var(--text-primary);
            font-weight: 700;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem 1.25rem;
            border-bottom: 2px solid rgba(0,0,0,0.05);
        }

        .table-custom tbody td {
            padding: 1.25rem;
            vertical-align: middle;
            border-color: rgba(0,0,0,0.05);
            font-size: 0.95rem;
            color: var(--text-secondary);
        }

        .table-custom tbody tr:hover {
            background: rgba(99,102,241,0.03);
        }

        /* Status Badges */
        .badge-status {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.75rem;
            border-radius: 9999px;
            letter-spacing: 0.3px;
        }

        .badge-pending { background: rgba(245,158,11,0.1); color: #d97706; }
        .badge-processing { background: rgba(14,165,233,0.1); color: #0284c7; }
        .badge-shipped { background: rgba(99,102,241,0.1); color: #6366f1; }
        .badge-delivered { background: rgba(16,185,129,0.1); color: #059669; }
        .badge-approved { background: rgba(16,185,129,0.1); color: #059669; }
        .badge-rejected { background: rgba(239,68,68,0.1); color: #dc2626; }

        /* Forms */
        .form-control:focus, .form-select:focus {
            background: rgba(255,255,255,0.9);
            border-color: var(--primary-light);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
            transform: translateY(-1px);
        }

        .form-control, .form-select {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: var(--radius-md);
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: var(--transition);
            color: var(--text-primary);
        }

        .form-label {
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--text-primary);
            margin-bottom: 0.4rem;
            letter-spacing: 0.3px;
        }

        /* Page Headers */
        .page-header {
            margin-bottom: 2.5rem;
            position: relative;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }

        .page-header p {
            color: var(--text-secondary);
            font-size: 1rem;
            font-weight: 500;
        }

        /* Hero Section */
        .hero-section {
            background: var(--gradient-primary);
            color: #fff;
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
            border-radius: 0 0 var(--radius-xl) var(--radius-xl);
            box-shadow: var(--shadow-xl);
            margin-bottom: 3rem;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -10%;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            animation: float 15s ease-in-out infinite;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 800;
            letter-spacing: -1.5px;
            line-height: 1.1;
            text-shadow: 0 4px 20px rgba(0,0,0,0.15);
            margin-bottom: 1.5rem;
        }

        .hero-section p {
            font-size: 1.25rem;
            opacity: 0.95;
            font-weight: 500;
            text-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Footer */
        .footer {
            background: rgba(2, 6, 23, 0.95);
            backdrop-filter: blur(20px);
            color: rgba(255,255,255,0.6);
            padding: 4rem 0 2rem;
            margin-top: 5rem;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .footer h5 {
            color: #fff;
            font-weight: 800;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
        }

        .footer a {
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.95rem;
            font-weight: 500;
            display: inline-block;
        }

        .footer a:hover {
            color: var(--primary-light);
        }

        /* Alerts */
        .alert-custom {
            border: none;
            border-radius: var(--radius-md);
            padding: 1rem 1.25rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.5s ease forwards;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
            .main-content-with-sidebar {
                margin-left: 0;
            }
            .hero-section h1 {
                font-size: 2rem;
            }
        }

        /* Search Bar */
        .search-bar {
            position: relative;
        }

        .search-bar input {
            padding-left: 2.5rem;
            border-radius: 9999px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff;
        }

        .search-bar input::placeholder {
            color: rgba(255,255,255,0.4);
        }

        .search-bar input:focus {
            background: rgba(255,255,255,0.12);
            border-color: var(--primary-light);
            color: #fff;
        }

        .search-bar .search-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.4);
        }

        /* Dropdown customization */
        .dropdown-menu {
            border: 1px solid var(--border-color);
            box-shadow: var(--shadow-lg);
            border-radius: var(--radius-md);
        }

        .dropdown-item:hover {
            background: rgba(99,102,241,0.05);
            color: var(--primary);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-secondary);
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top" id="main-navbar">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ url('/') }}" id="brand-link">
                <img src="{{ asset('images/logo.png') }}" alt="Eraaz Logo" style="height: 48px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
                <div class="brand-text-container">
                    <span style="font-size: 1.6rem; letter-spacing: -0.5px;">Eraaz</span>
                    <span class="brand-tagline">Your Marketplace Engine</span>
                </div>
            </a>

            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" id="navbar-toggler">
                <i class="bi bi-list fs-4"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <!-- Search Bar -->
                <form class="search-bar mx-auto d-none d-lg-block" style="width: 400px;" action="{{ route('products.search') }}" method="GET" id="search-form">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="form-control" name="q" placeholder="Search products..." value="{{ request('q') }}" id="search-input">
                </form>

                <ul class="navbar-nav ms-auto align-items-center gap-1">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}" id="nav-home">
                            <i class="bi bi-house"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}" id="nav-shop">
                            <i class="bi bi-grid"></i> Shop
                        </a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link btn-cart" href="{{ route('cart.index') }}" id="nav-cart">
                                <i class="bi bi-bag"></i>
                                @php
                                    $cartCount = auth()->user()->cart?->items?->sum('quantity') ?? 0;
                                @endphp
                                @if($cartCount > 0)
                                    <span class="badge">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" id="user-dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(Auth::user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}" id="dropdown-admin-dash"><i class="bi bi-speedometer2 me-2"></i>Admin Dashboard</a></li>
                                @elseif(Auth::user()->isVendor())
                                    <li><a class="dropdown-item" href="{{ route('vendor.dashboard') }}" id="dropdown-vendor-dash"><i class="bi bi-speedometer2 me-2"></i>Vendor Dashboard</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}" id="dropdown-customer-dash"><i class="bi bi-speedometer2 me-2"></i>My Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}" id="dropdown-orders"><i class="bi bi-receipt me-2"></i>My Orders</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger" id="logout-btn"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" id="nav-login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary-custom btn-sm ms-2" href="{{ route('register') }}" id="nav-register">Sign Up</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show m-3" role="alert" id="alert-success">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-custom alert-dismissible fade show m-3" role="alert" id="alert-error">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('warning'))
        <div class="alert alert-warning alert-custom alert-dismissible fade show m-3" role="alert" id="alert-warning">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Content -->
    @yield('content')

    <!-- Footer (only on public pages) -->
    @if(!request()->is('admin/*') && !request()->is('vendor/*') && !request()->is('customer/*'))
        <footer class="footer" id="main-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img src="{{ asset('images/logo.png') }}" alt="Eraaz Logo" style="height: 50px; border-radius: 12px;">
                            <div class="d-flex flex-column">
                                <h5 class="mb-0 text-white fw-bold">Eraaz</h5>
                                <span class="brand-tagline text-white-50 small">Your Marketplace Engine</span>
                            </div>
                        </div>
                        <p class="small">Your premium multi-vendor ecosystem. Empowering vendors and delighting customers with the ultimate Marketplace Engine.</p>
                    </div>
                    <div class="col-lg-2 mb-4">
                        <h5>Shop</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('products.index') }}">All Products</a></li>
                            <li class="mb-2"><a href="{{ url('/') }}">Categories</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 mb-4">
                        <h5>Account</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('login') }}">Login</a></li>
                            <li class="mb-2"><a href="{{ route('register') }}">Register</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <h5>Become a Vendor</h5>
                        <p class="small">Start selling your products on Eraaz Marketplace and reach thousands of customers.</p>
                        @auth
                            @if(Auth::user()->isCustomer())
                                <a href="{{ route('vendor.request.create') }}" class="btn btn-primary-custom btn-sm">Apply Now</a>
                            @endif
                        @endauth
                    </div>
                </div>
                <hr style="border-color: rgba(255,255,255,0.1);">
                <div class="text-center small">
                    <p class="mb-0">&copy; {{ date('Y') }} Eraaz Marketplace. All rights reserved.</p>
                </div>
            </div>
        </footer>
    @endif

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Notyf JS -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <script>
        // Initialize Notyf
        const notyf = new Notyf({
            duration: 5000,
            position: { x: 'right', y: 'top' },
            ripple: true,
            types: [
                {
                    type: 'info',
                    background: '#4f46e5',
                    icon: { className: 'bi bi-info-circle-fill', tagName: 'i', color: 'white' }
                },
                {
                    type: 'success',
                    background: '#10b981',
                    icon: { className: 'bi bi-check-circle-fill', tagName: 'i', color: 'white' }
                }
            ]
        });

        // Show session toasts
        @if(session('success'))
            notyf.success("{{ session('success') }}");
        @endif
        @if(session('error'))
            notyf.error("{{ session('error') }}");
        @endif

        // Real-time Notification Polling
        @auth
            function checkNotifications() {
                fetch("{{ route('notifications.latest') }}")
                    .then(response => response.json())
                    .then(notifications => {
                        notifications.forEach(notification => {
                            notyf.open({
                                type: notification.data.type === 'new_sale' ? 'success' : 'info',
                                message: notification.data.message
                            });
                        });
                    })
                    .catch(error => console.error('Error fetching notifications:', error));
            }

            // Check every 10 seconds
            setInterval(checkNotifications, 10000);
            // Initial check
            setTimeout(checkNotifications, 2000);
        @endauth
    </script>

    @yield('scripts')
</body>
</html>
