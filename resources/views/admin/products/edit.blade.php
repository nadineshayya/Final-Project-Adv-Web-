@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('products.update', $product->id) }}" method="post" id="productForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Product Details -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ $product->title }}">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $product->slug }}">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description">{{ $product->description }}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="short_description">Short Description</label>
                                    <textarea name="short_description" id="short_description" cols="30" rows="10" class="form-control" placeholder="Description">{{ $product->short_description }}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="description">Shipping & Returns</label>
                                    <textarea name="shipping_returns" id="shipping_returns" cols="30" rows="10" class="form-control" placeholder="Description">{{ $product->shipping_returns }}</textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Upload -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <input type="hidden" name="image_id" id="image_id">
                                <label for="image">Upload Images</label>
                                <div class="dropzone" id="image-upload">
                                    <div class="dz-message needsclick">
                                        Drop files here or click to upload.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="product-gallery" class="d-flex flex-wrap">
                            @foreach($productImages as $image)
                                <div class="card" style="width: 150px;" id="image-row-{{ $image->id }}">
                                    <input type="hidden" name="image_array[]" value="{{ $image->id }}">
                                    <img src="{{ asset('images/products/' . $image->image) }}" class="card-img-top" alt="Uploaded Image">
                                    <div class="card-body text-center">
                                        <button type="button" onclick="deleteImage({{ $image->id }})" class="btn btn-danger btn-sm">Remove</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pricing -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="mb-3">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price" value="{{ $product->price }}">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="compare_price">Compare at Price</label>
                                    <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price" value="{{ $product->compare_price }}">
                                    <p class="text-muted mt-3">
                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Inventory -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>
                                <div class="mb-3">
                                    <label for="sku">SKU</label>
                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="SKU" value="{{ $product->sku }}">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="barcode">Barcode</label>
                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode" value="{{ $product->barcode }}">
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="track_qty" name="track_qty" value="Yes" {{ ($product->track_qty == 'Yes') ? 'checked' : '' }}>
                                    <label for="track_qty">Track Quantity</label>
                                </div>
                                <div class="mb-3">
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="qty" id="qty" class="form-control" min="0" placeholder="Quantity" value="{{ $product->qty }}">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <!-- Product Status -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product Status</h2>
                                <select name="status" id="status" class="form-control">
                                    <option {{ ($product->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ ($product->status == 0) ? 'selected' : '' }} value="0">Block</option>
                                </select>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product Category</h2>
                                <select name="category" id="category" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option {{ ($product->category_id == $category->id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Featured Product -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured Product</h2>
                                <select name="is_featured" id="is_featured" class="form-control">
                                    <option value="No" {{ ($product->is_featured == 'No') ? 'selected' : '' }}>No</option>
                                    <option value="Yes" {{ ($product->is_featured == 'Yes') ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                        </div>

                       
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('customJs')
<link rel="stylesheet" href="select2/css/select2.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="select2/js/select2.min.css"></script>

<script>



    // Handle image upload using Dropzone
    Dropzone.autoDiscover = false;

    $(document).ready(function () {
        const dropzone = new Dropzone("#image-upload", {
            url: "{{ route('product-images.update') }}",
            maxFiles: 10,
            paramName: "image",
            params: { 'product_id': '{{ $product->id }}' },
            acceptedFiles: "image/*",
            addRemoveLinks: true,
            success: function (file, response) {
                const imageCell = `
                    <div class="card" style="width: 150px;" id="image-row-${response.image_id}">
                        <input type="hidden" name="image_array[]" value="${response.image_id}">
                        <img src="${response.ImagePath}" class="card-img-top" alt="Uploaded Image">
                        <div class="card-body text-center">
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteImage(${response.image_id})">Remove</button>
                        </div>
                    </div>
                `;
                $('#product-gallery').append(imageCell);
            }
        });
        $("#category").change(function () {
    var categoryId = $(this).val();
    if (categoryId) {
        $.ajax({
            url: '{{ route("product-subcategories.index") }}',
            type: 'Get',
            data: { category_id: categoryId },
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            success: function (response) {
                if (response.status) {
                    $("#sub_category").html('<option value="">Select Sub Category</option>');
                    response.subCategories.forEach(function (subCategory) {
                        $("#sub_category").append(
                            `<option value="${subCategory.id}">${subCategory.name}</option>`
                        );
                    });
                }
            },
            error: function () {
                console.error("Error fetching subcategories.");
            },
        });
    }
});

$("#productForm").submit(function(event) {
    event.preventDefault(); // Prevent default form submission

    // Serialize form data
    var formArray = $(this).serializeArray();

    // Disable the submit button to prevent multiple clicks
    $("button[type=submit]").prop('disabled', true);

    // Perform the AJAX request
    $.ajax({
        url: '{{ route("products.update", $product->id) }}', // Update route
        type: 'POST',
        data: formArray,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
        },
        success: function(response) {
            // Enable the submit button
            $("button[type=submit]").prop('disabled', false);

            if (response.status) {
                alert('Product updated successfully!');
                window.location.href = "{{ route('products.index') }}"; // Redirect on success
            } else {
                // Display validation errors
                alert('Validation failed. Please check the form for errors.');

                // Highlight invalid fields and show error messages
                for (const [key, messages] of Object.entries(response.errors)) {
                    var field = $(`[name="${key}"]`);
                    field.addClass('is-invalid'); // Add error class
                    field.siblings('.invalid-feedback').html(messages[0]); // Display error
                }
            }
        },
        error: function(xhr) {
            // Log the error for debugging
            console.error("Error:", xhr.responseText);

            // Show a user-friendly alert
            alert('An error occurred while updating the product. Please try again.');

            // Enable the submit button
            $("button[type=submit]").prop('disabled', false);
        }
    });
});

        // Delete image
        window.deleteImage = function(imageId) {
            if (confirm("Are you sure you want to delete this image?")) {
                $.ajax({
                    url: `/admin/product-images/${imageId}`,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status) {
                            $(`#image-row-${imageId}`).remove();
                            alert(response.message);
                        } else {
                            alert(response.message || "Failed to delete image.");
                        }
                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert("An error occurred. Please try again.");
                    }
                });
            }
        };
    });
</script>
@endsection
