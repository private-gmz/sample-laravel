@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-full">

	<section class="content">

		<!-- Basic Forms -->
		<div class="box">
			<div class="box-header with-border">
				<h4 class="box-title">Create Admin User </h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col">
						<form method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="col-12">

									<div class="row">
										<div class="col-md-6">

											<div class="form-group">
												<h5>Admin User Name <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="name" class="form-control">
												</div>
											</div>

										</div> <!-- end cold md 6 -->



										<div class="col-md-6">

											<div class="form-group">
												<h5>Admin Email <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="email" name="email" class="form-control">
												</div>
											</div>

										</div> <!-- end cold md 6 -->

									</div> <!-- end row 	 -->




									<div class="row">
										<div class="col-md-6">

											<div class="form-group">
												<h5>Admin User Phone <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="text" name="phone" class="form-control">
												</div>
											</div>

										</div> <!-- end cold md 6 -->



										<div class="col-md-6">

											<div class="form-group">
												<h5>Admin Password <span class="text-danger">*</span></h5>
												<div class="controls">
													<input type="password" name="password" class="form-control">
												</div>
											</div>

										</div> <!-- end cold md 6 -->

									</div> <!-- end row 	 -->







									<div class="row">

										<div class="col-md-3">
											<div class="form-group">
												<h5>Admin User Image </h5>
												<div class="controls">
													<input type="file" name="profile_photo_path" class="form-control"
														id="image">
												</div>
											</div>
										</div><!-- end cold md 3 -->

										<div class="col-md-3">
											<img id="showImage" src="{{ url('upload/no_image.jpg') }}"
												style="width: 100px; height: 100px;">

										</div><!-- end cold md 4 -->

										<div class="col-md-6">
											<div class="form-group">
												<h5>Role </h5>
												<div class="controls">
													<select name='role' class="form-control">
														@php
														$allroles = \App\Helpers\Helpers::get_roles();
														@endphp
														@foreach($allroles as $role)
														<option value='{{$role->id}}'>{{$role->name}}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div><!-- end cold md 6 -->
									</div><!-- end row 	 -->



									<hr>



									<div class="row">

										<div class="text-xs-right">
											<input type="submit" class="btn btn-rounded btn-primary mb-5"
												value="Add Admin User">
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



</div>


<script type="text/javascript">
	$(document).ready(function () {
		$('#image').change(function (e) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#showImage').attr('src', e.target.result);
			}
			reader.readAsDataURL(e.target.files['0']);
		});
	});
</script>


@endsection