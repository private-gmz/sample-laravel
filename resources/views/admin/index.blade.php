@extends('admin.admin_master')
@section('admin')

@can('orders')
@php
$date = date('d-m-y');
$today = App\Models\Order::where('order_date',$date)->sum('amount');

$month = date('F');
$month = App\Models\Order::where('order_month',$month)->sum('amount');

$year = date('Y');
$year = App\Models\Order::where('order_year',$year)->sum('amount');

$pending = App\Models\Order::where('status','pending')->get();

@endphp
<div class="container-full">

	<!-- Main content -->
	<section class="content">
		<div class= "row">
			<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
				<div class="profile_card p-4">
					<div class=" image d-flex flex-column justify-content-center align-items-center"> <button class="img_btn btn-secondary"> <img src="{{asset(Auth::user()->profile_photo_path)}}" height="100" width="100" /></button> 
						<span class="name mt-3">{{Auth::user()->name}}</span>
						<div class="d-flex flex-row justify-content-center align-items-center gap-2"> <span class="idd1">{{Auth::user()->email}}</span> </div>
						<div class=" d-flex mt-2"> <a class="btn1 btn-dark" href="{{route('admin.profile.edit')}}">Edit Profile</a> </div>
						<div class="text mt-3"> <span>your are an admin with {{Auth::user()->role->name}} role</span> </div>
						<div class=" px-2 rounded mt-4 date "> <span class="join">Joined on {{ Auth::user()->created_at}} </span> </div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-4 col-4">
				<div class="box overflow-hidden pull-up">
					<div class="box-body">
						<div class="icon bg-primary-light rounded w-60 h-60">
							<i class="text-primary mr-0 font-size-24 mdi mdi-account-multiple"></i>
						</div>
						<div>
							<p class="text-mute mt-20 mb-0 font-size-16">Today's Sale</p>
							<h3 class="text-white mb-0 font-weight-500">${{ $today }} <small class="text-success"> SYP</small></h3>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-4">
				<div class="box overflow-hidden pull-up">
					<div class="box-body">
						<div class="icon bg-warning-light rounded w-60 h-60">
							<i class="text-warning mr-0 font-size-24 mdi mdi-car"></i>
						</div>
						<div>
							<p class="text-mute mt-20 mb-0 font-size-16">Monthly Sale </p>
							<h3 class="text-white mb-0 font-weight-500">${{ $month }} <small class="text-success">SYP</small></h3>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-4 col-4">
				<div class="box overflow-hidden pull-up">
					<div class="box-body">
						<div class="icon bg-info-light rounded w-60 h-60">
							<i class="text-info mr-0 font-size-24 mdi mdi-sale"></i>
						</div>
						<div>
							<p class="text-mute mt-20 mb-0 font-size-16">Yearly Sale </p>
							<h3 class="text-white mb-0 font-weight-500">${{ $year }} <small class="text-success"> SYP</small></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /.content -->
</div>
@endif

@endsection