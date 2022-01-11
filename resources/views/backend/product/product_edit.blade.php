@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container-full">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<section class="content">

		<!-- Basic Forms -->
		<div class="box">
			<div class="box-header with-border">
				<h4 class="box-title">Edit Product </h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col">

						<form method="post" id="form-id" action="{{ route('product-update') }}">
							@csrf
							<input type="hidden" name="id" value="{{ $products->id }}">
							<div class="row">
								<div class="col-12">


									<div class="row">
										<!-- start 1st row  -->

										<div class="col-md-4">

											<div class="form-group">
												<h5>Category Select <span class="text-danger">*</span></h5>
												<div class="controls">
													<select name="category_id" class="form-control" required="">
														<option value="" selected="" disabled="">Select Category
														</option>
														@foreach($categories as $category)
														<option value="{{ $category->id }}" {{ $category->id ==
															$products->category_id ? 'selected': '' }} >{{
															$category->category_name_en }}</option>
														@endforeach
													</select>
													@error('category_id')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

										</div> <!-- end col md 4 -->


										<div class="col-md-4">

											<div class="form-group">
												<h5>SubCategory Select </h5>
												<div class="controls">
													<select name="subcategory_id" class="form-control">
														<option value="" selected="" disabled="">Select SubCategory
														</option>

														@foreach($subcategory as $sub)
														<option value="{{ $sub->id }}" {{ $sub->id ==
															$products->subcategory_id ? 'selected': '' }} >{{
															$sub->subcategory_name_en }}</option>
														@endforeach

													</select>
													@error('subcategory_id')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

										</div> <!-- end col md 4 -->

										<div class="col-md-4">

											<div class="form-group">
												<h5>Product Name En <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="product_name_en" class="form-control"
														required="" value="{{ $products->product_name_en }}">
													@error('product_name_en')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

										</div> <!-- end col md 4 -->

									</div> <!-- end 1st row  -->






									<div class="row">
										<!-- start 3RD row  -->
										<div class="col-md-4">

											<div class="form-group">
												<h5>Product Code <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="product_code" class="form-control"
														required="" value="{{ $products->product_code }}">
													@error('product_code')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

										</div> <!-- end col md 4 -->

										<div class="col-md-4">

											<div class="form-group">
												<h5>Product Quantity <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="product_qty" class="form-control"
														required="" value="{{ $products->product_qty }}">
													@error('product_qty')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

										</div> <!-- end col md 4 -->
										<div class="col-md-4">

											<div class="form-group">
												<h5>Product Selling Price <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="selling_price" class="form-control"
														required="" value="{{ $products->selling_price }}">
													@error('selling_price')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>


										</div> <!-- end col md 4 -->


									</div> <!-- end 3RD row  -->




									<div class="row">
										<!-- start 6th row  -->

										<div class="col-md-4">

											<div class="form-group">
												<h5>Product Discount Price <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="discount_price" class="form-control"
														value="{{ $products->discount_price }}">
													@error('discount_price')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

										</div> <!-- end col md 4 -->

										<div class="col-md-4">

											<div class="form-group">
												<h5>Product Tags En <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="product_tags_en" class="form-control"
														value="{{ $products->product_tags_en }}" data-role="tagsinput"
														required="">
													@error('product_tags_en')
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

										</div> <!-- end col md 4 -->

										<div class="col-md-4">

											<div class="form-group">
												<h5>Short Description English <span class="text-danger">*</span></h5>
												<div class="controls">
													<textarea name="short_descp_en" id="textarea" class="form-control"
														required placeholder="Textarea text">
{!! $products->short_descp_en !!}
</textarea>
												</div>
											</div>

										</div> <!-- end col md 4 -->
									</div> <!-- end 6th row  -->




									<hr>
									<div class="box-header with-border">
										<h4 class="box-title">Other Attributes </h4>
									</div>

									@php
									$attributes = App\Models\Attributes::latest()->get();
									@endphp

									<div class="row">
										@foreach($attributes as $attribute)
										@php
										$values = "";
										foreach($Pattributes as $Pattribute) {
										if ($Pattribute->val->attribute->name == $attribute->name)
										$values.= $Pattribute->val->name.",";
										}
										@endphp
										<div class="col-md-4">
											<div class="form-group">
												<h5>{{$attribute->name}} </h5>
												<div class="controls">
													<input type="text" name="attributes[{{$attribute->name}}]"
														class="form-control" value="{{$values}}" data-role="tagsinput">

													@error($attribute->name)
													<span class="text-danger">{{ $message }}</span>
													@enderror
												</div>
											</div>

										</div> <!-- end col md 4 -->
										@endforeach
									</div>


									<hr>



									<div class="row">

										<div class="col-md-6">
											<div class="form-group">

												<div class="controls">
													<fieldset>
														<input type="checkbox" id="checkbox_2" name="hot_deals"
															value="1" {{ $products->hot_deals == 1 ? 'checked': '' }}>
														<label for="checkbox_2">Hot Deals</label>
													</fieldset>
													<fieldset>
														<input type="checkbox" id="checkbox_3" name="featured" value="1"
															{{ $products->featured == 1 ? 'checked': '' }}>
														<label for="checkbox_3">Featured</label>
													</fieldset>
												</div>
											</div>
										</div>


									</div>

									<div class="text-xs-right">
										<input type="submit" class="btn btn-rounded btn-primary mb-5"
											value="Update Product">
									</div>
						</form>

					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

	</section>
	<!-- /.content -->


	<!-- ///////////////// Start Multiple Image Update Area ///////// -->
