@extends('admin.layouts.app')

@section('content')
<h1>Create Coupon Code</h1>
<div class="content-wrapper">
    <form action="{{ route('coupon.store') }}" method="POST" id="discountForm" name="discountForm">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="code">Code</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" placeholder="Coupon Code" required>
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
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Coupon Code Name" required>
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
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="5" placeholder="Coupon Description" required></textarea>
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
                            <input type="number" name="max_uses" id="max_uses" class="form-control @error('max_uses') is-invalid @enderror" placeholder="Max Uses" required>
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
                            <input type="number" name="max_uses_user" id="max_uses_user" class="form-control @error('max_uses_user') is-invalid @enderror" placeholder="Max Uses per User" required>
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

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="discount_amount">Discount Amount</label>
                            <input type="number" name="discount_amount" id="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror" placeholder="Discount Amount" required>
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
                            <input type="number" name="min_amount" id="min_amount" class="form-control @error('min_amount') is-invalid @enderror" placeholder="Minimum Amount" required>
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

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="starts_at">Starts At</label>
                            <input autocomplete="off" type="text" name="starts_at" id="starts_at" class="form-control @error('starts_at') is-invalid @enderror" placeholder="Starts At" required>
                            @error('starts_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="expires_at">Expires At</label>
                            <input autocomplete="off" type="text" name="expires_at" id="expires_at" class="form-control @error('expires_at') is-invalid @enderror" placeholder="Expires At" required>
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

        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Create</button>
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
      $(document).ready(function () {
    // Initialize Datepicker
    $('#starts_at, #expires_at').datepicker({
        dateFormat: 'yy-mm-dd', // Date format compatible with the backend
        showButtonPanel: true,
        changeMonth: true,
        changeYear: true
    });

    // Handle form submission
    $('#discountForm').submit(function (e) {
        e.preventDefault();

        // Collect form data
        let formData = new FormData(this);

        // Append time to date fields
        const startsAt = $('#starts_at').val();
        const expiresAt = $('#expires_at').val();

        formData.set('starts_at', startsAt + ' 00:00:00'); // Set start time
        formData.set('expires_at', expiresAt + ' 23:59:59'); // Set end time

        $('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: '{{ route("coupon.store") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').html('');

                if (!response.status) {
                    // Show validation errors
                    $.each(response.errors, function (field, errors) {
                        let fieldElement = $('#' + field);
                        fieldElement.addClass('is-invalid');
                        fieldElement.next('.invalid-feedback').html(errors.join(', '));
                    });
                } else {
                    alert(response.message);
                    window.location.href = '{{ route("coupon.index") }}';
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                $('button[type=submit]').prop('disabled', false);
            }
        });
    });
});

    </script>
@endsection
