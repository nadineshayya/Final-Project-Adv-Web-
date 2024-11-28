@extends('admin.layouts.app')

@section('content')

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h3 text-primary fw-bold">
                    <i class="fas fa-tags me-2"></i> Create Coupon Code
                </h1>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('coupon.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('coupon.store') }}" method="POST" id="discountForm" name="discountForm">
            @csrf
            <div class="card shadow-sm">
                <div class="card-header text-white" style="background: linear-gradient(90deg, #1e90ff, #000080);">
                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i> Coupon Code Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Code -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" placeholder="Coupon Code" required>
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Coupon Code Name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Coupon Description" required></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Max Uses -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="max_uses" class="form-label">Max Uses</label>
                                <input type="number" name="max_uses" id="max_uses" class="form-control @error('max_uses') is-invalid @enderror" placeholder="Max Uses" required>
                                @error('max_uses')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Max Uses per User -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="max_uses_user" class="form-label">Max Uses per User</label>
                                <input type="number" name="max_uses_user" id="max_uses_user" class="form-control @error('max_uses_user') is-invalid @enderror" placeholder="Max Uses per User" required>
                                @error('max_uses_user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                    <option value="percent">Percent</option>
                                    <option value="fixed">Fixed</option>
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Discount Amount -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="discount_amount" class="form-label">Discount Amount</label>
                                <input type="number" name="discount_amount" id="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror" placeholder="Discount Amount" required>
                                @error('discount_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Minimum Amount -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="min_amount" class="form-label">Minimum Amount</label>
                                <input type="number" name="min_amount" id="min_amount" class="form-control @error('min_amount') is-invalid @enderror" placeholder="Minimum Amount" required>
                                @error('min_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="1">Active</option>
                                    <option value="0">Blocked</option>
                                </select>
                                @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Start and End Dates -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="starts_at" class="form-label">Starts At</label>
                                <input type="text" name="starts_at" id="starts_at" class="form-control @error('starts_at') is-invalid @enderror" placeholder="Start Date" required>
                                @error('starts_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="expires_at" class="form-label">Expires At</label>
                                <input type="text" name="expires_at" id="expires_at" class="form-control @error('expires_at') is-invalid @enderror" placeholder="End Date" required>
                                @error('expires_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="text-end pt-3">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Create</button>
                <a href="{{ route('coupon.index') }}" class="btn btn-outline-dark ms-2"><i class="fas fa-times me-1"></i> Cancel</a>
            </div>
        </form>
    </div>
</section>

@endsection

@section('customJs')
<!-- Include jQuery and jQuery UI Datepicker CSS from CDN -->
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $('#starts_at, #expires_at').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    });
</script>
@endsection
