@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{route('products.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <form action="{{ route('products.store') }}" method="post" name="productForm" id="productForm">
            @csrf
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Product Details -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Description"></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Upload -->
                        <div class="col-md-12">
                    <div class="mb-3">
                        <input type="hidden" id="image_id" name="image_id" value="">
                        <label for="image">Media</label>
                        <div class="dropzone" id="image-upload">
                            <div class="dz-message needsclick">
                                Drop files here or click to upload.
                            </div>
                        </div>
                    </div>
                </div><div id="product-gallery" class="d-flex flex-wrap"></div>

                        <!-- Pricing -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="mb-3">
                                    <label for="price">Price</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="compare_price">Compare at Price</label>
                                    <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
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
                    </div>

                    <div class="col-md-4">
                        <!-- Product Status -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product Status</h2>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product Category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="sub_category">Sub Category</label>
                                    <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="">Select Sub Category</option>
                                        @if($subCategories->isNotEmpty())
                                          @foreach($subCategories as $subCategory)
                                          <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                          @endforeach
                                        @endif 
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Featured Product -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured Product</h2>
                                <select name="is_featured" id="is_featured" class="form-control">
                                    <option value="No">No</option>
                                    <option value="Yes">Yes</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{route('products.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
    </section>
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
