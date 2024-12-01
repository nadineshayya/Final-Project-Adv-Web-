@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create User</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="{{ route('users.store') }}" method="POST" name="userForm" id="userForm">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <!-- Email Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <!-- Password Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <!-- Phone Field -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone number">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card Footer -->
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $('#userForm').submit(function (event) {
        event.preventDefault();

        // Disable the button to prevent duplicate submissions
        $("button[type=submit]").prop('disabled', true);

        // Serialize the form data
        var formData = $(this).serialize();

        // Make AJAX request
        $.ajax({
            url: '{{ route("users.store") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $("button[type=submit]").prop('disabled', false);
                $('#userForm').find('.is-invalid').removeClass('is-invalid');
                $('#userForm').find('.invalid-feedback').html('');

                if (!response.status) {
                    // Handle validation errors
                    if (response.errors.name) {
                        $('#name').addClass('is-invalid').next('.invalid-feedback').html(response.errors.name.join(', '));
                    }
                    if (response.errors.email) {
                        $('#email').addClass('is-invalid').next('.invalid-feedback').html(response.errors.email.join(', '));
                    }
                    if (response.errors.password) {
                        $('#password').addClass('is-invalid').next('.invalid-feedback').html(response.errors.password.join(', '));
                    }
                    if (response.errors.phone) {
                        $('#phone').addClass('is-invalid').next('.invalid-feedback').html(response.errors.phone.join(', '));
                    }
                } else {
                    // Success message and redirect
                    alert(response.message);
                    window.location.href = '{{ route("users.index") }}';
                }
            },
            error: function (xhr) {
                $("button[type=submit]").prop('disabled', false);
                console.error(xhr.responseText);
            }
        });
    });
</script>
@endsection
