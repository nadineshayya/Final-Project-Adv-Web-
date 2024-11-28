@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 p-3" 
         style="background: linear-gradient(90deg, #000080, #1e90ff); border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h1 class="h3 text-white fw-bold mb-2 mb-md-0">
            <i class="fas fa-list-alt me-2"></i> Categories
        </h1>
        <a href="{{ route('categories.create') }}" class="btn btn-light text-primary fw-bold d-flex align-items-center" style="border-radius: 8px;">
            <i class="fas fa-plus me-2"></i> Add New Category
        </a>
    </div>

    <!-- Search and Reset Section -->
    <form action="" method="get" class="mb-4">
        <div class="row g-3">
            <div class="col-md-8 col-lg-9">
                <div class="input-group">
                    <input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control" placeholder="Search categories...">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-4 col-lg-3 text-md-end text-start">
                <button type="button" onclick="window.location.href='{{ route('categories.index') }}'" class="btn btn-secondary">
                    <i class="fas fa-sync me-1"></i> Reset
                </button>
            </div>
        </div>
    </form>

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i> Categories List</h5>
            <span class="badge bg-light text-primary">{{ $categories->count() }} Total</span>
        </div>
        <div class="card-body table-responsive p-0">
		<table class="table table-striped table-hover align-middle text-center">
		<thead style="background: #000080; color: #fff;">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>



                <tbody>
                    @if($categories->isNotEmpty())
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td class="text-start">{{ $category->name }}</td>
                            <td class="text-start">{{ $category->slug }}</td>
                            <td>
                                @if($category->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm me-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="deleteCategory({{ $category->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">No Records Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <p class="mb-0 text-muted">Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries</p>
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
    function deleteCategory(id) {
        const url = '{{ route("categories.destroy", ":id") }}'.replace(':id', id);

        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status) {
                        location.reload();
                    } else {
                        alert('Failed to delete the category. Please try again.');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred. Unable to delete the category.');
                }
            });
        }
    }
</script>
@endsection
