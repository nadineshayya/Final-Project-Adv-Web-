@extends('front.layouts.app')

@section('content')
<section class="login-section" style="background: linear-gradient(to bottom right, #4a90e2, #0056b3); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Login Form Section -->
            <div class="col-lg-5 col-md-8 col-12">
                <div class="card shadow-lg border-0" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-header text-center" style="background: #ffffff;">
                        <h3 style="font-family: 'Montserrat', sans-serif; font-weight: 700; color: #0056b3; margin: 0;">Welcome Back</h3>
                        <p style="font-family: 'Poppins', sans-serif; font-size: 0.9rem; color: #6c757d; margin-top: 5px;">Login to your account</p>
                    </div>
                    <div class="card-body p-4">
                        <!-- Success and Error Messages -->
                        @if(Session::has('success'))
                        <div class="alert alert-success text-center">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-danger text-center">
                            {{ Session::get('error') }}
                        </div>
                        @endif

                        <form action="{{ route('account.authenticate') }}" method="post">
                            @csrf

                            <!-- Email Field -->
                            <div class="form-group mb-4">
                                <label for="email" style="font-weight: 600; color: #2c3e50;">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" style="border-radius: 10px;">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="form-group mb-4">
                                <label for="password" style="font-weight: 600; color: #2c3e50;">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" style="border-radius: 10px;">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <label class="form-check-label" style="font-size: 0.9rem; color: #6c757d;">
                                        <input type="checkbox" class="form-check-input"> Remember Me
                                    </label>
                                </div>
                                <a href="#" style="font-size: 0.9rem; color: #007bff; text-decoration: none;">Forgot Password?</a>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2" style="font-size: 1rem; font-weight: 600; background: linear-gradient(to right, #007bff, #003580); border: none; border-radius: 10px;">Login</button>
                        </form>

                        <!-- Sign Up Link -->
                        <div class="text-center mt-4">
                            <p style="font-family: 'Poppins', sans-serif; font-size: 0.9rem; color: #6c757d;">Don't have an account? <a href="{{ route('account.register') }}" style="color: #007bff; font-weight: 600; text-decoration: none;">Sign up</a></p>
                        </div>
                    </div>

                    <div class="card-footer text-center" style="background: #003580; color: #ffffff;">
                        <p style="margin: 0; font-size: 0.85rem; font-family: 'Poppins', sans-serif;">© 2024 Thread & Trend. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
