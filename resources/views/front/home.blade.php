@extends('front.layouts.app')

@section('content')

<style>
  /* Free Shipping Bar with specific ID */
  #free-shipping-bar {
      position: absolute;
      width: 100%;
      padding: 10px;
      background-color: #0000FF; /* Blue background */
      color: #fff;
      text-align: center;
      font-size: 0.9rem;
      font-weight: bold;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      transform: translateY(-40px); /* Move it down to create spacing */
  }

  .section-2 {
      margin-top: 60px; /* Adjust the section below it */
  }

  #free-shipping-bar .spacer {
      margin: 0 10px; /* Reduced spacing */
      flex-grow: 0; /* Prevents spacer from expanding */
  }

  /* Remove grey area under image */
  .carousel-item {
      margin: 0;
      padding: 0;
      background-color: transparent !important;
  }

  .carousel-item img {
      margin-bottom: 0;
      padding-bottom: 0;
      width: 100%;
      height: auto;
      display: block;
  }

  /* Icon Styling - Blue */
  .box .fa {
      color: #000080 !important; /* Set icons to blue */
  }

  /* Get the Look Section Styling */
  .get-the-look-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background-color: white; 
      color: #000080; /* Blue text */
      font-family: 'Poppins', sans-serif; /* Apply Poppins font */
      margin-top: 60px;
      margin-bottom: 40px; /* Add margin to the bottom */
  }

  .get-the-look-text h2 {
      font-size: 2rem;
      font-weight: bold;
      margin: 0;
      padding-right: 20px;
      color: #000080; /* Blue text */
  }

  .get-the-look-text p {
      font-size: 0.9rem;
      font-weight: normal;
      margin: 5px 0 0;
      color: #000080; /* Blue text */
  }

  .get-the-look-text strong {
      font-weight: bold;
      color: #000080; /* Blue text */
  }

  /* Section Title Styling - Blue */
  .section-title {
      font-size: 2rem;
      font-weight: bold;
      color: #000080; /* Set titles to blue */
      position: relative;
      text-transform: uppercase;
      text-align: left;
  }

  .section-title::after {
      content: "";
      width: 50px;
      height: 3px;
      background-color: #FFC107; /* Yellow underline */
      position: absolute;
      bottom: -10px;
      left: 0;
  }

  .customer-reviews-section {
      text-align: center;
      margin: 60px auto;
      padding: 40px 20px;
      background-color: #f9f9f9;
      border-radius: 10px;
      max-width: 1000px;
      box-shadow: 0 4px 12px rgba(0, 0, 255, 0.1); /* Blue shadow */
  }

  .customer-reviews-section .section-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: #000080;
    margin-bottom: 30px;
}

