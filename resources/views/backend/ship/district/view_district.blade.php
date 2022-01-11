@extends('admin.admin_master')
@section('admin')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<section class="content">
		<div class="row">



			<div class="col-8">

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">District List</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>City Name </th>
										<th>District Name </th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									@foreach($district as $item)
									<tr>
										<td> {{ $item->city->city_name }} </td>
										<td> {{ $item->district_name }} </td>

										<td width="40%">
											<a href="{{ route('district.edit',$item->id) }}" class="btn btn-info"
												title="Edit Data"><i class="fa fa-pencil"></i> </a>
											<a href="{{ route('district.delete',$item->id) }}" class="btn btn-danger"
												title="Delete Data" id="delete">
												<i class="fa fa-trash"></i></a>
										</td>

									</tr>
									@endforeach
								</tbody>

							</table>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->


			</div>
			<!-- /.col -->


			<!--   ------------ Add District Page -------- -->


			<div class="col-4">

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Add District </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">


							<form method="post" action="{{ route('district.store') }}">
								@csrf



								<div class="form-group">
									<h5>City Select <span class="text-danger">*</span></h5>
									<div class="controls">
										<select name="city_id" class="form-control">
											<option value="" selected="" disabled="">Select City</option>
											@foreach($city as $one_city)
											<option value="{{ $one_city->id }}">{{ $one_city->city_name }}</option>
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
										<input type="text" name="district_name" class="form-control">
										@error('district_name')
										<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>



								<div class="text-xs-right">
									<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
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