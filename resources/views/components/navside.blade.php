<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-xl fixed-start my-3 ms-4 border-0 bg-white"
	id="sidenav-main" data-color="primary">
	<div class="sidenav-header text-center">
		<a class="navbar-brand m-0" href="{{ route('dashboard') }}">
			<img src="{{ asset('assets/admin/assets/img') }}/hospital.png" class="img-fluid" height="48"
				alt="logo Brand">
		</a>
	</div>
	<hr class="horizontal dark mt-0">
	<div class="navbar-collapse collapse h-auto w-auto" id="sidenav-collapse-main">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
					<div
						class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
						<i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ Request::routeIs('pasien.*') ? 'active' : '' }}"
					href="{{ route('pasien.index') }}">
					<div
						class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
						<i class="ni ni-badge text-success text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Pasien</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link {{ Request::routeIs('dokter.*') ? 'active' : '' }}"
					href="{{ route('dokter.index') }}">
					<div
						class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
						<i class="ni ni-circle-08 text-success text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Dokter</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ Request::routeIs('ruangan.*') ? 'active' : '' }}"
					href="{{ route('ruangan.index') }}">
					<div
						class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
						<i class="ni ni-building text-success text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Ruangan</span>
				</a>
			</li>
            <li class="nav-item">
				<a class="nav-link {{ Request::routeIs('jadwal.*') ? 'active' : '' }}"
					href="{{ route('jadwal.index') }}">
					<div
						class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
						<i class="ni ni-calendar-grid-58 text-success text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Jadwal</span>
				</a>
			</li>
			<li class="nav-item mt-3">
				<h6 class="text-uppercase font-weight-bolder opacity-6 ms-2 ps-4 text-xs">Account pages</h6>
			</li>
			<li class="nav-item">
				<a class="nav-link {{ Request::routeIs('profile_') ? 'active' : '' }}" href="{{ route('profile_') }}">
					<div
						class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
						<i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Profile</span>
				</a>
			</li>
			@if (session()->get('admin-account.role_id') == 1)
			<li class="nav-item">
				<a class="nav-link {{ Request::routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
					<div
						class="icon icon-shape icon-sm border-radius-md d-flex align-items-center justify-content-center me-2 text-center">
						<i class="fas fa-users text-dark text-sm opacity-10"></i>
					</div>
					<span class="nav-link-text ms-1">Users</span>
				</a>
			</li>
			@endif
		</ul>
	</div>
</aside>
