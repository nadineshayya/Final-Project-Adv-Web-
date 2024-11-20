<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Shop :: Administrative Panel</title>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('customCss')
    <style>
        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Navbar Styling */
        .navbar {
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Sidebar Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #f8f9fa;
            color: #212529;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            padding: 10px 0;
        }

        .sidebar .h5 {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .sidebar .nav-item {
            padding: 10px 20px;
            font-size: 1rem;
            color: #212529;
        }

        .sidebar .nav-item:first-child {
            background-color: navy;
            color: white;
            border-radius: 0.25rem;
        }

        .sidebar .nav-item:first-child a {
            color: white;
        }

        /* Content Wrapper */
        .content-wrapper {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }

        /* Full-Width Content Adjustment */
        .full-width {
            margin-left: 0;
            width: calc(100% - 250px);
        }

        /* Footer Styling */
        footer.main-footer {
            background-color: #003f88; /* Blue background */
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed; /* Make footer fixed */
            bottom: 0;
            width: calc(100% - 250px); /* Account for sidebar */
            margin-left: 250px; /* Align with sidebar */
            z-index: 10; /* Ensure it stays above other elements */
        }

        @media (max-width: 767px) {
            .content-wrapper {
                margin-left: 0;
            }

            footer.main-footer {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img" style="max-width: 50px; height: auto;">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-expand-arrows-alt"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                    <img src="{{ asset('public/logo.png') }}" class="rounded-circle" width="30" height="30" alt="User Image">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <span class="dropdown-item">{{ Auth::guard('admin')->user()->name ?? 'Guest' }}</span>
                    <span class="dropdown-item">{{ Auth::guard('admin')->user()->email ?? 'Guest' }}</span>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="fas fa-user-cog mr-2"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-lock mr-2"></i> Change Password</a>
                    <a class="dropdown-item text-danger" href="{{ route('admin.login') }}"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>&copy; 2024 Thread & Trend Store</strong>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    @yield('customJs')
</body>
</html>