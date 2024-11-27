@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                <li class="breadcrumb-item">Cart</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-9 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table" id="cart">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                    <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        @if (!empty($productImage->image) && file_exists(public_path('images/products/' . $productImage->image)))
                                            <img src="{{ asset('images/products/' . $productImage->image) }}" class="img-thumbnail" width="50">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </div>









                                        <h2>{{ $item['title'] }}</h2>
                                    </div>
                                </td>
                                <td>${{ $item['price'] }}</td>
                                <td>
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1" onclick="updateQuantity({{ $item['id'] }}, 'decrease')">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm border-0 text-center" value="{{ $item['quantity'] }}" id="quantity-{{ $item['id'] }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1" onclick="updateQuantity({{ $item['id'] }}, 'increase')">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>

                                </td>
                   


                                <td id="total-price-{{ $item['id'] }}">
                                    ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                </td>


                                <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card cart-summery">
                    <div class="sub-title">
                        <h2 class="bg-white">Cart Summary</h2>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2">
                        <@php
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['quantity'] * $item['price'];
            }
        @endphp

<div>Subtotal</div>
<div id="subtotal">${{ number_format($subtotal, 2) }}</div>


                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <div>Shipping</div>
                            <div>${{ $shipping }}</div>
                        </div>
                        <div class="d-flex justify-content-between summery-end">
                        <td id="total-cart">
                        @php
                            $cart = session()->get('cart', []);
                            $total = 0;
                            foreach ($cart as $item) {
                                $total += $item['quantity'] * $item['price'];
                            }
                        @endphp

<div>Total</div>
<div id="total-price">${{ number_format($total, 2) }}</div>

                        </td>

                        </div>
                        <div class="pt-5">
                            <a href="{{route('front.checkout')}}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
                <div class="input-group apply-coupan mt-4">
                    <input type="text" placeholder="Coupon Code" class="form-control">
                    <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
function updateQuantity(productId, action) {
    let quantityInput = document.getElementById('quantity-' + productId);
    let currentQuantity = parseInt(quantityInput.value);
    let newQuantity = currentQuantity;

    if (action === 'increase') {
        newQuantity += 1;
    } else if (action === 'decrease' && currentQuantity > 1) {
        newQuantity -= 1;
    }

    $.ajax({
        url: "{{ route('front.updateQuantity') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            productId: productId,
            quantity: newQuantity,
        },
        success: function (response) {
            if (response.status) {
                // Update quantity input
                quantityInput.value = response.newQuantity;

                // Update item total price
                document.getElementById('total-price-' + productId).textContent = `$${response.itemTotal.toFixed(2)}`;

                // Update subtotal
                document.getElementById('subtotal').textContent = `$${response.subtotal.toFixed(2)}`;
            } else {
                alert('Failed to update quantity.');
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
}




</script>

@endsection