@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <form action="" method="post" id="orderForm" name="orderForm">
                @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Shipping Address</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                                        <div id="first_name_error" class="text-danger"></div>
                                    </div>            
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                                        <div id="last_name_error" class="text-danger"></div>
                                    </div>            
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                        <div id="email_error" class="text-danger"></div>
                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select a Country</option>
                                        @if($countries->isNotEmpty())
                                            @foreach ($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                        <div id="country_error" class="text-danger"></div>
                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control"></textarea>
                                        <div id="address_error" class="text-danger"></div>
                                    </div>            
                                </div>

                               

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No.">
                                        <div id="mobile_error" class="text-danger"></div>
                                    </div>            
                                </div>
                                

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control"></textarea>
                                      
                                    </div>            
                                </div>

                            </div>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="sub-title">
                        <h2>Order Summery</h3>
                    </div>                    
                    <div class="card cart-summery">
                        <div class="card-body">
                        @php
                            $cart = session()->get('cart', []); // Fetch cart from the session
                        @endphp
                        @foreach($cart as $item)
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h6">{{ $item['title'] }} X {{ $item['quantity'] }}</div>
                                <div class="h6">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                            </div>
                        @endforeach
                                                
                        <div class="d-flex justify-content-between">
                                <div class="h6">Subtotal</div>
                                <div class="h6">${{ number_format($subtotal, 2) }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="h6">Discount</div>
                                <div class="h6" id="discount_value">{{ $discount->discount_amount ?? 'No discount'}}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="h6">Shipping</div>
                                <div class="h6">${{ number_format($shipping, 2) }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="h6"><strong>Total</strong></div>
                                <div class="h6" id="grandTotal" ><strong>${{ number_format($total, 2) }}</strong></div>
                            </div>
                        </div>
                    </div>   

                    <div class="input-group apply-coupan mt-4">
                    <input type="text" placeholder="Coupon Code" class="form-control" name="discount_code"  id="discount_code">
                    <button class="btn btn-dark" type="button" id="apply-discount">Apply Coupon</button>
                </div>
                    <div class="card payment-form">
    <h3 class="card-title h5 mb-3">Payment Method</h3>
    <div>
        <input type="radio" checked name="payment_method" value="cod" id="payment_one">
        <label for="payment_one" class="form-check-label">COD</label>
    </div>

    <div>
        <input type="radio" name="payment_method" value="stripe" id="payment_two">
        <label for="payment_two" class="form-check-label">Stripe</label>
    </div>

    <div class="card-body p-0 d-none" id="card-payment-form">
        <div class="mb-3">
            <label for="card_number" class="mb-2">Card Number</label>
            <input type="text" name="card_number" id="card_number" placeholder="Valid Card Number" class="form-control">
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="expiry_date" class="mb-2">Expiry Date</label>
                <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YYYY" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="cvv" class="mb-2">CVV Code</label>
                <input type="text" name="cvv" id="cvv" placeholder="123" class="form-control">
            </div>
          
                            </div>
                        </div>
                    </div>
                    <div class="pt-4">
                              
                           <button type="submit" class="btn-dark btn btn-block w-100" >Pay Now</button>
                            </div>
                            
                        </div>                        
                    </div>

                          
                 
                    
                </div>
            </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $("#payment_one").click(function () {
            if ($(this).is(":checked") === true) {
                $("#card-payment-form").addClass('d-none');
            }
        });

        $("#payment_two").click(function () {
            if ($(this).is(":checked") === true) {
                $("#card-payment-form").removeClass('d-none');
            }
        });
    });

    $("#orderForm").submit(function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Clear existing error messages
    $(".error-message").text("");

    $.ajax({
        url: '{{ route("front.processCheckout") }}', // Ensure the route is properly named in web.php
        type: 'POST',
        data: $(this).serialize(), // Serialize form data
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        },
        success: function (response) {
            if (response.status) {
                // Redirect or show a success message
                alert("Checkout processed successfully!");
                window.location.href = '/thank-you/${orderId}'; // Example redirect
            } else {
                // Validation errors
                alert(response.message);
                displayErrors(response.errors);
            }
        },
        error: function (xhr) {
            // Handle server errors (500, etc.)
            console.error("Error:", xhr.responseText);
            alert("An unexpected error occurred. Please try again.");
        }
    });

    function displayErrors(errors) {
        // Map errors to specific fields
        if (errors.first_name) {
            $("#first_name_error").text(errors.first_name[0]);
        }
        if (errors.last_name) {
            $("#last_name_error").text(errors.last_name[0]);
        }
        if (errors.email) {
            $("#email_error").text(errors.email[0]);
        }
        if (errors.country) {
            $("#country_error").text(errors.country[0]);
        }
        if (errors.address) {
            $("#address_error").text(errors.address[0]);
        }
        if (errors.mobile) {
            $("#mobile_error").text(errors.mobile[0]);
        }
        
    }
});

$("#apply-discount").click(function() {
    console.log("Apply Discount Button Clicked");  // Debugging line

    $.ajax({
        url: "{{ route('front.applyDiscount') }}",
        type: 'POST',
        data: {
            code: $("#discount_code").val(),
            country: $("#country").val()
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token for Laravel
        },
        success: function(response) {
            console.log("AJAX Response:", response);  // Log the entire response to verify its structure

            if (response.status === true) {
                console.log("Discount applied successfully.");  // If discount is successfully applied

                // Make sure the discount_account exists in the response
                if (response.discount && response.discount.discount_account) {
                    var discountAmount = response.discount.discount_account;
                    let total = response.grandTotal +0;
                    $("#grandTotal").html('$' + total);
                    $("#discount_value").html('$' + discountAmount);
                } else {
                    console.log("Discount account not found in response");
                }
            } else {
                console.log("Error: " + response.message);  // If something goes wrong with the response
            }
        },
        error: function(xhr, status, error) {
            console.log("AJAX Error:", status, error);  // Log AJAX errors if something goes wrong
        }
    });
});



</script>

@endsection