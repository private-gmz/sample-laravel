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
						<h3 class="box-title">Attributes List <span class="badge badge-pill badge-danger"> {{
								count($attributes) }} </span></h3>
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
									@foreach($attributes as $item)
									<tr>
										<td><input type="text" name="attribute_name" id="{{$item->id}}"
												value="{{ $item->name}}"></td>
										<td>
											<a href="" onclick="updateAttribute(this)" id="{{$item->id}}"
												class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
											<a href="{{ route('attribites.delete',$item->id) }}" class="btn btn-danger"
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
						<h3 class="box-title">Add Attributes </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">


							<form method="post" action="{{ route('attribites.store') }}">
								@csrf


								<div class="form-group">
									<h5>Attribute Name <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="attribute_name" class="form-control">
										@error('attribute_name')
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
	function updateAttribute(link) {
		var id = $(link).attr("id");
		var atrrname = $('#' + id).val();
		var url = "{{route('attribites.update', ['name' => ':atrrname', 'id' => ':id'])}}";
		url = url.replace(':atrrname', atrrname);
		url = url.replace(':id', id);
		$(link).attr("href", url);
	} 
</script>