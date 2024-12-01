@extends('admin.layouts.app')

@section('content')

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-12 col-md-6">
                <h1 class="h3 text-primary fw-bold">
                    <i class="fas fa-tags me-2"></i> Discount Coupons
                </h1>
            </div>
            <div class="col-12 col-md-6 text-md-end">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i> New Category
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        @include('admin.message')

        <div class="card shadow-sm">
            <!-- Search and Reset -->
            <form action="" method="get">
                <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center">
                    <button type="button" onclick="window.location.href='{{ route('coupon.index') }}'" class="btn btn-secondary btn-sm mb-2 mb-md-0">
                        <i class="fas fa-sync me-1"></i> Reset
                    </button>
                    <div class="input-group" style="max-width: 400px;">
                        <input value="{{ Request::get('keyword') }}" type="text" name="keyword" class="form-control" placeholder="Search">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Table Section -->
            <div class="card-body p-0">
                <div class="table-responsive d-none d-md-block">
                    <table class="table table-striped table-hover align-middle text-center">
                        <thead style="background: linear-gradient(90deg, #1e90ff, #000080); color: #fff;">
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Discount</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($discountCoupon->isNotEmpty())
                                @foreach($discountCoupon as $discountcoup)
                                <tr>
                                    <td>{{ $discountcoup->id }}</td>
                                    <td>{{ $discountcoup->code }}</td>
                                    <td>{{ $discountcoup->name }}</td>
                                    <td>
                                        @if($discountcoup->type == 'percent')
                                            {{ $discountcoup->discount_account }}%
                                        @else
                                            ${{ $discountcoup->discount_account }}
                                        @endif
                                    </td>
                                    <td>{{ $discountcoup->starts_at ? \Carbon\Carbon::parse($discountcoup->starts_at)->format('Y-m-d') : '-' }}</td>
                                    <td>{{ $discountcoup->expires_at ? \Carbon\Carbon::parse($discountcoup->expires_at)->format('Y-m-d') : '-' }}</td>
                                    <td>
                                        @if($discountcoup->status == 1)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('coupon.edit', $discountcoup->id) }}" class="btn btn-warning btn-sm mb-2">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <button class="btn btn-danger btn-sm" onclick="deleteCategory({{ $discountcoup->id }})">
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

                <!-- Vertical Layout for Smaller Screens -->
                <div class="d-md-none">
                    @if($discountCoupon->isNotEmpty())
                        @foreach($discountCoupon as $discountcoup)
                        <div class="border p-3 mb-3 rounded" style="background-color: #f9f9f9;">
                            <p><strong>ID:</strong> {{ $discountcoup->id }}</p>
                            <p><strong>Code:</strong> {{ $discountcoup->code }}</p>
                            <p><strong>Name:</strong> {{ $discountcoup->name }}</p>
                            <p><strong>Discount:</strong> 
                                @if($discountcoup->type == 'percent')
                                    {{ $discountcoup->discount_account }}%
                                @else
                                    ${{ $discountcoup->discount_account }}
                                @endif
                            </p>
                            <p><strong>Start Date:</strong> {{ $discountcoup->starts_at ? \Carbon\Carbon::parse($discountcoup->starts_at)->format('Y-m-d') : '-' }}</p>
                            <p><strong>End Date:</strong> {{ $discountcoup->expires_at ? \Carbon\Carbon::parse($discountcoup->expires_at)->format('Y-m-d') : '-' }}</p>
                            <p><strong>Status:</strong> 
                                @if($discountcoup->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </p>
                            <div>
                                <a href="{{ route('coupon.edit', $discountcoup->id) }}" class="btn btn-warning btn-sm mb-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="deleteCategory({{ $discountcoup->id }})">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center text-muted py-3">No Records Found</p>
                    @endif
                </div>
            </div>

            <!-- Pagination -->
            <div class="card-footer d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="mb-2 mb-md-0 text-muted">Showing {{ $discountCoupon->firstItem() ?? 0 }} to {{ $discountCoupon->lastItem() ?? 0 }} of {{ $discountCoupon->total() }} entries</p>
                {{ $discountCoupon->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>

@endsection

@section('customJs')
<script>
    function deleteCategory(id) {
        const url = '{{ route("coupon.destroy", ":id") }}'.replace(':id', id);

        if (confirm("Are you sure you want to delete this coupon code?")) {
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
                        alert('Failed to delete the coupon code. Please try again.');
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred. Unable to delete the coupon code.');
                }
            });
        }
    }
</script>
@endsection