.reviews-container {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.review-card {
    width: 300px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.review-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    color: #000080;
}

.review-header h3 {
    font-size: 1.2rem;
    color: #333;
    margin: 0;
}

.rating {
    font-size: 1.2rem;
    color: #FFD700; /* Gold color for stars */
}

.review-text {
    font-size: 0.95rem;
    color: #000080;
    line-height: 1.5;
    margin: 0;
    font-style: italic;
}

</style>


<section class="section-1">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <picture>
                    <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/Untitled design.png') }}" />
                    <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/Untitled design.png') }}" />
                    <img src="{{ asset('front-assets/images/Untitled design.png') }}" alt="" />
                </picture>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Womens Fashion</h1>
                        <p class="mx-md-5 px-5">"Discover elegant and chic styles in our women’s fashion collection, tailored to elevate your look!"</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('front.shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <picture>
                    <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/Untitled design (1).png') }}" />
                    <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/Untitled design (1).png') }}" />
                    <img src="{{ asset('front-assets/images/Untitled design (1).png') }}" alt="Carousel Image" />
                </picture>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Mens Fashion</h1>
                        <p class="mx-md-5 px-5">"Explore our new men's collection"</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('front.shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <picture>
                    <source media="(max-width: 799px)" srcset="{{ asset('front-assets/images/Untitled design (2).png') }}" />
                    <source media="(min-width: 800px)" srcset="{{ asset('front-assets/images/Untitled design (2).png') }}" />
                    <img src="{{ asset('front-assets/images/Untitled design (2).png') }}" alt="" />
                </picture>
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Kids Fashion</h1>
                        <p class="mx-md-5 px-5">"Explore an enchanting range of kids' clothing designed for comfort and style!"</p>
                        <a class="btn btn-outline-light py-2 px-4 mt-3" href="{{route('front.shop')}}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Free Shipping Bar -->
<div id="free-shipping-bar" class="shipping-bar">
    <span>NEW COLLECTION ARRIVAL</span>
    <span class="spacer"></span>
    <span>SAVE THE DATE</span>
    <span class="spacer"></span>
    <span>12/12/2024</span>
</div>

<section class="section-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-check text-dark m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Quality Product</h2>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-shipping-fast text-dark m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-exchange-alt text-dark m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-phone-volume text-dark m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">24/7 Support</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Get the Look Section -->
<div class="get-the-look-section">
    <div class="get-the-look-text">
        <h2>→ GET THE LOOK</h2>
        <p>GET INSPIRATION FROM OUR GALLERY AND SHARE YOUR LOOKS ON SOCIAL MEDIA WITH <strong>@Thread & Trend</strong> AND <strong>#Thread&TrendSTYLE</strong>.</p>
    </div>
</div>


<section class="section-4 pt-5">
    <div class="container">
        <div class="section-title">
            Featured Products
        </div>
        <div class="row pb-3">
            @if($featuredProducts->isNotEmpty())
                @foreach($featuredProducts as $product)
                    @php
                        $productImage = $product->product_images ? $product->product_images->first() : null;
                    @endphp
                    <div class="col-md-3 d-flex">
                        <div class="card product-card h-100">
                            <div class="product-image position-relative">
                                <a href="{{route('front.product', $product->slug)}}" class="product-img">
                                    @if (!empty($productImage->image) && file_exists(public_path('images/products/' . $productImage->image)))
                                        <img src="{{ asset('images/products/' . $productImage->image) }}" class="img-thumbnail" width="50" >
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </a>
                                <a href="javascript:void(0);" class="wishlist" onclick="addToWishlist({{ $product->id }})">
                                    <i class="far fa-heart"></i>
                                </a>
                                <div class="product-action">
                                <a href="javascript:void(0)" onclick="addToCart({{$product->id}})" class="btn btn-dark">
    <i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART
</a>
                                </div>
                            </div>
                            <div class="card-body text-center mt-3">
                                <a class="h6 link" href="product.php">{{$product->title}}</a>
                                <div class="price mt-2">
                                    <span class="h5"><strong>${{$product->price}}</strong></span>
                                    @if($product->compare_price > 0)
                                        <span class="h6 text-underline"><del>{{$product->compare_price}}</del></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>


<section class="section-4 pt-5">
<div class="container">
    <div class="section-title">
        Latest Products
    </div>
    <div class="row pb-3">
        @if($latestproducts->isNotEmpty())
            @foreach($latestproducts as $product)
                @php
                    $productImage = $product->product_images ? $product->product_images->first() : null;
                @endphp
                <div class="col-md-3">
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="{{ route('front.product', $product->slug) }}" class="product-img">
                                @if (!empty($productImage->image) && file_exists(public_path('images/products/' . $productImage->image)))
                                    <img src="{{ asset('images/products/' . $productImage->image) }}" class="img-thumbnail" width="50">
                                @else
                                    <span>No Image</span>
                                @endif
                            </a>
                            <a href="javascript:void(0);" class="wishlist" onclick="addToWishlist({{ $product->id }})">
                                    <i class="far fa-heart"></i>
                                </a>
                            <div class="product-action">
                            <a href="javascript:void(0)" onclick="addToCart({{$product->id}})" class="btn btn-dark">
    <i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART
</a>
                            </div>
                        </div>
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="product.php">{{ $product->title }}</a>
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
    </div>
</div>


<!-- Customer Reviews Section -->
<div class="customer-reviews-section">
    <h2 class="section-title" style=" color:#000080">Customer Reviews</h2>
    <div class="reviews-container">
        <div class="review-card">
            <div class="review-header">
                <h3>John Doe</h3>
                <div class="rating">
                    ★★★★☆
                </div>
            </div>
            <p class="review-text">
                "Absolutely love this product! The quality is fantastic, and it arrived right on time. Will definitely be purchasing again."
            </p>
        </div>
        
        <div class="review-card">
            <div class="review-header">
                <h3>Jane Smith</h3>
                <div class="rating">
                    ★★★★★
                </div>
            </div>
            <p class="review-text">
                "Amazing experience! The customer service was excellent, and I’m thrilled with my purchase. Highly recommend!"
            </p>
        </div>

        <div class="review-card">
            <div class="review-header">
                <h3>Alex Johnson</h3>
                <div class="rating">
                    ★★★☆☆
                </div>
            </div>
            <p class="review-text">
                "Good product, but the shipping took longer than expected. Overall, satisfied with the purchase."
            </p>
        </div>
    </div>
</div>


</section>
@endsection
@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>function addToWishlist(productId) {
    $.ajax({
        url: '{{ route("front.addToWishlist") }}',
        type: 'POST',
        data: {
            product_id: productId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.status) {
                alert(response.message);
               

            } else {
                alert(response.message);
                window.location.href = "{{ route('account.login') }}";
            }
        },
        error: function(xhr, status, error) {
            alert('Error while adding product to wishlist.');
        }
    });
}

   function addToCart(productId) {
    // Make AJAX request to the server to add the product to the cart
    $.ajax({
        url: '{{route("front.addToCart")}}',  // Assuming your add to cart route is '/cart'
        type: 'POST',
        data: {
            product_id: productId,
            _token: '{{ csrf_token() }}'  // Include CSRF token for security
        },
        success: function(response) {
            // Handle success response
            if (response.status) {
                // Update the cart count or any other element if needed
                alert(response.message);  // You can show a success message
               window.location.href= "{{route('front.cart')}}"
            } else {
                alert(response.message);  // Show error message if product could not be added
            }
        },
        error: function(xhr, status, error) {
            // Handle error response
            console.error('Error:', error);
            alert('There was an error while adding the product to the cart.');
        }
    });
}


</script>
@endsection