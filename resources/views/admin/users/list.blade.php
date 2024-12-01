@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 p-3" 
         style="background: linear-gradient(90deg, #000080, #1e90ff); border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
        <h1 class="h3 text-white fw-bold mb-2 mb-md-0">
            <i class="fas fa-users me-2"></i> Users
        </h1>
        <a href="{{ route('users.create') }}" class="btn btn-light text-primary fw-bold d-flex align-items-center" style="border-radius: 8px;">
            <i class="fas fa-plus me-2"></i> Add New User
        </a>
    </div>

    <!-- Search and Reset Section -->
    <form action="" method="get" class="mb-4">
        <div class="row g-3">
            <div class="col-12 col-md-8 col-lg-9">
                <div class="input-group">
                    <input type="text" name="keyword" value="{{ Request::get('keyword') }}" class="form-control" placeholder="Search users...">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3 text-md-end text-start">
                <button type="button" onclick="window.location.href='{{ route('users.index') }}'" class="btn btn-secondary w-100 w-md-auto">
                    <i class="fas fa-sync me-1"></i> Reset
                </button>
            </div>
        </div>
    </form>

    <!-- Table Section -->
    <div class="card shadow-sm">
        <div class="card-header text-white d-flex justify-content-between align-items-center" 
             style="background: linear-gradient(90deg, #1e90ff, #000080);">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i> Users List</h5>
            <span class="badge bg-light text-primary">{{ $users->count() }} Total</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle text-center">
                    <thead style="background: #000080; color: #fff;">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->isNotEmpty())
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td class="text-start">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">No Records Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex flex-column flex-md-row justify-content-between align-items-center">
            <p class="mb-2 mb-md-0 text-muted">Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() ?? 0 }} of {{ $users->total() }} entries</p>
            <div>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
function deleteCategory(id) {
    // Construct the URL with the category ID
    var url = '{{ route("categories.destroy", ":id") }}'.replace(':id', id);

    // Confirmation dialog
    if (confirm("Are you sure you want to delete this category?")) {
        $.ajax({
            url: url,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status) {
                    // Remove the deleted category row
                    $(`tr:has(td:contains('${id}'))`).remove();
                    alert(response.message);
                } else {
                    alert('Failed to delete the category. Please try again.');
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('An error occurred. Unable to delete the category.');
            }
        });
    }
}

</script>
@endsection
