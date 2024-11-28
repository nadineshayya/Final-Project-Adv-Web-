@extends('admin.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="h3 text-primary fw-bold">
                    <i class="fas fa-plus-circle me-2"></i> Create Sub Category
                </h1>
            </div>
            <div class="col-sm-6 text-end">
                <a href="{{ route('sub-categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form action="{{ route('sub-categories.store') }}" name="subCategoryForm" id="subCategoryForm">
        <div class="container-fluid">
            <div class="row">
                <!-- Form Card -->
                <div class="col-12 col-md-10 col-lg-9 mx-auto"> <!-- Adjusted size for larger screens -->
                    <div class="card shadow-sm" style="max-width: 1200px; margin: auto;"> <!-- Set max-width -->
                        <div class="card-header text-white" style="background: linear-gradient(90deg, #1e90ff, #000080);">
                            <h5 class="mb-0">
                                <i class="fas fa-layer-group me-2"></i> Sub Category Details
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <!-- Category -->
                                <div class="col-12">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="">Select a category</option>
                                        @if($categories->isNotEmpty())
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Name and Slug -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="col-md-6">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug">
                                    <div class="invalid-feedback"></div>
                                </div>

                                <!-- Status and Show on Home -->
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="1">Active</option>
                                        <option value="0">Blocked</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="showHome" class="form-label">Show on Home</label>
                                    <select name="showHome" id="showHome" class="form-select">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Create
                            </button>
                            <a href="{{ route('sub-categories.index') }}" class="btn btn-outline-dark">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection

@section('customJs')
<script>
    $('#subCategoryForm').submit(function(event) {
        event.preventDefault();

        var formData = $(this).serialize();
        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: '{{ route("sub-categories.store") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                $('#subCategoryForm').find('.is-invalid').removeClass('is-invalid');
                $('#subCategoryForm').find('.invalid-feedback').html('');

                if (!response.status) {
                    if (response.errors.name) {
                        $('#name').addClass('is-invalid').next('.invalid-feedback').html(response.errors.name.join(', '));
                    }
                    if (response.errors.slug) {
                        $('#slug').addClass('is-invalid').next('.invalid-feedback').html(response.errors.slug.join(', '));
                    }
                    if (response.errors.category) {
                        $('#category').addClass('is-invalid').next('.invalid-feedback').html(response.errors.category.join(', '));
                    }
                } else {
                    alert(response.message);
                    window.location.href = '{{ route("sub-categories.index") }}';
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });

    $("#name").change(function() {
        let element = $(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("getSlug") }}',
            type: 'get',
            data: { title: element.val() },
            dataType: 'json',
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response.status) {
                    $("#slug").val(response.slug);
                }
            }
        });
    });
</script>
@endsection
