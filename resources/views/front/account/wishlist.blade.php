@extends('front.layouts.app')

@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">My Wishlist </li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('front.account.common.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Wishlist</h2>
                        </div>
                        <div class="card-body p-4">
                            @if($wishlists->isNotEmpty() )
                          
                            @foreach($wishlists as $wishlist)

                            <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom"    id="wishlist-item-{{ $wishlist->product ? $wishlist->product->id : 'default-id' }}">
    <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
        <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="#" style="width: 10rem;"> 
            @php
                $productImage = \App\Models\ProductImage::where('product_id', $wishlist->product_id)->first();
            @endphp
            @if (!empty($productImage->image) && file_exists(public_path('images/products/' . $productImage->image)))
                <img src="{{ asset('images/products/' . $productImage->image) }}" class="img-fluid" width="50">
            @else
                <span>No Image</span>
            @endif
        </a>
        <div class="pt-2">
            <h3 class="product-title fs-base mb-2">
                <a href="{{ $wishlist->product ? route('front.product', $wishlist->product->slug) : '#' }}">
                {{ $wishlist->product ? $wishlist->product->title : 'Default Title' }}
                </a>
            </h3>
            <div class="fs-lg text-accent pt-2">
            {{ optional($wishlist->product)->price ?? 'Default Price' }}

            </div>
        </div>
    </div>
    <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
        <divid="wishlist-item-{{ $wishlist->product ? $wishlist->product->id : 'default-id' }}" 
         class="wishlist-item">
            <button class="btn btn-outline-danger btn-sm" type="button" onclick="removeFromWishlist({{ $wishlist->product ? $wishlist->product->id : 'default-id' }})">
                <i class="fas fa-trash-alt me-2"></i>Remove
            </button>
        </div>
    </div>
</div>

                          @endforeach
                          
                            @endif
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function removeFromWishlist(productId) {
    if (!confirm('Are you sure you want to remove this item from your wishlist?')) {
        return;
    }

    $.ajax({
        url: '{{ route("front.removeFromWishlist") }}',
        type: 'POST',
        data: {
            product_id: productId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.status) {
                alert(response.message);
                // Remove the entire wishlist item (image, title, price, and remove button)
                $(`#wishlist-item-${productId}`).remove(); 
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            alert('There was an error while removing the product from the wishlist.');
        }
    });
}



</script>

@endsection