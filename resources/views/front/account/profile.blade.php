@extends('front.layouts.app')

@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-11">
        <div class="container mt-5">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3">
                    @include('front.account.common.sidebar')
                </div>

                <!-- Content -->
                <div class="col-md-9">
                    <!-- New Attractive Header -->
                    <div class="custom-header mb-4">
                        <h2 class="custom-header-title">Account</h2>
                        <p class="custom-header-subtitle">Manage and update your account information.</p>
                    </div>

                    <!-- Card with Form -->
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <form id="accountForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                                        <span class="error-message" id="name-error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                                        <span class="error-message" id="email-error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Your Phone">
                                        <span class="error-message" id="phone-error"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" name="location" id="location" class="form-control" placeholder="Enter Your Location">
                                        <span class="error-message" id="location-error"></span>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter Your Address"></textarea>
                                        <span class="error-message" id="address-error"></span>
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        <button type="submit" class="btn btn-primary px-4">Update Setting</button>
                                    </div>
                                    <div id="success-message" class="col-md-12 mt-3 text-center" style="display: none;">
                                        <p class="text-success">Your account settings have been updated successfully!</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Custom Styles -->
<style>
    /* New Header Style */
    .custom-header {
        background: linear-gradient(to right, #003f88, #002a5e); /* Darker shades of blue gradient */
        color: white;
        padding: 2rem;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .custom-header-title {
        font-size: 2rem;
        font-weight: bold;
        margin: 0;
    }

    .custom-header-subtitle {
        font-size: 1rem;
        margin-top: 0.5rem;
        color: white;
    }

    /* Form Styles */
    .form-label {
        font-weight: bold;
        color: #333;
    }

    .form-control {
        border: 1px solid #000080;
        border-radius: 8px;
        padding: 0.7rem;
    }

    .form-control:focus {
        border-color: #000080;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background-color: #000080;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .error-message {
        color: red;
        font-size: 0.875rem;
        display: none;
    }

    #success-message {
        font-size: 1rem;
        color: green;
    }
</style>
@endsection
@section('customJs')
<script>
    document.getElementById('accountForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission
        
        // Clear previous error messages
        document.querySelectorAll('.error-message').forEach(function(msg) {
            msg.style.display = 'none';
        });

        // Get form values
        var name = document.getElementById('name').value.trim();
        var email = document.getElementById('email').value.trim();
        var phone = document.getElementById('phone').value.trim();
        var location = document.getElementById('location').value.trim();
        var address = document.getElementById('address').value.trim();

        var isValid = true;

        // Validate fields
        if (name === '') {
            document.getElementById('name-error').style.display = 'block';
            isValid = false;
        }

        if (email === '') {
            document.getElementById('email-error').style.display = 'block';
            isValid = false;
        }

        if (phone === '') {
            document.getElementById('phone-error').style.display = 'block';
            isValid = false;
        }

        if (location === '') {
            document.getElementById('location-error').style.display = 'block';
            isValid = false;
        }

        if (address === '') {
            document.getElementById('address-error').style.display = 'block';
            isValid = false;
        }

        // If valid, show success message and clear form
        if (isValid) {
            document.getElementById('success-message').style.display = 'block';
            document.getElementById('accountForm').reset(); // Reset the form fields
        }
    });
</script>
@endsection
