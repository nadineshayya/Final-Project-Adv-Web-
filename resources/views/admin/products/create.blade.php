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

        <!-- Submit Button -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i> Create
            </button>
            <a href="{{ route('products.index') }}" class="btn btn-outline-dark">
                <i class="fas fa-times me-2"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@section('customJs')
<script>
    // Your existing JavaScript code for form submission, dropzone, and dynamic subcategories remains unchanged.
</script>
@endsection
