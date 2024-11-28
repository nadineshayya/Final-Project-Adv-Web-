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
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Your Phone">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" name="location" id="location" class="form-control" placeholder="Enter Your Location">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Address</label>
                                        <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter Your Address"></textarea>
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        <button type="submit" class="btn btn-primary px-4">Update Setting</button>
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
</style>
@endsection
