@extends('front.layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
<style>
    /* Main container */
    .filter-bar {
        background-color: #ffffff;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        align-items: center;
    }

    /* Section titles */
    .filter-bar h2 {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
        margin: 0;
        margin-right: 1rem;
        padding-bottom: 0.5rem;
    }

    /* Dropdowns and Buttons */
    .filter-bar select,
    .filter-bar input[type="number"],
    .filter-bar button {
        padding: 0.6rem 1rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #fff;
        color: #333;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .filter-bar select:focus,
    .filter-bar input[type="number"]:focus,
    .filter-bar button:focus {
        outline: none;
        border-color: #007BFF; /* Blue focus */
    }

    .filter-bar button {
        background-color: #000080; /* Blue button */
        color: #fff;
        cursor: pointer;
    }

    .filter-bar button:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }

    /* Highlight selected sorting */
    .selected-sort {
        font-weight: bold;
        color: #007BFF;
    }

    /* Product items */
    .product-item {
        margin-bottom: 2rem;
    }

    .product-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }

    .product-image img {
        width: 100%;
        height: auto;
    }

    .product-card .card-body {
        padding: 1rem;
    }

    .product-card .price {
        color: #007BFF; /* Blue price */
        font-weight: bold;
        font-size: 1.2rem;
    }

    .product-card .price del {
        color: #999;
        margin-left: 0.5rem;
    }

    .product-card .product-action .btn-dark {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 0.8rem 1rem;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .product-card .product-action .btn-dark:hover {
        background-color: #007BFF;
        color: #fff;
    }

    
</style>

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
            <!-- Horizontal Filter Bar -->
            <div class="filter-bar">
                <h2>Filters:</h2>

                <!-- Categories Dropdown -->
                <select id="categories-list">
                    <option value="latest" data-sort="latest">Latest</option>
                    <option value="price-high" data-sort="price-high">Price High</option>
                    <option value="price-low" data-sort="price-low">Price Low</option>
                </select>

                <!-- Price Filter -->
                <div>
                    <label for="price-range-min">Min Price</label>
                    <input type="number" id="price-range-min" placeholder="0" value="0">
                </div>

                <div>
                    <label for="price-range-max">Max Price</label>
                    <input type="number" id="price-range-max" placeholder="1000" value="1000">
                </div>

                <button id="apply-filter">Apply Filter</button>
            </div>

            <!-- Product List -->
            <div class="row pb-3 mt-4" id="product-list">
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
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="#">{{ $product->title }}</a>
                                    <div class="price mt-2">
                                        <span>${{ $product->price }}</span>
                                        @if($product->compare_price > 0)
                                            <del>${{ $product->compare_price }}</del>
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
    </section>
</main>
@endsection

@section('customJs')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const productList = document.getElementById('product-list');
    const sortSelect = document.getElementById('categories-list');
    const applyFilterButton = document.getElementById('apply-filter');

    // Sorting functionality
    sortSelect.addEventListener('change', function () {
        const sortType = sortSelect.value;
        let products = Array.from(productList.querySelectorAll('.product-item'));

        if (sortType === 'latest') {
            products.sort((a, b) => new Date(b.getAttribute('data-date')) - new Date(a.getAttribute('data-date')));
        } else if (sortType === 'price-high') {
            products.sort((a, b) => parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price')));
        } else if (sortType === 'price-low') {
            products.sort((a, b) => parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price')));
        }

        // Append sorted products back to the product list
        products.forEach((product) => productList.appendChild(product));
    });

    // Filtering functionality
    applyFilterButton.addEventListener('click', function () {
        const priceMin = parseFloat(document.getElementById('price-range-min').value) || 0;
        const priceMax = parseFloat(document.getElementById('price-range-max').value) || 1000;

        document.querySelectorAll('.product-item').forEach(function (product) {
            const productPrice = parseFloat(product.getAttribute('data-price'));

            if (productPrice >= priceMin && productPrice <= priceMax) {
                product.style.display = 'block'; // Show products within range
            } else {
                product.style.display = 'none'; // Hide products outside range
            }
        });
    });
});
</script>
@endsection
