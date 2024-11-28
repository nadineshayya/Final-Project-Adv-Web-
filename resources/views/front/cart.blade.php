@extends('front.layouts.app')

@section('content')
<style>
   body {
    background-color: #f9f9f9;
    font-family: 'Arial', sans-serif;
}

.shopping-cart-container {
    padding: 2rem 0;
}

.shopping-cart {
    background: #ffffff;
    padding: 2rem;
    border-radius: 8px;
    display: flex;
    flex-wrap: wrap;
    gap: 2rem;
    box-shadow: 0 4px 10px rgba(0, 0, 128, 0.1); /* Blue shadow */
}

.cart-items {
    flex: 2;
}

.order-summary {
    flex: 1;
    padding: 1.5rem;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background: #ffffff;
    box-shadow: 0 4px 10px rgba(0, 0, 128, 0.1); /* Blue shadow */
}

.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.cart-header h3 {
    font-size: 1.8rem;
    margin: 0;
    font-weight: bold;
    color: #000080; /* Blue text */
}

.cart-header span {
    font-size: 1rem;
    color: #666;
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
}

.cart-table th {
    background-color: #f5f5f5;
    font-weight: bold;
    padding: 1rem;
    text-align: left;
    color: #555;
    border-bottom: 2px solid #ddd;
}

.cart-table td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #eee;
}

.cart-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.cart-item img {
    width: 60px;
    height: 60px;
    border-radius: 5px;
    object-fit: cover;
}

.item-info h5 {
    margin: 0;
    font-size: 1.1rem;
    color: #000080; /* Blue text */
}

.item-info a {
    color: #ff4d4d; /* Red for remove link */
    font-size: 0.9rem;
    text-decoration: none;
}

.quantity-control {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quantity-control button {
    background: #f0f0f0;
    border: 1px solid #ddd;
    padding: 0.5rem 1rem;
    cursor: pointer;
    border-radius: 4px;
}

.quantity-control button:hover {
    background-color: #ddd;
}

.quantity-control input {
    width: 40px;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.order-summary h4 {
    font-size: 1.6rem;
    margin-bottom: 1.5rem;
    color: #000080; /* Blue text */
}

.summary-details p {
    display: flex;
    justify-content: space-between;
    margin: 0.5rem 0;
    font-size: 1rem;
    color: #555;
}

.summary-details p span {
    font-weight: bold;
    color: #000080; /* Blue text */
}

.promo-code {
    margin-top: 1.5rem;
    display: flex;
    gap: 1rem;
}

.promo-code input {
    flex: 1;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.promo-code button {
    background-color: #000080; /* Blue background */
    color: #ffffff;
    border: none;
    border-radius: 4px;
    padding: 0.8rem;
    cursor: pointer;
    font-size: 1rem;
}

.promo-code button:hover {
    background-color: #333; /* Darker blue on hover */
}

.checkout-btn {
    display: block;
    width: 100%;
    padding: 0.8rem 0;
    margin-top: 1.5rem;
    text-align: center;
    font-size: 1rem;
    font-weight: bold;
    color: #000080; /* Blue text */
    background-color: #ffffff;
    border: 2px solid #000080; /* Blue border */
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
}

.checkout-btn:hover {
    background-color: #000080; /* Blue background on hover */
    color: #ffffff; /* White text on hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    .shopping-cart {
        flex-direction: column;
    }

    .cart-items,
    .order-summary {
        flex: 1;
    }

    .cart-header h3 {
        font-size: 1.5rem;
    }

    .order-summary h4 {
        font-size: 1.4rem;
    }
}



</style>

<div class="shopping-cart-container">
    <div class="container">
        <div class="shopping-cart">
            <!-- Cart Items Section -->
            <div class="cart-items">
                <div class="cart-header">
                    <h3>Shopping Cart</h3>
                    <span>{{ count($cart) }} Items</span>
                </div>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product Details</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                        <tr>
                            <td>
                                <div class="cart-item">
                                    <img src="{{ asset('images/products/' . ($productImage->image ?? 'no-image.jpg')) }}" alt="Product">
                                    <div class="item-info">
                                        <h5>{{ $item['title'] }}</h5>
                                        <a href="{{ route('cart.remove', $item['id']) }}">Remove</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="quantity-control">
                                    <button onclick="updateQuantity({{ $item['id'] }}, 'decrease')">-</button>
                                    <input type="text" value="{{ $item['quantity'] }}" id="quantity-{{ $item['id'] }}">
                                    <button onclick="updateQuantity({{ $item['id'] }}, 'increase')">+</button>
                                </div>
                            </td>
                            <td>${{ $item['price'] }}</td>
                            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">x</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Order Summary Section -->
            <div class="order-summary">
                <h4>Order Summary</h4>
                <div class="summary-details">
                    <p>Items <span>{{ count($cart) }}</span></p>
                    <p>Shipping <span>${{ $shipping }}</span></p>
                    <p>Total Cost <span>${{ number_format($total, 2) }}</span></p>
                </div>
                <div class="promo-code">
                    <input type="text" placeholder="Enter your code">
                    <button>Apply</button>
                </div>
                <a href="{{ route('front.checkout') }}" class="checkout-btn">Checkout</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
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
                quantityInput.value = response.newQuantity;
                document.getElementById('total-price-' + productId).textContent = `$${response.itemTotal.toFixed(2)}`;
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
