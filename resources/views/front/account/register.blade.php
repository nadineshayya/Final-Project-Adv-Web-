@extends('front.layouts.app')

@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                <li class="breadcrumb-item">Register</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-10">
    <div class="container">
        <div class="login-form">
            <form action="{{ route('account.processRegister') }}" method="POST" id="registrationForm">
                @csrf
                <h4 class="modal-title">Register Now</h4>

                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                    <div id="nameError" class="text-danger"></div>
                </div>

                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                    <div id="emailError" class="text-danger"></div>
                </div>

                <div class="form-group">
                    <input type="phone" class="form-control" placeholder="Phone Number" id="phone" name="phone">
                    <div id="phoneError" class="text-danger"></div>
                </div>


                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                    <div id="passwordError" class="text-danger"></div>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation">
                    <div id="passwordConfirmationError" class="text-danger"></div>
                </div>

                <button type="submit" class="btn btn-dark btn-block btn-lg">Register</button>
            </form>

            <div class="text-center small">Already have an account? <a href="{{route('account.login')}}">Login Now</a></div>
        </div>
    </div>
</section>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#registrationForm").on("submit", function (event) {
        event.preventDefault();
        $("button[type=submit]").prop('disabled', true);
        // Clear previous error messages
        $(".text-danger").text('');

        $.ajax({
            url: '{{ route("account.processRegister") }}',
            type: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $("button[type=submit]").prop('disabled', false);
                if (response.status) {
                    alert('Registration successful');
                    window.location.href = "{{ route('account.login') }}"; // Redirect to login page
                } else {
                    // Display errors next to each field
                    if (response.errors.name) {
                        $("#nameError").text(response.errors.name[0]);
                    }
                    if (response.errors.email) {
                        $("#emailError").text(response.errors.email[0]);
                    }
                    if (response.errors.phone) {
                        $("#phoneError").text(response.errors.phone[0]);
                    }
                    if (response.errors.password) {
                        $("#passwordError").text(response.errors.password[0]);
                    }
                    if (response.errors.password_confirmation) {
                        $("#passwordConfirmationError").text(response.errors.password_confirmation[0]);
                    }
                }
            },
            error: function (xhr, status, error) {
                alert('An error occurred: ' + error);
            }
        });
    });
});

</script>
@endsection
