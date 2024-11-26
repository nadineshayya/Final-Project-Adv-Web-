@extends('admin.layouts.app')



@section('content')
<h1>Edit Category</h1>
<div class="content-wrapper">
    <form action="{{ route('categories.update', $category->id) }}" method="POST" id="categoryForm" name="categoryForm">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ $category->name }}">
                        </div>
                    </div>

                    <!-- Dropzone -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <input type="hidden" id="image_id" name="image_id" value="">
                            <label for="image">Upload Image</label>
                            <div class="dropzone" id="image-upload">
                                <div class="dz-message needsclick">
                                    Drop files here or click to upload.
                                </div>
                            </div>
                            @if ($category->image)
                                <img src="{{ asset('uploads/category/' . $category->image) }}" alt="Current Image" class="mt-2" width="150">
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{ $category->slug }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Blocked</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status">Show on Home</label>
                        <select name="showHome" id="showHome" class="form-control">
                            <option value="Yes"  {{ $category->showHome == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No"  {{ $category->showHome == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
</div>


@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
Dropzone.autoDiscover = false;

$(document).ready(function () {
    const dropzone = new Dropzone("#image-upload", {
        url: "{{ route('temp-images.create') }}",
        maxFiles: 1,
        paramName: "image",
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (file, response) {
            $("#image_id").val(response.image_id);
        },
        removedfile: function (file) {
            $("#image_id").val('');
        },
    });

    $('#categoryForm').submit(function (event) {
        event.preventDefault();

        const formData = new FormData(this);
        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            success: function (response) {
                $("button[type=submit]").prop('disabled', false);
                if (!response.status) {
                    alert("Validation errors occurred.");
                } else {
                    alert(response.message);
                    window.location.href = '{{ route("categories.index") }}';
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});



</script>
@endsection
