<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Shop :: Administrative Panel</title>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome from CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- AdminLTE JS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>

<!-- Dropzone CSS from CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">

<!-- Dropzone JS from CDN --><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>


<link rel="stylesheet" href="select2/css/select2.min.css">

<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text\javascript">

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
    $(".summernote").summernote();
})

</script>

   <style>
        /* Primary colors */
        :root {
            --cetacean-blue: #00004e;
            --navy-blue: #020082;
            --anti-flash-white: #ededf9;
        }

        /* Base Styles */
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background-color: var(--anti-flash-white);
        }
        .navbar, .sidebar {
            background-color: var(--cetacean-blue);
            color: var(--anti-flash-white);
        }
        .navbar .nav-link, .sidebar .nav-link {
            color: var(--anti-flash-white);
        }
        .navbar .nav-link:hover, .sidebar .nav-link:hover {
            background-color: var(--navy-blue);
        }
        .content-wrapper {
            padding: 20px;
            background-color: var(--anti-flash-white);
        }
        .small-box {
            background-color: var(--anti-flash-white);
            border: 2px solid var(--cetacean-blue);
            color: var(--cetacean-blue);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .small-box a {
            color: var(--navy-blue);
        }
        footer.main-footer {
            background-color: var(--cetacean-blue);
            color: var(--anti-flash-white);
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
    <img src="{{ asset('admin-assets/public/img/logo.png') }}" alt="Logo"/>


        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-expand-arrows-alt"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                    <img src="{{asset('public/logo.png')}}" class="rounded-circle" width="30" height="30" alt="User Image">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <span class="dropdown-item">{{Auth::guard('admin')->user()->name ?? 'Guest'}}</span>
                    <span class="dropdown-item">{{Auth::guard('admin')->user()->email ?? 'Guest'}}</span>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="fas fa-user-cog mr-2"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-lock mr-2"></i> Change Password</a>
                    <a class="dropdown-item text-danger" href="{{ route('admin.login')}}"><i class="fas fa-sign-out-alt mr-2"></i> Logout</a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
   
@include('admin.layouts.sidebar')
        <!-- Content Wrapper -->
        <div class="content-wrapper flex-grow-1">
          @yield('content')
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>&copy; 2024 Thread & Trend Store</strong>
    </footer>
    <script src="select2/js/select2.min.css"></script>
    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  
@yield('customJs')
</body>
</html>
