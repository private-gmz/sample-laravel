@extends('frontend.main_master')
@section('content')

<div class="body-content">
	<div class="container">
		<div class="row">

			@include('frontend.common.user_sidebar')

			<div class="col-md-2">

			</div> <!-- // end col md 2 -->


			<div class="col-md-6">
				<div class="card">
					<h3 class="text-center"><span class="text-danger">Hi....</span><strong>{{ Auth::user()->name
							}}</strong> Welcome to our website</h3>
							<h2>RECOMMENDATION HERE...</h2>

				</div>



			</div> <!-- // end col md 6 -->

		</div> <!-- // end row -->

	</div>

</div>


@endsection