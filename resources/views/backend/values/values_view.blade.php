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
						<h3 class="box-title">All Values <span class="badge badge-pill badge-danger"> {{ count($values)
								}} </span> </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>name </th>
										<th>attribute name</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									@foreach($values as $item)
									<tr>
										<td><input name="{{ $item->id}}" id="{{ $item->id}}" value="{{ $item->name}}">
										</td>
										<td>{{ $item->attribute->name}}</td>
										<td width="30%">
											<a href="" id="{{$item->id}}" onClick="updateValue(this)"
												class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>

											<a href="{{ route('values.delete',$item->id) }}" class="btn btn-danger"
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


			<!--   ------------ Add Category Page -------- -->


			<div class="col-4">

				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Add Values </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">


							<form method="post" action="{{ route('values.store') }}">
								@csrf


								<div class="form-group">
									<h5>Attribute Select <span class="text-danger">*</span></h5>
									<div class="controls">
										<select name="attribute_id" class="form-control">
											<option value="" selected="" disabled="">Select Attribute</option>
											@foreach($attributes as $attribute)
											<option value="{{ $attribute->id }}">{{ $attribute->name}}</option>
											@endforeach
										</select>
										@error('attribute_id')
										<span class="text-danger">{{ $message }}</span>
										@enderror
									</div>
								</div>


								<div class="form-group">
									<h5>Value Name <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="value_name" class="form-control">
										@error('value_name')
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
	function updateValue(link) {
		var id = $(link).attr("id");
		var valname = $('#' + id).val();
		var url = "{{route('values.update', ['name' => ':valname', 'id' => ':id'])}}";
		url = url.replace(':valname', valname);
		url = url.replace(':id', id);
		$(link).attr("href", url);
	} 
</script>