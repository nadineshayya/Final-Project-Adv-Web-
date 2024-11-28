@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="h3 text-primary fw-bold">
                <i class="fas fa-plus me-2"></i> Create Category
            </h1>
        </div>
    </div>

    <form action="{{ route('categories.index') }}" method="POST" id="categoryForm" name="categoryForm">
        @csrf
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">
                    <!-- Name Input -->
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
                    </div>

                    <!-- Slug Input -->
                    <div class="col-12 col-md-6">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Category Slug">
                    </div>

                    <!-- Status Dropdown -->
                    <div class="col-12 col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Blocked</option>
                        </select>
                    </div>

                    <!-- Show on Home Dropdown -->
                    <div class="col-12 col-md-6">
                        <label for="showHome" class="form-label">Show on Home</label>
                        <select name="showHome" id="showHome" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <!-- Image Upload -->
                    <div class="col-12">
                        <label for="image-upload" class="form-label">Upload Image</label>
                        <div class="dropzone border rounded p-3 bg-light" id="image-upload">
                            <div class="dz-message needsclick">
                                Drag and drop files here or click to upload.
                            </div>
                        </div>
                        <input type="hidden" id="image_id" name="image_id" value="">
                    </div>

                    <!-- Gallery Preview -->
                    <div id="product-gallery" class="d-flex flex-wrap mt-3"></div>
                </div>
            </div>

            <!-- Submit and Cancel Buttons -->
            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">Create</button>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    Dropzone.autoDiscover = false;

    $(document).ready(function () {
        const dropzone = new Dropzone("#image-upload", {
            url: "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: "image",
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(file, response) {
                $("#image_id").val(response.image_id);
                $('#product-gallery').append(`
                    <div class="card m-2" style="width: 150px;" data-id="${response.image_id}">
                        <input type="hidden" name="image-array" value="${response.image_id}">
                        <img src="${response.ImagePath}" class="card-img-top" alt="Uploaded Image">
                        <div class="card-body text-center">
                            <button class="btn btn-danger btn-sm remove-image">Remove</button>
                        </div>
                    </div>
                `);
            },
            removedfile: function(file) {
                $("#image_id").val('');
            }
        });

        $('#categoryForm').submit(function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            $("button[type=submit]").prop('disabled', true);

            $.ajax({
                url: '{{ route("categories.store") }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    $("button[type=submit]").prop('disabled', false);
                    if (!response.status) {
                        // Handle errors
                    } else {
                        alert(response.message);
                        window.location.href = '{{ route("categories.index") }}';
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
