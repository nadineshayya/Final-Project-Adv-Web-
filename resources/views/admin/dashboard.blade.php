@extends('admin.layouts.app')

@section('content')
    <!-- Dashboard Heading -->
    <div class="dashboard-heading-container">
        <div class="profile-container">
            <img src="{{ asset('images/dashboard profile.png') }}" alt="Admin Profile" class="profile-icon">
            <div class="admin-info">
                <h4>Admin</h4>
            </div>
        </div>
        <h1 class="dashboard-title">Dashboard</h1>
    </div>

    <div class="container-fluid mt-5"> <!-- Added top margin to push the cards down -->
        <div class="row justify-content-center">
            <!-- Total Orders Card -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="small-box card-container bg-blue-1">
                    <h3>150</h3>
                    <p>Total Orders</p>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Total Customers Card -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 position-relative">
                <div class="small-box card-container bg-blue-2">
                    <h3>50</h3>
                    <p>Total Customers</p>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- Total Sale Card -->
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="small-box card-container bg-blue-3">
                    <h3>$1000</h3>
                    <p>Total Sale</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customCss')
    <style>
        /* Dashboard Heading Container */
        .dashboard-heading-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #003f88;
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .profile-container {
            display: flex;
            align-items: center;
        }

        .profile-container img.profile-icon {
            width: 60px;
            height: 60px;
            margin-right: 15px;
        }

        .dashboard-title {
            font-size: 1.8rem;
            font-weight: 700;
            text-align: right;
            margin: 0;
        }

        .admin-info h4 {
            margin: 0;
            font-weight: bold;
        }

        /* Card Containers */
        .card-container {
            padding: 20px;
            border-radius: 10px;
            color: white;
            text-align: center;
            height: 150px; /* Fixed height for equal sizing */
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .card-container:hover {
            transform: translateY(-5px); /* Slight lift on hover */
        }

        /* Different Shades of Blue for Each Card */
        .bg-blue-1 {
            background-color: #215ba6;
        }

        .bg-blue-2 {
            background-color: #3388e6; /* A lighter shade of blue */
        }

        .bg-blue-3 {
            background-color: #7abaff; /* A much lighter shade */
        }

        /* "More info" link styling */
        .small-box-footer {
            color: #003366; /* Darker shade for better visibility */
            font-weight: bold;
            transition: color 0.3s ease-in-out;
        }

        .small-box-footer:hover {
            color: #001f4d; /* Even darker on hover */
            text-decoration: none; /* Remove underline on hover */
        }

        /* Footer */
        footer.main-footer {
            background-color: #003f88; /* Blue background */
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed; /* Ensure footer stays at the bottom */
            bottom: 0;
            width: 100%;
            z-index: 10;
        }
    </style>
@endsection
