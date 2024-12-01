@extends('front.layouts.app')


@section('content')


<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
        <li class="breadcrumb-item"><a class="white-text" href="{{route('front.home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('front.shop')}}">Shop</a></li>
                    <li class="breadcrumb-item">{{$product->title}}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">

                        @if($product->product_images) @php
                                    $productImage = $product->product_images ? $product->product_images->first() : null;
                                @endphp
                            @foreach($product->product_images as $key => $productImage)
                            <div class="carousel-item {{($key == 0)? 'active' : ''}}">
                                <img class="w-100 h-100" src="{{asset('images/products/'.$productImage->image)}}" alt="Image">
                            </div>
                            @endforeach
                        @endif 
                            
                            
                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-light right">
                        <h1>{{$product->title}}</h1>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>

                        @if($product->compare_price>0)
                     
                        <h2 class="price text-secondary"><del>${{$product->compare_price}}</del></h2>
                        @endif
                        
                        <h2 class="price ">${{$product->price}}</h2>

                        {{$product->short_description}}
                      <div>  <a href="javascript:void(0)" onclick="addToCart({{$product->id}})" class="btn btn-dark">
    <i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART
</a></div>

                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                            </li>
                           
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                               {{$product->description}}
                            </div>
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                            {{$product->shipping_returns}}
                            
                        </div>
                    </div>
                </div> 
            </div>           
        </div>
    </section>

    <section class="pt-5 section-8">
    
</section>


@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
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