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
        /* Sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #f8f9fa;
            padding: 20px 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-link {
            font-size: 1rem;
            color: #333;
            margin-bottom: 10px;
            padding: 10px 15px;
            border-radius: 8px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar .nav-link:hover {
            background: #000080;
            color: #fff;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .content-section {
            margin-left: 260px; /* Adjust based on sidebar width */
            padding: 20px;
        }

        /* Responsive styling */
        @media (max-width: 992px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                box-shadow: none;
            }

            .content-section {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Content Wrapper -->
        <div class="content-section flex-grow-1 bg-light">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
