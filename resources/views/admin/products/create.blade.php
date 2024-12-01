@extends('admin.layouts.app')

@section('content')
<!-- Content Header -->
<div class="container-fluid mb-4">
    <div class="d-flex justify-content-between align-items-center p-3"
         style="background: linear-gradient(90deg, #000080, #1e90ff); border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h1 class="h3 text-white fw-bold">
            <i class="fas fa-plus-circle me-2"></i> Create Product
        </h1>
        <a href="{{ route('products.index') }}" class="btn btn-light text-primary fw-bold">
            <i class="fas fa-arrow-left me-2"></i> Back
        </a>
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid">
    <form action="{{ route('products.store') }}" method="POST" id="productForm">
        @csrf
        <div class="row g-4">
            <!-- Left Section -->
            <div class="col-md-8">
                <!-- Product Details -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Product Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter product title">
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Enter product slug">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter product description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea name="short_description" id="short_description" class="form-control" rows="3" placeholder="Enter short description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="shipping_returns" class="form-label">Shipping & Returns</label>
                            <textarea name="shipping_returns" id="shipping_returns" class="form-control" rows="3" placeholder="Enter shipping and return policies"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Media Upload -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-upload me-2"></i> Media Upload</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Images</label>
                            <div class="dropzone" id="image-upload">
                                <div class="dz-message">Drop files here or click to upload</div>
                            </div>
                        </div>
                        <div id="product-gallery" class="d-flex flex-wrap"></div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-dollar-sign me-2"></i> Pricing</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" name="price" id="price" class="form-control" placeholder="Enter price">
                        </div>
                        <div class="mb-3">
                            <label for="compare_price" class="form-label">Compare at Price</label>
                            <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Enter compare price">
                            <small class="text-muted">Use this to show a reduced price by entering the original price here.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section -->
            <div class="col-md-4">
                <!-- Product Status -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-toggle-on me-2"></i> Product Status</h5>
                    </div>
                    <div class="card-body">
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <!-- Product Category -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-tags me-2"></i> Product Category</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sub_category" class="form-label">Sub Category</label>
                            <select name="sub_category" id="sub_category" class="form-control">
                                <option value="">Select Sub Category</option>
                                @if($subCategories->isNotEmpty())
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Featured Product -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-star me-2"></i> Featured Product</h5>
                    </div>
                    <div class="card-body">
                        <select name="is_featured" id="is_featured" class="form-control">
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>
                                <div class="mb-3">
                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="SKU">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="barcode">Barcode</label>
                                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                                </div>
                                            </div>   
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" checked>
                                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                <div class="mb-3">
                                    <label for="qty">Quantity</label>
                                    <input type="number" name="qty" id="qty" class="form-control" min="0" placeholder="Quantity">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
        <!-- Submit Button -->
        <div class="text-end">
        <button type="submit" class="btn btn-primary me-2">Create</button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@section('customJs')


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $("#productForm").submit(function(event) {
        event.preventDefault();
        var formArray = $(this).serializeArray();
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("products.store") }}',
            type: 'POST',
            data: formArray,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response.status) {

                    alert('Product created successfully!');
                    window.location.href="{{route('products.index')}}";
                } else {
                    var errors = response.errors;

                    // Clear previous errors
                    $("input, textarea, select").removeClass('is-invalid');
                    $(".invalid-feedback").html("");

                    // Highlight invalid inputs and show error messages
                    for (const [key, messages] of Object.entries(errors)) {
                        var field = $(`[name="${key}"]`);
                        field.addClass('is-invalid');
                        field.siblings('.invalid-feedback').html(messages[0]);
                }
            }
            
     },error: function(xhr) {
                console.error("Error:", xhr.responseText);
            } });
    });

    // Dynamic Subcategories
   $("#category").change(function () {
    var categoryId = $(this).val();
    if (categoryId) {
        $.ajax({
            url: '{{ route("product-subcategories.index") }}',
            type: 'GET',
            data: { category_id: categoryId },
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
Dropzone.autoDiscover = false;

$(document).ready(function () {
    const dropzone = new Dropzone("#image-upload", {
        url: "{{ route('temp-images.create') }}",
        maxFiles: 10,
        paramName: "image",
        acceptedFiles: "image/*",  // Restrict to image types
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(file, response) {
            let imageCell = `
                    <th class="text-center" id="image-row-${response.image_id}">
                        <div class="card" style="width: 150px;">
                        <input type="hidden" name="image_array[]" value="${response.image_id}}">
                            <img src="${response.ImagePath}" class="card-img-top" alt="Uploaded Image">
                            <div class="card-body text-center">
                                <button href="javascript:void(0)" onclick="deleteImage(${response.image_id})"class="btn btn-danger btn-sm remove-image" data-id="${response.image_id}">Remove</button>
                            </div>
                        </div>
                    </th>
                `;
                $('#product-gallery').append(imageCell);
            // Store the image ID in the hidden input field
            $("#image_id").val(response.image_id);
        },
        complete: function(file) {
            // Clear the image_id when the file is removed
            this.removeFile(file);
        },
    });});

function deleteImage(id){
$("#image-row-"+id).remove();
}

</script>
@endsection