@if(count($multiImgs)>0)
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box bt-3 border-info">
					<div class="box-header">
						<h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
					</div>


					<form method="post" action="{{ route('update-product-image') }}" enctype="multipart/form-data">
						@csrf
						<div class="row row-sm" id="multiImages">
							@foreach($multiImgs as $img)
							<div class="col-md-3">
								<div class="card">
									<img src="{{ asset($img->photo_name) }}" id="{{$img->id}}" class="card-img-top"
										style="height: 130px; width: 280px;">
									<div class="card-body">
										<h5 class="card-title">
											<a href="{{ route('product.multiimg.delete',$img->id) }}"
												class="btn btn-sm btn-danger" id="{{$img->id}}" title="Delete Data"><i
													class="fa fa-trash"></i> </a>
										</h5>
										<p class="card-text">
										<div class="form-group">
											<label class="form-control-label">Change Image </label>
											<input class="form-control" type="file" name="multi_img[{{ $img->id }}]"
												id="{{$img->id}}" onChange="showNew(this)">
										</div>
										</p>

									</div>
								</div>


							</div><!--  end col md 3		 -->
							@endforeach

							<div class="text-xs-right">
								<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
							</div>
							<br><br>



					</form>




				</div>
			</div>



		</div> <!-- // end row  -->

	</section>
	@endif
	<!-- ///////////////// End Start Multiple Image Update Area ///////// -->

	<section class="content">
		<div class="row">
			<!--  dropzone		 -->
			<div class="col-md-12">
				<label for="document" class="form-control-label">Add New Images </label>
				<div class="needsclick dropzone" id="document-dropzone">
				</div>
			</div>

		</div> <!-- // end row  -->

	</section>

	<!-- ///////////////// Start Thambnail Image Update Area ///////// -->

	<section class="content">
		<div class="row">

			<div class="col-md-12">
				<div class="box bt-3 border-info">
					<div class="box-header">
						<h4 class="box-title">Product Thambnail Image <strong>Update</strong></h4>
					</div>


					<form method="post" action="{{ route('update-product-thambnail') }}" enctype="multipart/form-data">
						@csrf

						<input type="hidden" name="id" value="{{ $products->id }}">
						<input type="hidden" name="old_img" value="{{ $products->product_thambnail }}">

						<div class="row row-sm">

							<div class="col-md-3">

								<div class="card">
									<img src="{{ asset($products->product_thambnail) }}" id="mainThmb"
										class="card-img-top" style="height: 130px; width: 280px;">
									<div class="card-body">

										<p class="card-text">
										<div class="form-group">
											<label class="form-control-label">Change Image <span
													class="tx-danger">*</span></label>
											<input type="file" name="product_thambnail" class="form-control"
												onChange="mainThamUrl(this)">
										</div>
										</p>

									</div>
								</div>

							</div><!--  end col md 3		 -->


						</div>

						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
						</div>
						<br><br>



					</form>





				</div>
			</div>



		</div> <!-- // end row  -->

	</section>
	<!-- ///////////////// End Start Thambnail Image Update Area ///////// -->







</div>





<script type="text/javascript">
	$(document).ready(function () {
		$('select[name="category_id"]').on('change', function () {
			var category_id = $(this).val();
			if (category_id) {
				$.ajax({
					url: "{{  url('/category/subcategory/ajax') }}/" + category_id,
					type: "GET",
					dataType: "json",
					success: function (data) {
						$('select[name="subsubcategory_id"]').html('');
						var d = $('select[name="subcategory_id"]').empty();
						$.each(data, function (key, value) {
							$('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name_en + '</option>');
						});
					},
				});
			} else {
				alert('danger');
			}
		});


	});
</script>



<script>
	var uploadedDocumentMap = {}
	Dropzone.options.documentDropzone = {
		url: "{{ route('add-new-images',$products->id) }}",
		dictDefaultMessage: "Drop Files Here or Click to Browse",
		acceptedFiles: 'image/*',
		maxFilesize: 5, // MB
		addRemoveLinks: true,
		headers: {
			'X-CSRF-TOKEN': "{{ csrf_token() }}"
		},
		success: function (file, response) {
			$('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
			uploadedDocumentMap[file.name] = response.name
		},

		removedfile: function (file) {
			var name = uploadedDocumentMap[file.name];
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': "{{ csrf_token() }}"
				},
				type: 'POST',
				url: "{{ route('delete-new-images') }}",
				data: { filename: name },
				success: function (data) {
					console.log(data.success);
				},
				error: function (e) {
					console.log(e);
				}
			});
			var fileRef;
			return (fileRef = file.previewElement) != null ?
				fileRef.parentNode.removeChild(file.previewElement) : void 0;
		},

		init: function () {
			myDropzone = this;
			@if (isset($project) && $project -> document)
				var files =
					{!! json_encode($project -> document)!!
		}
        for(var i in files) {
		var file = files[i]
		this.options.addedfile.call(this, file)
		file.previewElement.classList.add('dz-complete')
		$('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
	}
	@endif
    }
  }
</script>

<script>
	$(window).ready(function () {
		$("#form-id").on("keypress", function (event) {
			var keyPressed = event.keyCode || event.which;
			if (keyPressed === 13) {
				event.preventDefault();
				return false;
			}
		});
	});


	function showNew(input) {
		var id = $(input).attr("id");
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#' + id).attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}


	function mainThamUrl(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#mainThmb').attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>



@endsection