<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Bagan Chiya Cafe Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        /* ==================== VARIABLES ==================== */
        :root {
            --primary-green: #2e7d32;
            --dark-green: #1b5e20;
            --light-green: #81c784;
            --lighter-green: #c8e6c9;
            --cream: #f5f1e8;
            --cream-dark: #e8e1d3;
            --brown: #6d4c41;
            --dark-brown: #4e342e;
            --white: #ffffff;
            --text-dark: #1a3c34;
            --text-light: #6b7280;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* ==================== RESET ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* ==================== BODY ==================== */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f1e8 0%, #e8f5e9 50%, #f5f1e8 100%);
            color: var(--text-dark);
            min-height: 100vh;
            background-attachment: fixed;
        }

        /* Add coffee beans pattern overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(46, 125, 50, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(109, 76, 65, 0.03) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* ==================== SIDEBAR ==================== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-green) 0%, var(--dark-green) 100%);
            box-shadow: var(--shadow-lg);
            z-index: 1000;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        /* Custom Scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Sidebar Header */
        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            background: rgba(0, 0, 0, 0.15);
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        }

        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5em;
            color: var(--lighter-green);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            border: 3px solid rgba(255, 255, 255, 0.2);
        }

        .logo-icon:hover {
            transform: rotate(10deg) scale(1.1);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
        }

        .brand-text {
            color: var(--white);
        }

        .brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 1.8em;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 2px;
        }

        .brand-subtitle {
            font-size: 0.95em;
            font-weight: 400;
            color: var(--lighter-green);
            letter-spacing: 0.1em;
        }

        .admin-badge {
            margin-top: 15px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: var(--white);
            color: var(--primary-green);
            border-radius: 25px;
            font-size: 0.85em;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Navigation */
        .sidebar-nav {
            padding: 25px 0;
        }

        .nav-section {
            margin-bottom: 25px;
        }

        .nav-section-title {
            padding: 10px 25px;
            font-size: 0.75em;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--lighter-green);
            opacity: 0.8;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            margin: 2px 15px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: var(--white);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: var(--white);
            padding-left: 25px;
        }

        .nav-link:hover::before {
            transform: scaleY(1);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-icon {
            font-size: 1.2em;
            width: 24px;
            text-align: center;
        }

        /* ==================== MAIN CONTENT ==================== */
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* Top Bar */
        .topbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 40px;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .page-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-green), var(--light-green));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.3em;
            box-shadow: var(--shadow);
        }

        .page-title-group h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8em;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 3px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85em;
            color: var(--text-light);
        }

        .breadcrumb a {
            color: var(--primary-green);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: var(--dark-green);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9em;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
            text-decoration: none;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .action-btn.secondary {
            background: linear-gradient(135deg, var(--brown), var(--dark-brown));
        }

        /* Content Area */
        .content-area {
            padding: 40px;
        }

        /* ==================== CARDS ==================== */
        .card {
            background: var(--white);
            border-radius: 16px;
            padding: 30px;
            box-shadow: var(--shadow);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            border: 1px solid rgba(46, 125, 50, 0.1);
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--cream);
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5em;
            font-weight: 700;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-title i {
            color: var(--primary-green);
        }

        /* ==================== BUTTONS ==================== */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9em;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: var(--shadow);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: var(--white);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background: var(--cream);
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background: var(--cream-dark);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--light-green), var(--primary-green));
            color: var(--white);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: var(--white);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.85em;
        }

        /* ==================== FORMS ==================== */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.9em;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--cream-dark);
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95em;
            transition: all 0.3s ease;
            background: var(--white);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* ==================== GRID ==================== */
        .grid {
            display: grid;
            gap: 25px;
        }

        .grid-2 { grid-template-columns: repeat(2, 1fr); }
        .grid-3 { grid-template-columns: repeat(3, 1fr); }
        .grid-4 { grid-template-columns: repeat(4, 1fr); }

        @media (max-width: 1200px) {
            .grid-4 { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 992px) {
            .grid-3, .grid-4 { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .sidebar-header .brand-text,
            .sidebar-header .admin-badge,
            .nav-section-title,
            .nav-link span {
                display: none;
            }

            .logo-container {
                gap: 0;
            }

            .main-content {
                margin-left: 80px;
            }

            .nav-link {
                justify-content: center;
            }

            .grid-2, .grid-3, .grid-4 {
                grid-template-columns: 1fr;
            }

            .content-area {
                padding: 20px;
            }

            .topbar {
                padding: 15px 20px;
            }
        }

        /* ==================== UTILITIES ==================== */
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: 10px; }
        .gap-3 { gap: 15px; }
        .gap-4 { gap: 20px; }
        .mt-4 { margin-top: 20px; }
        .mb-4 { margin-bottom: 20px; }

        /* ==================== ANIMATIONS ==================== */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            animation: fadeIn 0.3s ease;
        }

        /* ==================== ALERTS ==================== */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border-left: 4px solid #059669;
        }

        .alert-error {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            border-left: 4px solid #dc2626;
        }

        .alert-info {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            border-left: 4px solid #3b82f6;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <div class="logo-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="brand-text">
                    <div class="brand-name">Bagan</div>
                    <div class="brand-subtitle">CHIYA CAFE</div>
                </div>
                <div class="admin-badge">
                    <i class="fas fa-user-shield"></i>
                    <span>Admin Panel</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section">
                <div class="nav-section-title">Main</div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard.index') }}" class="nav-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="nav-section">
                <div class="nav-section-title">Content</div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.menu.index') }}" class="nav-link {{ request()->routeIs('admin.menu.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-mug-hot"></i>
                            <span>Menu</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.story.index') }}" class="nav-link {{ request()->routeIs('admin.story.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book-open"></i>
                            <span>Our Story</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.gallery.index') }}" class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-images"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.about.index') }}" class="nav-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <span>Visit Us</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.home-sections.index') }}" class="nav-link {{ request()->routeIs('admin.home-sections.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <span>Home Sections</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <header class="topbar">
            <div class="page-header">
                <div class="page-icon">
                    <i class="@yield('page-icon', 'fas fa-th-large')"></i>
                </div>
                <div class="page-title-group">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <div class="breadcrumb">
                        <a href="{{ route('admin.dashboard.index') }}"><i class="fas fa-home"></i> Home</a>
                        @yield('breadcrumb')
                    </div>
                </div>
            </div>
            <div class="topbar-actions">
                <a href="{{ url('/') }}" target="_blank" class="action-btn">
                    <i class="fas fa-external-link-alt"></i>
                    <span>View Site</span>
                </a>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
