@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 p-3"
         style="background: linear-gradient(90deg, #000080, #1e90ff); border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h1 class="h3 text-white fw-bold mb-2 mb-md-0">
            <i class="fas fa-list-alt me-2"></i> Sub Categories
        </h1>
        <a href="{{ route('sub-categories.create') }}" class="btn btn-light text-primary fw-bold d-flex align-items-center" style="border-radius: 8px;">
            <i class="fas fa-plus me-2"></i> New Sub Category
        </a>
    </div>

    <!-- Search and Reset Section -->
    <form action="" method="get" class="mb-4">
        <div class="row g-3">
            <div class="col-md-8 col-lg-9">
                <div class="input-group">
                    <input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control" placeholder="Search subcategories...">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 text-md-end text-start">
                <button type="button" onclick="window.location.href='{{ route('sub-categories.index') }}'" class="btn btn-secondary">
                    <i class="fas fa-sync me-1"></i> Reset
                </button>
            </div>
        </div>
    </form>

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center"
             style="background: linear-gradient(90deg, #1e90ff, #000080);">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i> Sub Categories List</h5>
            <span class="badge bg-light text-primary">{{ $subCategories->count() }} Total</span>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-striped table-hover align-middle text-center">
                <thead style="background: #000080; color: #fff;">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($subCategories->isNotEmpty())
                        @foreach($subCategories as $subCategory)
                        <tr>
                            <td>{{ $subCategory->id }}</td>
                            <td class="text-start">{{ $subCategory->name }}</td>
                            <td class="text-start">{{ $subCategory->categoryName }}</td>
                            <td class="text-start">{{ $subCategory->slug }}</td>
                            <td>
                                @if($subCategory->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('sub-categories.edit', $subCategory) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="deleteSubCategory({{ $subCategory->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">No Records Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <p class="mb-0 text-muted">Showing {{ $subCategories->firstItem() ?? 0 }} to {{ $subCategories->lastItem() ?? 0 }} of {{ $subCategories->total() }} entries</p>
            {{ $subCategories->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
    function deleteSubCategory(subCategoryId) {
        if (confirm('Are you sure you want to delete this subcategory?')) {
            const url = `/admin/sub-categories/${subCategoryId}`;
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Failed to delete subcategory: ' + response.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while deleting the subcategory.');
                }
            });
        }
    }
</script>
@endsection
