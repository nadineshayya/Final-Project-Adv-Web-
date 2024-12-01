<!DOCTYPE html>
<html class="no-js" lang="en_AU">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Thread & Trend Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

    <link rel="stylesheet" href="{{asset('front-assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">


	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />
	

	<link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/slick.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/slick-theme.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/video-js.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/ion.rangeSlider.min')}}" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/style.css')}}" />
    <style>

		
        /* Custom styling */
        .logo .text-outline {
            color: #ffffff; /* White text */
            -webkit-text-stroke: 1px #000080; /* Black border for WebKit browsers */
            text-stroke: 1px #000080; /* Black border for other browsers */
            font-weight: bold;
        }

		.logo .text-trend {
    color: #000080; /* Blue color for Trend */
    font-weight: bold;
}




        .search-cart-container {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .search-cart-container .input-group {
            width: 70%; /* Adjust search width */
            margin-right: 15px;
        }

        .search-cart-container .fa-search {
            color: #000080; /* Black search icon */
        }

        .right-nav a .fa-shopping-cart {
            color: #000080; /* Black cart icon */
        }

        .footer-section h3,
        .footer-section ul li a,
        .copyright-area p {
            color: #fff !important; /* White text */
        }

        .copyright-area {
            background-color: transparent !important; /* Remove background */
            padding: 15px 0;
        }
    </style>
</head>
<body>

<div class="bg-light top-header">
    <div class="container">
        <div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
		<div class="col-lg-4 logo text-center">
    		<a href="{{route('front.home')}}" class="text-decoration-none">
        <span class="h1 text-uppercase text-outline">Thread</span>
        <span class="h1 text-uppercase text-trend">& Trend</span>
   			 </a>
   		 <div class="underline"></div>
		</div>

            <div class="col-lg-6 search-cart-container">
            <a href="{{route('account.profile')}}" class="nav-link text-dark">My Account</a>
            <form action="{{route('front.shop')}}">					
					<div class="input-group">
					<form action="{{ route('front.shop') }}" method="GET" class="input-group">
    <input 
        type="text" 
        name="search" 
        value="{{ request('search') }}" 
        placeholder="Search For Products" 
        class="form-control"
        aria-label="Search"
    />
    <button type="submit" class="input-group-text">
        <i class="fa fa-search"></i>
    </button>
</form>

					</div>
				</form>
                <div class="right-nav">
                    <a href="{{route('front.cart')}}">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<header class="bg-primary">
    <div class="container">
        <nav class="navbar navbar-expand-xl" id="navbar">
            <a href="{{route('front.home')}}" class="text-decoration-none mobile-logo">
                <span class="h2 text-uppercase text-outline">Thread</span>
                <span class="h2 text-uppercase text-white">& Trend</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dynamic Categories -->
                    @if(getCategories()->isNotEmpty())
    @foreach(getCategories() as $category)
        <li class="nav-item dropdown">
            <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" style="color: #003366;">
                {{$category->name}}
            </button>
            @if(optional($category->sub_category)->isNotEmpty())
                <ul class="dropdown-menu">
                    @foreach($category->sub_category as $subCategory)
                        <li><a class="dropdown-item"  href="{{ route('front.shop', ['categorySlug' => $category->slug, 'subCategorySlug' => $subCategory->slug]) }}"  style="color: #003366;">{{$subCategory->name}}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
        
    @endforeach
@endif



                </ul>
            </div>
        </nav>
    </div>
</header>

<main>
    @yield('content')
</main>

<footer style="background-color: #f0f8ff; padding: 1.5rem 0; font-family: 'Poppins', sans-serif; font-size: 0.85rem;">
    <div class="container" style="max-width: 800px;">
        <!-- Logo Section -->
        <div class="row text-center mb-4">
            <div class="col-12">
                <h5 style="font-family: 'Montserrat', sans-serif; font-weight: bold; font-size: 1.5rem; color: #2c3e50; letter-spacing: 1px;">THREAD & TREND</h5>
            </div>
        </div>

        <!-- Links Section -->
        <div class="row text-center text-md-start align-items-start">
            <!-- Explore Section -->
            <div class="col-6 col-md-3">
                <h6 style="color: #2c3e50; font-weight: 600; font-size: 1rem; margin-bottom: 1rem;">Explore</h6>
                <ul class="list-unstyled" style="padding: 0; margin: 0;">
                    <li><a href="{{route('front.home')}}" style="color: #2c3e50; text-decoration: none;">Home</a></li>
                    <li><a href="{{route('account.profile')}}" style="color: #2c3e50; text-decoration: none;">Profile</a></li>
                    <li><a href="{{route('front.shop')}}" style="color: #2c3e50; text-decoration: none;">Shop</a></li>
                    <li><a href="{{route('front.cart')}}" style="color: #2c3e50; text-decoration: none;">Cart</a></li>
                </ul>
            </div>

            <!-- About Section -->
            <div class="col-6 col-md-3">
                <h6 style="color: #2c3e50; font-weight: 600; font-size: 1rem; margin-bottom: 1rem;">About</h6>
                <ul class="list-unstyled" style="padding: 0; margin: 0;">
                    <li><a href="{{route('front.aboutus')}}" style="color: #2c3e50; text-decoration: none;">Our Story</a></li>
                    <li><a href="{{route('front.contactus')}}" style="color: #2c3e50; text-decoration: none;">Contact Us</a></li>
                    <li><a href="{{route('front.contactus')}}" style="color: #2c3e50; text-decoration: none;">Location</a></li>
                </ul>
            </div>

            <!-- Get in Touch Section -->
            <div class="col-6 col-md-3">
                <h6 style="color: #2c3e50; font-weight: 600; font-size: 1rem; margin-bottom: 1rem;">Get in Touch</h6>
                <p style="color: #2c3e50; margin: 0;">+961 8137259</p>
                <p style="color: #2c3e50; margin: 0;">Thread&Trendlb@gmail.com</p>
            </div>

            <!-- Follow Us Section -->
            <div class="col-6 col-md-3 d-flex flex-column align-items-center align-items-md-end">
                <h6 style="color: #2c3e50; font-weight: 600; font-size: 1rem; margin-bottom: 1rem;">Follow Us</h6>
                <div class="d-flex justify-content-center justify-content-md-end">
                    <a href="#" style="color: #2c3e50; margin-right: 10px; font-size: 1.2rem;"><i class="fab fa-whatsapp"></i></a>
                    <a href="#" style="color: #2c3e50; margin-right: 10px; font-size: 1.2rem;"><i class="fab fa-tiktok"></i></a>
                    <a href="#" style="color: #2c3e50; margin-right: 10px; font-size: 1.2rem;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: #2c3e50; font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="row mt-4 pt-3" style="border-top: 1px solid #ddd;">
            <div class="col text-center">
                <p style="color: #7f8c8d; margin: 0; font-size: 0.75rem;">© 2024 Thread&Trend. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>

<script src="{{ asset('front-assets/js/custom.js') }}"></script>
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
};
$.ajaxSetup({
	headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>




<script src="{{asset('front-assets/js/bootstrap.bundle.min.js')}}"></script>
@yield('customJs')
</body>
</html>
