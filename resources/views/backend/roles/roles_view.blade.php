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
						<h3 class="box-title">Roles List <span class="badge badge-pill badge-danger"> {{ count($roles)
								}} </span></h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Name</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									@foreach($roles as $item)
									<tr>
										<td><input type="text" name="role_name" id="{{$item->id}}"
												value="{{ $item->name}}"></td>
										<td>
											<a href="" onclick="updateRole(this)" id="{{$item->id}}"
												class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
											<a href="{{ route('roles.delete',$item->id) }}" class="btn btn-danger"
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


			<!--   ------------ Add Brand Page -------- -->


			<div class="col-4">

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Add Roles </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">


							<form method="post" action="{{ route('roles.store') }}">
								@csrf


								<div class="form-group">
									<h5>Role Name <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="role_name" class="form-control">
										@error('role_name')
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
<script>
	function updateRole(link) {
		var id = $(link).attr("id");
		var rolename = $('#' + id).val();
		var url = "{{route('roles.update', ['name' => ':rolename', 'id' => ':id'])}}";
		url = url.replace(':rolename', rolename);
		url = url.replace(':id', id);
		$(link).attr("href", url);
	} 
</script>