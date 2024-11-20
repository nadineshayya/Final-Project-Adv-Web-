@extends('admin.layouts.app')

@section('content')

<style>
    .dashboard-heading-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #003f88;
        color: white;
        padding: 20px;
        margin: 0;
        width: 100%;
        border-radius: 0; /* No rounded corners */
    }

    .profile-container {
        display: flex;
        align-items: center;
    }

    .profile-container img.profile-icon {
        width: 60px;
        height: 60px;
        margin-right: 15px;
        background-color: transparent; /* Remove background */
        border: none; /* Remove white square */
    }

    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 700;
        margin: 0;
        flex-grow: 1;
        text-align: left; /* Align title to the left */
        margin-left: 20px; /* Push title slightly more to the left */
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-left: auto; /* Push buttons to the right */
        padding-right: 150px; /* Adjust button placement */
    }

    .action-buttons button,
    .action-buttons a {
        margin-left: 15px; /* Spacing between buttons */
    }
</style>

<div class="dashboard-heading-container full-width">
    <div class="profile-container">
        <img src="{{ asset('images/dashboard profile.png') }}" alt="Admin Profile" class="profile-icon">
    </div>
    <h1 class="dashboard-title">Create Category</h1>
    <div class="col-sm-6 text-right">
        <a href="categories.html" class="btn btn-primary">Back</a>
    </div>
</div>

<section class="content">
    <form action="{{ route('categories.store') }}" method="POST" id="categoryForm" name="categoryForm">
        @csrf
        <div class="card mt-4">
            <div class="card-body">
                <!-- Name and Slug Fields -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Category Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">Category Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter Category Slug" required>
                        </div>
                    </div>
                </div>

                <!-- Status Field with Buttons -->
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Blocked</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 action-buttons">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="#" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<script>
    $("#categoryForm").submit(function(event) {
        event.preventDefault();
        var element = $(this);
        $.ajax({
            url: '{{ route("categories.store") }}',
            type: 'post',
            data: element.serializeArray(),
            dataType: 'json',
            success: function(response) {
                var errors = response['errors'];
                if (errors['name']) {
                    $('#name').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['name']);
                } else {
                    $('#name').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                }

                if (errors['slug']) {
                    $('#slug').addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback').html(errors['slug']);
                } else {
                    $('#slug').removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback').html("");
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something went wrong");
            }
        });
    });
</script>

@endsection
