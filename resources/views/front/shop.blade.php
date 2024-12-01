@extends('front.layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
<style>
    /* Sidebar and filter styles */
    .sidebar {
        background-color: #f9f9f9;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .sidebar h2 {
        font-size: 1.4rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
    .accordion-button {
        font-size: 1rem;
    }
    .filter-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        padding: 1rem;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .filter-bar select, .filter-bar input[type="number"], .filter-bar button {
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-size: 0.9rem;
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
    .price del {
        color: #999;
        margin-left: 0.5rem;
    }
</style>

<main>
    <!-- Breadcrumb Section -->
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar for Categories -->
                <div class="col-md-3">
                    <div class="sidebar">
                        <h2>Categories</h2>
                        <div class="card">
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionExample">
                                    @if($categories->isNotEmpty())
                                        @foreach($categories as $key => $category)
                                            <div class="accordion-item">
                                                @if($category->sub_category->isNotEmpty())
                                                    <h2 class="accordion-header" id="heading-{{ $key }}">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $key }}">
                                                            {{ $category->name }}
                                                        </button>
                                                    </h2>
                                                    <div id="collapse-{{ $key }}" class="accordion-collapse collapse">
                                                        <div class="accordion-body">
                                                            @foreach($category->sub_category as $subCategory)
                                                            <a href="{{ route('front.shop', [$category->slug, $subCategory->slug]) }}"
   class="nav-link {{ ($subCategorySelected == $subCategory->id) ? 'text-primary' : '' }}">
   {{ $subCategory->name }}
</a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @else
                                                    <a href="{{ route('front.shop', $category->slug) }}" class="nav-link">
                                                        {{ $category->name }}
                                                    </a>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content: Filter Bar and Products -->
                <div class="col-md-9">
                    <div class="filter-bar">
                        <h2>Filters:</h2>
                        <select id="categories-list">
                            <option value="latest" data-sort="latest">Latest</option>
                            <option value="price-high" data-sort="price-high">Price High</option>
                            <option value="price-low" data-sort="price-low">Price Low</option>
                        </select>
                        <div>
                            <label for="price-range-min">Min Price</label>
                            <input type="number" id="price-range-min" placeholder="0">
                        </div>
                        <div>
                            <label for="price-range-max">Max Price</label>
                            <input type="number" id="price-range-max" placeholder="1000">
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
                                            <a href="{{ route('front.product', $product->slug) }}">
                                                @if (!empty($productImage->image) && file_exists(public_path('images/products/' . $productImage->image)))
                                                    <img src="{{ asset('images/products/' . $productImage->image) }}">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="card-body text-center mt-3">
                                            <a class="h6 link" href="#">{{ $product->title }}</a>
                                            <div class="price mt-2">
                                                ${{ $product->price }}
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

        products.forEach((product) => productList.appendChild(product));
    });

    // Filtering functionality
    applyFilterButton.addEventListener('click', function () {
        const priceMin = parseFloat(document.getElementById('price-range-min').value) || 0;
        const priceMax = parseFloat(document.getElementById('price-range-max').value) || 1000;

        document.querySelectorAll('.product-item').forEach(function (product) {
            const productPrice = parseFloat(product.getAttribute('data-price'));

            if (productPrice >= priceMin && productPrice <= priceMax) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });
});
</script>
@endsection
