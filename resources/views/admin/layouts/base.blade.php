<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bagan Chiya Cafe Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        /* ==================== BASE RESET ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ==================== LAYOUT ==================== */
        body {
            font-family: 'Poppins', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(135deg, #f4f9f4 0%, #e8f5e9 100%);
            margin: 0;
            color: #1a3c34;
            min-height: 100vh;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #276a2a 0%, #1b5e20 100%);
            color: #ffffff;
            padding: 0;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            transition: width 0.3s ease;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.1);
        }

        .sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
        }

        .sidebar-logo i {
            font-size: 2.5em;
            color: #81c784;
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .sidebar-logo:hover i {
            transform: rotate(10deg) scale(1.1);
            background: rgba(255, 255, 255, 0.2);
        }

        .sidebar-brand {
            line-height: 1.2;
        }

        .sidebar-brand .brand-name {
            font-size: 1.8em;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: -0.01em;
        }

        .sidebar-brand .brand-subtitle {
            font-size: 1.1em;
            font-weight: 500;
            color: #c8e6c9;
            letter-spacing: 0.02em;
        }

        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #ffffff;
            color: #2e7d32;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .admin-badge:hover {
            transform: translateY(-2px);
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .sidebar-nav ul {
            list-style: none;
        }

        .sidebar-nav li {
            margin: 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 25px;
            color: #c8e6c9;
            text-decoration: none;
            font-size: 1em;
            font-weight: 500;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            border-left-color: #81c784;
            padding-left: 30px;
        }

        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-left-color: #ffffff;
            font-weight: 600;
        }

        .sidebar-nav a i {
            font-size: 1.2em;
            width: 24px;
            text-align: center;
            color: #81c784;
            transition: color 0.3s ease;
        }

        .sidebar-nav a:hover i,
        .sidebar-nav a.active i {
            color: #ffffff;
        }

        /* ==================== MAIN CONTENT ==================== */
        .main-wrapper {
            flex: 1;
            margin-left: 280px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: #ffffff;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-left h1 {
            font-size: 1.5em;
            color: #1a3c34;
            font-weight: 600;
        }

        .topbar-left .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .topbar-left .breadcrumb a {
            color: #2e7d32;
            text-decoration: none;
        }

        .topbar-left .breadcrumb a:hover {
            text-decoration: underline;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .topbar-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: #2e7d32;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 0.9em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .topbar-btn:hover {
            background: #1b5e20;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
        }

        .topbar-btn i {
            font-size: 1.1em;
        }

        .content-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        .content-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        /* ==================== RESPONSIVE DESIGN ==================== */
        /* Desktop (default: width >= 1024px) */
        @media (max-width: 1024px) {
            .sidebar {
                width: 240px;
            }

            .main-wrapper {
                margin-left: 240px;
            }

            .sidebar-logo i {
                font-size: 2.2em;
                padding: 12px;
            }

            .sidebar-brand .brand-name {
                font-size: 1.6em;
            }

            .sidebar-brand .brand-subtitle {
                font-size: 1em;
            }

            .admin-badge {
                font-size: 0.8em;
                padding: 7px 16px;
            }

            .sidebar-nav a {
                font-size: 0.95em;
                padding: 14px 20px;
            }

            .content-area {
                padding: 25px;
            }
        }

        /* Tablet (768px <= width < 1024px) */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .main-wrapper {
                margin-left: 80px;
            }

            .sidebar-header {
                padding: 20px 10px;
            }

            .sidebar-logo i {
                font-size: 2em;
                padding: 10px;
            }

            .sidebar-brand,
            .admin-badge {
                display: none;
            }

            .sidebar-nav a {
                justify-content: center;
                padding: 16px;
                gap: 0;
            }

            .sidebar-nav a span {
                display: none;
            }

            .sidebar-nav a i {
                font-size: 1.4em;
            }

            .sidebar-nav a:hover {
                padding-left: 16px;
            }

            .topbar {
                padding: 15px 20px;
            }

            .topbar-left h1 {
                font-size: 1.2em;
            }

            .content-area {
                padding: 20px;
            }
        }

        /* Mobile (width < 768px) */
        @media (max-width: 480px) {
            .sidebar {
                width: 60px;
            }

            .main-wrapper {
                margin-left: 60px;
            }

            .sidebar-header {
                padding: 15px 5px;
            }

            .sidebar-logo i {
                font-size: 1.8em;
                padding: 8px;
            }

            .sidebar-nav a {
                padding: 14px;
            }

            .sidebar-nav a i {
                font-size: 1.3em;
            }

            .topbar {
                padding: 12px 15px;
            }

            .topbar-left h1 {
                font-size: 1.1em;
            }

            .topbar-left .breadcrumb {
                display: none;
            }

            .topbar-btn {
                padding: 8px 12px;
                font-size: 0.85em;
            }

            .topbar-btn span {
                display: none;
            }

            .content-area {
                padding: 15px;
            }
        }

        /* ==================== SHARED COMPONENT STYLES ==================== */
        /* Section Container */
        .section {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border-left: none;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e8f5e9;
        }

        .section-title {
            font-size: 1.5em;
            color: #1a3c34;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #2e7d32;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-size: 0.9em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-primary {
            background: #2e7d32;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #1b5e20;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
        }

        .btn-secondary {
            background: #81c784;
            color: #ffffff;
        }

        .btn-secondary:hover {
            background: #66bb6a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(129, 199, 132, 0.3);
        }

        .btn-danger {
            background: #d32f2f;
            color: #ffffff;
        }

        .btn-danger:hover {
            background: #c62828;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
        }

        .btn-edit {
            background: #1976d2;
            color: #ffffff;
        }

        .btn-edit:hover {
            background: #1565c0;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.85em;
        }

        .btn-icon-only {
            padding: 8px;
            width: 36px;
            height: 36px;
            justify-content: center;
        }

        /* Action Buttons Group */
        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        /* Common Edit/Delete Button Styles */
        .edit-btn,
        .edit-hero-btn,
        .edit-title-btn,
        .edit-category-btn,
        .edit-item-btn,
        .edit-cta-btn,
        .edit-journey-btn,
        .edit-timeline-btn,
        .edit-mission-btn,
        .edit-values-title-btn,
        .edit-value-btn,
        .edit-team-title-btn,
        .edit-team-btn,
        .edit-testimonials-btn,
        .edit-special-offer-btn,
        .edit-additional-sections-btn,
        .edit-why-us-btn,
        .add-category-btn,
        .add-item-btn,
        .add-timeline-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #2e7d32 0%, #1b5e20 100%);
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 0.85em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .edit-btn:hover,
        .edit-hero-btn:hover,
        .edit-title-btn:hover,
        .edit-category-btn:hover,
        .edit-item-btn:hover,
        .edit-cta-btn:hover,
        .edit-journey-btn:hover,
        .edit-timeline-btn:hover,
        .edit-mission-btn:hover,
        .edit-values-title-btn:hover,
        .edit-value-btn:hover,
        .edit-team-title-btn:hover,
        .edit-team-btn:hover,
        .edit-testimonials-btn:hover,
        .edit-special-offer-btn:hover,
        .edit-additional-sections-btn:hover,
        .edit-why-us-btn:hover,
        .add-category-btn:hover,
        .add-item-btn:hover,
        .add-timeline-btn:hover {
            background: linear-gradient(135deg, #388e3c 0%, #2e7d32 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 125, 50, 0.3);
        }

        .delete-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #d32f2f 0%, #c62828 100%);
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 0.85em;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .delete-btn:hover {
            background: linear-gradient(135deg, #e53935 0%, #d32f2f 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(211, 47, 47, 0.3);
        }

        /* Button Icons */
        .edit-btn i,
        .delete-btn i,
        .edit-hero-btn i,
        .edit-title-btn i,
        .edit-category-btn i,
        .edit-item-btn i,
        .edit-cta-btn i,
        .add-category-btn i,
        .add-item-btn i,
        .add-timeline-btn i {
            font-size: 0.9em;
        }

        /* Item Actions - Special Layout for Menu Items */
        .item-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .item-actions > span {
            font-weight: 600;
            color: #2e7d32;
            font-size: 1em;
        }

        .item-actions > div {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .item-actions form {
            display: inline-flex;
            margin: 0;
        }

        /* Category Header Actions */
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .category-header h3 {
            margin: 0;
            font-size: 1.2em;
            color: #1a3c34;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .category-header .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        /* Cards */
        .card {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #1a3c34;
            font-size: 0.9em;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="number"],
        .form-group input[type="url"],
        .form-group input[type="password"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.9em;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #2e7d32;
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }

        table thead {
            background: #f5f5f5;
        }

        table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #1a3c34;
            border-bottom: 2px solid #e0e0e0;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        table tr:hover {
            background: #f9f9f9;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 0.85em;
            font-weight: 500;
        }

        .badge-success {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-info {
            background: #e3f2fd;
            color: #1976d2;
        }

        .badge-warning {
            background: #fff3e0;
            color: #f57c00;
        }

        .badge-danger {
            background: #ffebee;
            color: #d32f2f;
        }

        /* Alerts */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert i {
            font-size: 1.2em;
        }

        .alert-success {
            background: #e8f5e9;
            color: #2e7d32;
            border-left: 4px solid #2e7d32;
        }

        .alert-error {
            background: #ffebee;
            color: #d32f2f;
            border-left: 4px solid #d32f2f;
        }

        .alert-warning {
            background: #fff3e0;
            color: #f57c00;
            border-left: 4px solid #f57c00;
        }

        .alert-info {
            background: #e3f2fd;
            color: #1976d2;
            border-left: 4px solid #1976d2;
        }

        /* Overlays/Modals */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            backdrop-filter: blur(4px);
        }

        .overlay.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .overlay-content {
            background: #ffffff;
            border-radius: 12px;
            padding: 30px;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .overlay-content .close-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #f5f5f5;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .overlay-content .close-btn:hover {
            background: #d32f2f;
            color: #ffffff;
            transform: rotate(90deg);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
        }

        .empty-state i {
            font-size: 4em;
            color: #c8e6c9;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            margin-bottom: 10px;
            color: #1a3c34;
        }

        /* Loading State */
        .loading {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: #2e7d32;
        }

        .loading i {
            font-size: 2em;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Utility Classes */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mt-1 { margin-top: 10px; }
        .mt-2 { margin-top: 20px; }
        .mt-3 { margin-top: 30px; }
        .mb-1 { margin-bottom: 10px; }
        .mb-2 { margin-bottom: 20px; }
        .mb-3 { margin-bottom: 30px; }
        .p-1 { padding: 10px; }
        .p-2 { padding: 20px; }
        .p-3 { padding: 30px; }
    </style>
</head>

<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <i class="fas fa-leaf"></i>
                    <div class="sidebar-brand">
                        <div class="brand-name">Bagan</div>
                        <div class="brand-subtitle">Chiya Cafe</div>
                    </div>
                </div>
                <div class="admin-badge">
                    <i class="fas fa-user-shield"></i>
                    <span>Admin Panel</span>
                </div>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard.index') }}" class="{{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.menu.index') }}" class="{{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
                            <i class="fas fa-utensils"></i>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.story.index') }}" class="{{ request()->routeIs('admin.story.*') ? 'active' : '' }}">
                            <i class="fas fa-book-open"></i>
                            <span>Our Story</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gallery.index') }}" class="{{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                            <i class="fas fa-images"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.about.index') }}" class="{{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                            <i class="fas fa-info-circle"></i>
                            <span>About Us</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="main-wrapper">
            <!-- Top Bar -->
            <header class="topbar">
                <div class="topbar-left">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <div class="breadcrumb">
                        <a href="{{ route('admin.dashboard.index') }}"><i class="fas fa-home"></i> Home</a>
                        @yield('breadcrumb')
                    </div>
                </div>
                <div class="topbar-right">
                    <a href="{{ url('/') }}" target="_blank" class="topbar-btn">
                        <i class="fas fa-eye"></i>
                        <span>View Site</span>
                    </a>
                </div>
            </header>

            <!-- Content Area -->
            <main class="content-area">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="alert alert-success" style="margin: 20px 30px; padding: 15px 20px; background: #d4edda; border: 1px solid #c3e6cb; color: #155724; border-radius: 8px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-check-circle" style="font-size: 1.2em;"></i>
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" style="margin-left: auto; background: none; border: none; cursor: pointer; font-size: 1.2em; color: #155724; opacity: 0.7;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger" style="margin: 20px 30px; padding: 15px 20px; background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; border-radius: 8px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-exclamation-circle" style="font-size: 1.2em;"></i>
                        <span>{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" style="margin-left: auto; background: none; border: none; cursor: pointer; font-size: 1.2em; color: #721c24; opacity: 0.7;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger" style="margin: 20px 30px; padding: 15px 20px; background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; border-radius: 8px;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <i class="fas fa-exclamation-circle" style="font-size: 1.2em;"></i>
                            <strong>Please fix the following errors:</strong>
                            <button onclick="this.parentElement.parentElement.remove()" style="margin-left: auto; background: none; border: none; cursor: pointer; font-size: 1.2em; color: #721c24; opacity: 0.7;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <ul style="margin-left: 30px; list-style: disc;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')

    <script>
        // Auto-dismiss success alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const successAlerts = document.querySelectorAll('.alert-success');
            successAlerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-20px)';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>
</body>

</html>
