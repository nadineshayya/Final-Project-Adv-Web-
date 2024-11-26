@extends('admin.layouts.app')

@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit Sub Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{route('sub-categories.index')}}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
                        <form action="{{ route('sub-categories.index') }}" name="subCategoryForm" id="subCategoryForm">
						<div class="card">
							<div class="card-body">								
								<div class="row">
                                    <div class="col-md-12">
										<div class="mb-3">
											<label for="name">Category</label>
											<select name="category" id="category" class="form-control">
                                                <option value="">Select a category</option>
                                             @if($categories->isNotEmpty())
                                                @foreach($categories as $category)   
                                                    <option {{($subCategory->category_id == $category->id) ? 'selected': ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                            </select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$subCategory->name}}">	
										<p></p>
                                        </div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="email">Slug</label>
										    <input type="text" name="slug" id="slug" class="form-control" placeholder="Slug" value="{{$subCategory->slug}}">	
										<p></p>
                                        </div>
									</div>
                                    <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option  {{($subCategory->status == 1)}} value="1">Active</option>
                            <option  {{($subCategory->status == 0 )}}   value="0">Blocked</option>
                        </select>
                    </div>
                </div>		
                
                </div><div class="mb-3">
                        <label for="status">Show on Home</label>
                        <select name="showHome" id="showHome" class="form-control">
                            <option value="Yes"  {{ $subCategory->showHome == 'Yes' ? 'selected' : '' }}>Yes</option>
                            <option value="No"  {{ $subCategory->showHome == 'No' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>					
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Update</button>
							<a href="{{route('sub-categories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
                    </form>
					</div>
					<!-- /.card -->
				</section>
@endsection

@section('customJs')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

$('#subCategoryForm').submit(function (event) {
            event.preventDefault();
            
            // Get form data
            var formData = $(this).serialize();
            $("button[type=submit]").prop('disabled', true);
            // AJAX request to store category
            $.ajax({
                url: '{{ route("sub-categories.update", $subCategory->id) }}',

                type: 'put',
                data: formData,
                dataType: 'json', headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                success: function (response) {
                    $("button[type=submit]").prop('disabled', false);
                    $('#categoryForm').find('.is-invalid').removeClass('is-invalid');
                    $('#categoryForm').find('.invalid-feedback').html('');

                    if (!response.status) {
                        // Display validation errors
                        if (response.errors.name) {
                            $('#name').addClass('is-invalid').next('.invalid-feedback').html(response.errors.name.join(', '));
                        }
                        if (response.errors.slug) {
                            $('#slug').addClass('is-invalid').next('.invalid-feedback').html(response.errors.slug.join(', '));
                        }if (response.errors.category) {
                            $('#category').addClass('is-invalid').next('.invalid-feedback').html(response.errors.slug.join(', '));
                        }
                    } else {
                        // Success - show message and redirect
                        alert(response.message);
                        window.location.href = '{{ route("sub-categories.index") }}';
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

    $("#name").change(function(){
        element = $(this);
        $("button[type=submit]").prop('disabled',true);
        $.ajax({
            url:'{{route("getSlug")}}',
            type: 'get',
            data: {title: element.val()},
            dataType: 'json',
            success:function(response){
                $("button[type=submit]").prop('disabled',false);
                if(response["status"]==true){
                    $("#slug").val(response["slug"]);
                }
            }
        });
    });
</script>

@endsection
