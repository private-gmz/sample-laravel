@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<section class="content">
		<div class="row">


			<!--   ------------ Add District Page -------- -->


			<div class="col-6">

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Edit District </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">


							<form method="post" action="{{ route('district.update',$district->id ) }}">
								@csrf



								<div class="form-group">
									<h5>City Select <span class="text-danger">*</span></h5>
									<div class="controls">
										<select name="city_id" class="form-control">
											<option value="" selected="" disabled="">Select City</option>
											@foreach($city as $one_city)
											<option value="{{ $one_city->id }}" {{ $one_city->id == $district->city_id ?
												'selected': '' }} >{{ $one_city->city_name }}</option>
											@endforeach
										</select>
										@error('city_id')
										<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>



								<div class="form-group">
									<h5>District Name <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="district_name" class="form-control"
											value="{{ $district->district_name }}">
										@error('district_name')
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