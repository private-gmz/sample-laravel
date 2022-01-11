<header class="main-header">
	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top pl-30">
		<!-- Sidebar toggle button-->
		<div>
			<ul class="nav">
				<li class="btn-group nav-item">
					<a href="#" class="waves-effect waves-light nav-link rounded svg-bt-icon" data-toggle="push-menu"
						role="button">
						<i class="nav-link-icon mdi mdi-menu"></i>
					</a>
				</li>
				<li class="btn-group nav-item">
					<a href="#" data-provide="fullscreen" class="waves-effect waves-light nav-link rounded svg-bt-icon"
						title="Full Screen">
						<i class="nav-link-icon mdi mdi-crop-free"></i>
					</a>
				</li>
			</ul>
		</div>

		<div class="navbar-custom-menu r-side">
			<ul class="nav navbar-nav">

				<!-- Notifications -->

				<li class="dropdown notifications-menu">

					<a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown"
						title="Notifications">
						<span>
							<i class="ti-bell"></i>
							<span id='counter' class="badge badge-light">0</span>
						</span>
					</a>



					<ul class="dropdown-menu animated bounceIn" style ="width:300px  !important">

						<li class="header">
							<div class="p-20">
								<div class="flexbox">
									<div>
										<h4 class="mb-0 mt-0">Notifications</h4>
									</div>
								</div>
							</div>
						</li>

						<li>
							<!-- inner menu: contains the actual data -->
							<ul id='notifications' class="menu sm-scrol">
							</ul>
						</li>

					</ul>
				</li>


				<!-- User Account-->
				<li class="dropdown user user-menu">
					<a href="#" class="waves-effect waves-light rounded dropdown-toggle p-0" data-toggle="dropdown"
						title="User">
						<img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="">
					</a>
					<ul class="dropdown-menu animated flipInX">
						<li class="user-body">
							<a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><i
									class="ti-user text-muted mr-2"></i> Profile</a>

							<a class="dropdown-item" href="{{ route('admin.change.password') }}"><i
									class="ti-wallet text-muted mr-2"></i> Change Password </a>

							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="{{ route('admin.logout') }}"><i
									class="ti-lock text-muted mr-2"></i> Logout</a>
						</li>
					</ul>
				</li>

			</ul>
		</div>
	</nav>
</header>
@can('orders')
<script src="{{ asset('js/app.js') }}"></script>

<script>
	window.Echo.channel('EventTriggered')
		.listen('GetRequestEvent', (e) => {
			console.log(e)

			var li = document.createElement("li");
			var a = document.createElement('a');
			var i = document.createElement('i');
			var text = document.createTextNode(e.message['message']);
			i.className = "fa fa-users text-info";

			var url = "{{ route('pending.order.details', ':id') }}";
			url = url.replace(':id', e.message['order_id']);
			a.href = url;
			i.appendChild(text);
			a.appendChild(i);
			li.appendChild(a);
			document.querySelector('#notifications').appendChild(li);
			var counter = document.querySelector('#counter');
			counter.innerHTML = parseInt(counter.textContent) + 1;
		})
</script>
@endif