@extends('admin.layouts.app')

@section('content')
<h1>Edit Coupon Code</h1>
<div class="content-wrapper">
    <form action="{{ route('coupon.update', $coupon->id) }}" method="POST" id="editCouponForm" name="editCouponForm">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="code">Code</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ $coupon->code }}" placeholder="Coupon Code" required>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $coupon->name }}" placeholder="Coupon Code Name">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="Coupon Description" required>{{ $coupon->description }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="max_uses">Max Uses</label>
                            <input type="number" name="max_uses" id="max_uses" class="form-control @error('max_uses') is-invalid @enderror" value="{{ $coupon->max_uses }}" placeholder="Max Uses">
                            @error('max_uses')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="max_uses_user">Max Uses per User</label>
                            <input type="number" name="max_uses_user" id="max_uses_user" class="form-control @error('max_uses_user') is-invalid @enderror" value="{{ $coupon->max_uses_user }}" placeholder="Max Uses per User">
                            @error('max_uses_user')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent</option>
                                <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="discount_amount">Discount Amount</label>
                            <input type="number" name="discount_amount" id="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror" value="{{ $coupon->discount_account }}" placeholder="Discount Amount" required>
                            @error('discount_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="min_amount">Minimum Amount</label>
                            <input type="number" name="min_amount" id="min_amount" class="form-control @error('min_amount') is-invalid @enderror" value="{{ $coupon->min_account }}" placeholder="Minimum Amount">
                            @error('min_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="1" {{ $coupon->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $coupon->status == 0 ? 'selected' : '' }}>Blocked</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
    <label for="starts_at">Starts At</label>
    <input type="datetime-local" 
           name="starts_at" 
           id="starts_at" 
           class="form-control @error('starts_at') is-invalid @enderror"
           value="{{ old('starts_at', $coupon->starts_at ? $coupon->starts_at->format('Y-m-d\TH:i') : '') }}" 
           required>
    @error('starts_at')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="col-md-6">
    <label for="expires_at">Expires At</label>
    <input type="datetime-local" 
           name="expires_at" 
           id="expires_at" 
           class="form-control @error('expires_at') is-invalid @enderror"
           value="{{ old('expires_at', $coupon->expires_at ? $coupon->expires_at->format('Y-m-d\TH:i') : '') }}" 
           required>
    @error('expires_at')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>


                 

                </div>
            </div>
        </div>

        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('coupon.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
</div>
@endsection
@section('customJs')
    <!-- Include jQuery and jQuery UI Datepicker CSS from CDN -->
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
 $('#starts_at, #expires_at').datepicker({
        dateFormat: 'Y-m-d H:i:S', // Date format compatible with the backend
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true
    });

    $('#editCouponForm').submit(function (e) {
    e.preventDefault();

    const id = '{{ $coupon->id }}';
    const formData = new FormData(this);

    $.ajax({
        url: '/admin/coupon/update/' + id,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status) {
                alert(response.message);
                window.location.href = '/admin/coupon';
            } else {
                $.each(response.errors, function (key, error) {
                    alert(error[0]);
                });
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
        },
    });
});


</script>
@endsection