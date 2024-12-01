@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                <li class="breadcrumb-item">Change Password</li>
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
                    <h2 class="custom-header-title">Change Password</h2>
                </div>
                <form action="" method="post" id="changeForm" name="changeForm">
                    @csrf
                    <!-- Card with Form -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Change Password</h2>
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                        <small class="text-danger d-none" id="old_password_error">This field is required.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password">New Password</label>
                                        <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                        <small class="text-danger d-none" id="new_password_error">This field is required.</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password">Confirm Password</label>
                                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control">
                                        <small class="text-danger d-none" id="confirm_password_error">This field is required.</small>
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-dark">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script>
    $("#changeForm").submit(function (e) {
        e.preventDefault();

        // Clear previous error messages
        $(".text-danger").addClass('d-none');

        // Initialize form validity flag
        let isValid = true;

        // Validate fields
        if ($("#old_password").val().trim() === "") {
            $("#old_password_error").removeClass('d-none');
            isValid = false;
        }
        if ($("#new_password").val().trim() === "") {
            $("#new_password_error").removeClass('d-none');
            isValid = false;
        }
        if ($("#confirm_password").val().trim() === "") {
            $("#confirm_password_error").removeClass('d-none');
            isValid = false;
        }

        // If form is valid, proceed with AJAX
        if (isValid) {
            $.ajax({
                url: '{{route("account.changePass")}}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
        },
                success: function (response) {
                    if (response.status === true) {
                        window.location.href="{{route('front.account.changePassword')}}"
                        alert('Password changed successfully.');
                        window.location.reload();
                    } else {
                        $(".error-message").remove();  // Clear previous error messages

if (response.errors) {
    $.each(response.errors, function(field, message) {
        $("#" + field).after("<div class='error-message text-danger'>" + message + "</div>");
    });
} else if (response.message) {
    // This handles the case when the old password is incorrect, etc.
    alert(response.message);
}
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred. Please try again later.');
                }
            });
        }
    });
</script>
@endsection
