<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyCompany')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        :root {
            --primary-color: #2c5530;
            --secondary-color: #4a7c59;
            --accent-color: #8a9b6e;
            --success-color: #38a169;
            --warning-color: #d69e2e;
            --danger-color: #e53e3e;
            --dark-color: #2d3748;
            --light-color: #f7fafc;
            --gray-color: #718096;
            --neutral-dark: #1a202c;
            --neutral-light: #e2e8f0;
            --bronze: #b38e5d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
            padding-top: 70px;
            color: var(--dark-color);
            line-height: 1.6;
        }

        /* Professional Navbar */
        .navbar-professional {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--neutral-light);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
        }

        .navbar-professional .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .company-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .logo-text {
            color: var(--dark-color);
            font-weight: 700;
            font-size: 1.4rem;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-link {
            color: var(--dark-color) !important;
            text-decoration: none;
            font-weight: 500;
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background: rgba(44, 85, 48, 0.08);
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            background: rgba(44, 85, 48, 0.12);
            font-weight: 600;
        }

        .nav-link i {
            margin-right: 8px;
            font-size: 0.9em;
            width: 16px;
            text-align: center;
        }

        /* Professional Banner */
        .banner-header {
            position: relative;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            overflow: hidden;
        }

        .banner-header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('<?php echo asset('images/employee_background.jpg'); ?>') center/cover;
            opacity: 0.15;
        }

        .banner-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 2rem;
        }

        .banner-header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: -0.5px;
        }

        .banner-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            font-weight: 400;
        }

        /* Professional Floating Card */
        .floating-card {
            position: relative;
            margin-top: -80px;
            padding: 2.5rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.08),
                0 5px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .floating-card:hover {
            transform: translateY(-2px);
            box-shadow:
                0 20px 45px rgba(0, 0, 0, 0.12),
                0 8px 20px rgba(0, 0, 0, 0.06);
        }

        /* Professional Table */
        .table-professional {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--neutral-light);
        }

        .table-professional thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .table-professional th {
            border: none;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            text-transform: uppercase;
        }

        .table-professional td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--neutral-light);
            vertical-align: middle;
            color: var(--dark-color);
        }

        .table-professional tbody tr {
            transition: all 0.2s ease;
        }

        .table-professional tbody tr:hover {
            background: rgba(44, 85, 48, 0.04);
        }

        .table-professional tbody tr:last-child td {
            border-bottom: none;
        }

        /* Professional Buttons */
        .btn-professional {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            letter-spacing: 0.3px;
        }

        .btn-primary-professional {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .btn-primary-professional:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(44, 85, 48, 0.3);
            color: white;
        }

        .btn-outline-professional {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
        }

        .btn-outline-professional:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Action Buttons */
        .btn-action {
            padding: 0.5rem;
            border-radius: 6px;
            border: 1px solid var(--neutral-light);
            background: white;
            color: var(--gray-color);
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
        }

        .btn-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-view:hover {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-edit:hover {
            color: var(--warning-color);
            border-color: var(--warning-color);
        }

        .btn-delete:hover {
            color: var(--danger-color);
            border-color: var(--danger-color);
        }

        /* Professional Alert */
        .alert-professional {
            border: none;
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .alert-success {
            border-left-color: var(--success-color);
            color: #22543d;
            background: rgba(56, 161, 105, 0.08);
        }

        .alert-danger {
            border-left-color: var(--danger-color);
            color: #742a2a;
            background: rgba(229, 62, 62, 0.08);
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            padding: 1.75rem;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            border-left: 4px solid var(--primary-color);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        .stat-card i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            line-height: 1;
        }

        .stat-label {
            color: var(--gray-color);
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: var(--gray-color);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .banner-header {
                height: 280px;
            }

            .banner-header h1 {
                font-size: 2.25rem;
            }

            .banner-header p {
                font-size: 1rem;
            }

            .floating-card {
                margin-top: -60px;
                padding: 1.5rem;
                margin-left: 1rem;
                margin-right: 1rem;
            }

            .nav-links {
                gap: 0.5rem;
            }

            .nav-link {
                padding: 0.6rem 0.8rem;
                font-size: 0.85rem;
            }

            .nav-link i {
                margin-right: 4px;
            }
        }

        @media (max-width: 576px) {
            .banner-header h1 {
                font-size: 1.75rem;
            }

            .floating-card {
                margin-top: -40px;
                padding: 1.25rem;
            }

            .table-professional th,
            .table-professional td {
                padding: 1rem 0.75rem;
            }

            .logo-text {
                font-size: 1.1rem;
            }
        }

        /* Pagination */
        .pagination-professional .page-link {
            border: 1px solid var(--neutral-light);
            color: var(--dark-color);
            padding: 0.5rem 1rem;
        }

        .pagination-professional .page-item.active .page-link {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }

        .pagination-professional .page-link:hover {
            background: rgba(44, 85, 48, 0.1);
            border-color: var(--primary-color);
            color: var(--primary-color);
        }
    </style>
</head>

<body>
    <!-- Professional Navbar -->
    <nav class="navbar-professional fixed-top">
        <div class="container">
            <a href="{{ url('/') }}" class="company-logo">
                <div class="logo-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="logo-text">MyCompany</div>
            </a>
            <div class="nav-links">
                <a href="{{ route('employees.index') }}" class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>Employees
                </a>
                <a href="{{ route('departments.index') }}" class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                    <i class="fas fa-sitemap"></i>Departments
                </a>
                <a href="{{ route('positions.index') }}" class="nav-link {{ request()->routeIs('positions.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>Positions
                </a>
                <a href="{{ route('attendance.index') }}" class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}">
                    <i class="fas fa-clock"></i>Attendance
                </a>
                <a href="{{ route('salaries.index') }}" class="nav-link {{ request()->routeIs('salaries.*') ? 'active' : '' }}">
                    <i class="fas fa-money-bill-wave"></i>Salaries
                </a>
            </div>
        </div>
    </nav>

    <!-- Professional Banner -->
    <div class="banner-header">
        <div class="banner-content">
            <h1>@yield('page-title', 'Employee Management System')</h1>
            <p>@yield('page-subtitle', 'Streamlined workforce management for modern organizations')</p>
        </div>
    </div>

    <!-- Professional Floating Card -->
    <div class="container">
        <div class="floating-card">
            @if(session('success'))
            <div class="alert alert-success alert-professional alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-professional alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Content Section -->
            <div class="content-section">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>