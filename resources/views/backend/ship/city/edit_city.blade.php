@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<section class="content">
		<div class="row">

			<!--   ------------ Add City Page -------- -->


			<div class="col-12">

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Edit City </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">


							<form method="post" action="{{ route('city.update',$cities->id) }}">
								@csrf


								<div class="form-group">
									<h5>City Name <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="city_name" class="form-control"
											value="{{ $cities->city_name }}">
										@error('city_name')
										<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>



								<div class="text-xs-right">
									<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
								</div>
							</form>





						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>




		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->

</div>




@endsection