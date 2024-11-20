<!DOCTYPE html>  
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Shop :: Administrative Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <style>
        :root {
            --color-primary: #00004E;
            --color-secondary: #020082;
            --color-accent: #EDEF9;
            --color-highlight: #1873D3;
            --background-light-blue: #e6f7ff /* Light blue color for the background */
        }

        /* Fullscreen background with light blue color */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: 'Source Sans Pro', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--background-light-blue); /* Light blue background */
        }

        /* Central container with centered alignment */
        .form-container {
            width: 90vw;
            max-width: 1000px;
            height: 80vh;
            display: flex;
            border: 2px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff; /* White background for the form itself */
            margin: auto;
        }

        /* Left section for the background image */
        .left-section {
            background-image: url('/images/loginSection1.jpeg'); /* Update path to image */
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Right section for the login form */
        .right-section {
            padding: 2rem;
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            box-sizing: border-box;
        }

        /* Login form styling */
        .login-container {
            width: 100%;
            max-width: 400px;
            text-align: center;
            padding-top: 2rem;
        }

        /* Welcome title styling */
        .login-container h2 {
            color: var(--color-primary);
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.3rem;
        }

        .login-container h2 span {
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            font-size: 1.6rem;
        }

        /* Subtitle styling */
        .login-container p {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        /* Form styling */
        .form-label {
            font-weight: normal;
            text-align: left;
            display: block;
        }

        .form-control {
            border-color: var(--color-highlight);
            background: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: var(--color-secondary);
            box-shadow: none;
        }

        .btn-login {
            background-color: var(--color-secondary);
            color: white;
            width: 100%;
            margin-top: 1rem;
        }

        .forgot-password-link {
            color: var(--color-highlight);
            font-size: 0.8rem;
            text-decoration: none;
        }

        /* Adjusted position of signup container */
        .signup-container {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 0.4rem;
            margin-bottom: 2rem;
        }

        .signup-link {
            color: var(--color-secondary);
            font-weight: bold;
            text-decoration: none;
        }

         /* Tablet and below (width <= 768px) */
        @media (max-width: 768px) {
            .form-container {
                flex-direction: column; /* Stack the sections vertically */
                height: auto; /* Allow height to adjust automatically */
            }

            .left-section, .right-section {
                width: 100%; /* Both sections will take full width */
                height: auto; /* Allow content to define height */
            }

            .login-container {
                width: 90%; /* Make the form slightly smaller on mobile */
                max-width: none; /* Allow the form to expand more */
            }

            .login-container h2 {
                font-size: 1.3rem; /* Make the title smaller on mobile */
            }

            .form-label, .form-control, .btn-login {
                width: 90%; /* Adjust form elements to be more compact */
            }
        }

        /* Mobile (width <= 480px) */
        @media (max-width: 480px) {
            .login-container h2 {
                font-size: 1.1rem; /* Further reduce title size for mobile */
            }

            .login-container p {
                font-size: 0.8rem; /* Make subtitle text smaller */
            }

            .form-container {
                padding: 1rem; /* Add some padding inside the form for smaller screens */
            }

            .form-label, .form-control, .btn-login {
                width: 100%; /* Allow form elements to use the full screen width */
            }

            .signup-container {
                font-size: 0.8rem; /* Smaller text size for sign-up link */
            }
        }

    </style>
</head>
<body>
    <!-- Form-like container -->
    <div class="form-container">
        <!-- Left Section with Background Image -->
        <div class="left-section"></div>

        <!-- Right Section with Login Form -->
        <div class="right-section">
            <div class="login-container">
                <h2 class="text-center fw-bold mb-2" style="color: var(--color-primary);">
                    Welcome to <span>Thread and Trend</span>
                </h2>
                <p class="text-center mb-3" style="color: #6c757d;">Please login to your account</p>
                
                <form action="{{ route('admin.authenticate') }}" method="post">
                    @csrf
                    <div class="mb-3 text-start">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="{{old('email')}}" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 text-start">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-login">Login</button>
                    <div class="mt-3 text-center">
                        <a href="forgot-password.html" class="forgot-password-link">Forgot password?</a>
                    </div>
                    <div class="signup-container text-center">
                        Don’t have an account? <a href="#" class="signup-link">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS (optional for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>