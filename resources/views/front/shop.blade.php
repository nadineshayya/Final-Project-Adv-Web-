@extends('front.layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar with Categories and Price Filter -->
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Categories</h2>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @if($categories->isNotEmpty())  
                                    @foreach($categories as $key => $category)
                                        <div class="accordion-item">
                                            @if($category->sub_category->isNotEmpty())
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $key }}" aria-expanded="false" aria-controls="collapseOne-{{ $key }}">
                                                        {{ $category->name }}
                                                    </button>
                                                </h2>
                                                <div id="collapseOne-{{ $key }}" class="accordion-collapse collapse {{ ($categorySelected == $category->id) ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="navbar-nav">
                                                            @foreach($category->sub_category as $subCategory)
                                                                <a href="{{ route('front.shop', [$category->slug, $subCategory->slug]) }}" class="nav-item nav-link {{ ($subCategorySelected == $category->id) ? 'text-primary' : '' }}">{{ $subCategory->name }}</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <a href="{{ route('front.shop', $category->slug) }}" class="nav-item nav-link  {{ ($subCategorySelected == $category->id) ? 'text-primary' : '' }}">{{ $category->name }}</a>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Price</h2>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="product-item" data-price="100"></div>
                            <label for="price-range-min">Minimum Price</label>
                            <input type="number" id="price-range-min" placeholder="0" value="0">

                            <label for="price-range-max">Maximum Price</label>
                            <input type="number" id="price-range-max" placeholder="1000" value="1000">

                            <button id="apply-filter">Apply Filter</button>
                        </div>
                    </div>
                </div>

                <!-- Sorting Dropdown -->
                <div class="col-md-9 d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">
                                Sorting
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#" id="sort-latest">Latest</a>
                                <a class="dropdown-item" href="#" id="sort-price-high">Price High</a>
                                <a class="dropdown-item" href="#" id="sort-price-low">Price Low</a>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-3" id="product-list">
                        @if($products->isNotEmpty())
                            @foreach($products as $product)
                                @php
                                    $productImage = $product->product_images ? $product->product_images->first() : null;
                                @endphp
                                <div class="col-md-4 product-item" data-price="{{ $product->price }}" data-date="{{ $product->created_at }}">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">
                                            <a href="#" class="product-img">
                                                @if (!empty($productImage->image) && file_exists(public_path('images/products/' . $productImage->image)))
                                                    <img src="{{ asset('images/products/' . $productImage->image) }}" class="card-img-top">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </a>
                                            <a class="whishlist" href="#"><i class="far fa-heart"></i></a>
                                            <div class="product-action">
                                                <a class="btn btn-dark" href="#">
                                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                                </a>
                                            </div>
                                        </div>
                                        <div class="card-body text-center mt-3">
                                            <a class="h6 link" href="#">{{ $product->title }}</a>
                                            <div class="price mt-2">
                                                <span class="h5"><strong>${{ $product->price }}</strong></span>
                                                @if($product->compare_price > 0)
                                                    <span class="h6 text-underline"><del>${{ $product->compare_price }}</del></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="col-md-12 pt-5">

                        {{$products->links()}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
document.getElementById("apply-filter").addEventListener("click", function () {
    // Get the minimum and maximum price values
    const priceMin = parseFloat(document.getElementById("price-range-min").value) || 0;
    const priceMax = parseFloat(document.getElementById("price-range-max").value) || 1000;

    // Iterate through all products and filter them
    document.querySelectorAll(".product-item").forEach(function (product) {
        const productPrice = parseFloat(product.getAttribute("data-price"));

        if (productPrice >= priceMin && productPrice <= priceMax) {
            product.style.display = "block"; // Show products within range
        } else {
            product.style.display = "none"; // Hide products outside range
        }
    });
});

// Sorting functionality
document.getElementById("sort-latest").addEventListener("click", function () {
    let products = Array.from(document.querySelectorAll(".product-item"));
    products.sort(function (a, b) {
        return new Date(b.getAttribute("data-date")) - new Date(a.getAttribute("data-date"));
    });
    products.forEach(function (product) {
        document.getElementById("product-list").appendChild(product);
    });
});

document.getElementById("sort-price-high").addEventListener("click", function () {
    let products = Array.from(document.querySelectorAll(".product-item"));
    products.sort(function (a, b) {
        return parseFloat(b.getAttribute("data-price")) - parseFloat(a.getAttribute("data-price"));
    });
    products.forEach(function (product) {
        document.getElementById("product-list").appendChild(product);
    });
});

document.getElementById("sort-price-low").addEventListener("click", function () {
    let products = Array.from(document.querySelectorAll(".product-item"));
    products.sort(function (a, b) {
        return parseFloat(a.getAttribute("data-price")) - parseFloat(b.getAttribute("data-price"));
    });
    products.forEach(function (product) {
        document.getElementById("product-list").appendChild(product);
    });
});
</script>
@endsection
