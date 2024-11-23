@extends('admin.layouts.app')

@section('content')
<h1>Create Category</h1>
<div class="content-wrapper">
<form action="{{ route('categories.index') }}" method="POST" id="categoryForm" name="categoryForm">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                    </div>
                </div>

                <!-- Dropzone -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <input type="hidden" id="image_id" name="image_id" value="">
                        <label for="image">Upload Image</label>
                        <div class="dropzone" id="image-upload">
                            <div class="dz-message needsclick">
                                Drop files here or click to upload.
                            </div>
                        </div>
                    </div>
                </div><div id="product-gallery" class="d-flex flex-wrap"></div>



                </div>
               

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Blocked</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-5 pt-3">
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
    </div>
</form>

@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
 Dropzone.autoDiscover = false;

$(document).ready(function () {
    const dropzone = new Dropzone("#image-upload", {
        url: "{{ route('temp-images.create') }}",
        maxFiles: 1,
        paramName: "image",
        acceptedFiles: "image/*",  // Restrict to image types
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            // Store the image ID in the hidden input field
            $("#image_id").val(response.image_id);
        },
        removedfile: function(file) {
            // Clear the image_id when the file is removed
            $("#image_id").val('');
        },
    });

    // Handle form submission via AJAX
    $('#categoryForm').submit(function (event) {
        event.preventDefault();

        // Get form data including the Dropzone file
        var formData = new FormData(this);  // Use FormData to include the file
        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: '{{ route("categories.store") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,  // Don't process the data
            contentType: false,  // Set the content type to false to allow FormData
            success: function (response) {
                $("button[type=submit]").prop('disabled', false);
                $('#categoryForm').find('.is-invalid').removeClass('is-invalid');
                $('#categoryForm').find('.invalid-feedback').html('');

                if (!response.status) {
                    // Display validation errors
                    if (response.errors.name) {
                        $('#name').addClass('is-invalid').next('.invalid-feedback').html(response.errors.name.join(', '));
                    }
                    if (response.errors.slug) {
                        $('#slug').addClass('is-invalid').next('.invalid-feedback').html(response.errors.slug.join(', '));
                    }
                } else {
                    // Success - show message and redirect
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

        // Handle form submission via AJAX
        $('#categoryForm').submit(function (event) {
            event.preventDefault();
            
            // Get form data
            var formData = $(this).serialize();
            $("button[type=submit]").prop('disabled', true);
            // AJAX request to store category
            $.ajax({
                url: '{{ route("categories.store") }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    $("button[type=submit]").prop('disabled', false);
                    $('#categoryForm').find('.is-invalid').removeClass('is-invalid');
                    $('#categoryForm').find('.invalid-feedback').html('');

                    if (!response.status) {
                        // Display validation errors
                        if (response.errors.name) {
                            $('#name').addClass('is-invalid').next('.invalid-feedback').html(response.errors.name.join(', '));
                        }
                        if (response.errors.slug) {
                            $('#slug').addClass('is-invalid').next('.invalid-feedback').html(response.errors.slug.join(', '));
                        }
                    } else {
                        // Success - show message and redirect
                        alert(response.message);
                        window.location.href = '{{ route("categories.index") }}';
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
        $(document).ready(function () {
    console.log('Initializing Dropzone...');
    $("#image-upload").dropzone({
        url: "{{ route('temp-images.create') }}",
        maxFiles: 1,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpg, image/png, image/gif",
        addedfile: function(file) {
            console.log('File added to Dropzone:', file);  // Log the file object to see if it's recognized
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (file, response) {
            console.log('Dropzone success callback triggered');
            console.log('Response:', response);
            if (response.status) {
                console.log('Image URL:', response.ImagePath);
                $('#product-gallery').append(`
                    <div class="card m-2" style="width: 150px;" data-id="${response.image_id}">
                       <input type="hidden" name="image-array" value="${response.image_id}">
                    <img src="${response.ImagePath}" class="card-img-top" alt="Uploaded Image">
                        <div class="card-body text-center">
                            <button class="btn btn-danger btn-sm remove-image">Remove</button>
                        </div>
                    </div>
                `);
                console.log('Image appended to #product-gallery');
            } else {
                alert(response.message);
            }
        }
    });
});

</script>
@endsection