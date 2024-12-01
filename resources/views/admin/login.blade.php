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
            --color-highlight: #1873D3;
            --color-accent: #f0f4ff;
        }
        body {
            background-color: var(--color-accent);
        }
        .invalid-feedback {
            display: block;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <!-- Include any messages here -->
        @include('admin.message')

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="text-center text-2xl fw-bold mb-4" style="color: var(--color-primary);">Administrative Panel</h2>
                        <p class="text-center text-muted mb-4">Sign in to start your session</p>
                        <form action="{{ route('admin.authenticate') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" value="{{ old('email') }}" name="email" id="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" style="border-color: var(--color-highlight);">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" style="border-color: var(--color-highlight);">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="forgot-password.html" class="text-decoration-none" style="color: var(--color-highlight);">Forgot password?</a>
                                <button type="submit" class="btn text-white" style="background-color: var(--color-secondary);">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
