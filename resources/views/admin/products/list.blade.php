@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 p-3" 
         style="background: linear-gradient(90deg, #000080, #1e90ff); border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h1 class="h3 text-white fw-bold mb-2 mb-md-0">
            <i class="fas fa-box me-2"></i> Products
        </h1>
        <a href="{{ route('products.create') }}" class="btn btn-light text-primary fw-bold d-flex align-items-center" style="border-radius: 8px;">
            <i class="fas fa-plus me-2"></i> Add New Product
        </a>
    </div>

    <!-- Search and Reset Section -->
    <form action="" method="get" class="mb-4">
        <div class="row g-3">
            <div class="col-12 col-md-8 col-lg-9">
                <div class="input-group">
                    <input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control" placeholder="Search products...">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3 text-md-end text-start">
                <button type="button" onclick="window.location.href='{{ route('products.index') }}'" class="btn btn-secondary w-100 w-md-auto">
                    <i class="fas fa-sync me-1"></i> Reset
                </button>
            </div>
        </div>
    </form>

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center" 
             style="background: linear-gradient(90deg, #1e90ff, #000080);">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i> Products List</h5>
            <span class="badge bg-light text-primary">{{ $products->count() }} Total</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead style="background: #000080; color: #fff;">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">SKU</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($products->isNotEmpty())
                            @foreach($products as $product)
                            @php
                                $productImage = $product->product_images->first();
                            @endphp
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if (!empty($productImage->image) && file_exists(public_path('images/products/' . $productImage->image)))
                                        <img src="{{ asset('images/products/' . $productImage->image) }}" class="img-thumbnail" width="50">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </td>
                                <td class="text-start">{{ $product->title }}</td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>
                                    @if($product->status == 1)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteProduct({{ $product->id }})">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center text-muted py-3">No Records Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="mb-2 mb-md-0 text-muted">Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} entries</p>
            <div>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
    function deleteProduct(productId) {
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: '/admin/products/' + productId,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.status) {
                        alert('Product and associated images deleted successfully!');
                        location.reload();
                    } else {
                        alert('Product deletion failed.');
                    }
                },
                error: function(error) {
                    alert('Error deleting product.');
                }
            });
        }
    }
</script>
@endsection
