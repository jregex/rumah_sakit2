@extends('layouts.main-admin')

@section('content-admin')
<div class="container-fluid py-4">
	<div class="row">
		<div class="col-md-4 mb-4">
			<div class="card card-profile">
				<img src="{{ asset('assets/admin') }}/assets/img/carousel-3.jpg" alt="Image placeholder"
					class="card-img-top">
				<div class="row justify-content-center">
					<div class="col-4 col-lg-4 order-lg-2">
						<div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0 overflow-hidden h-80">
							<a href="javascript:;">
								<img src="{{ $users->image == 'default.webp' ? asset('assets/admin/assets/img/icons/default.webp') : asset('storage/userprofile/' . $users->image) }}"
									class="rounded-circle img-thumbnail border border-2 border-white"
									style="object-fit: cover;width:100%;height:auto">
							</a>
						</div>
					</div>
				</div>
				<div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
					<div class="d-flex justify-content-center text-center">
						<p class="text-lg fw-bold">{{ $users->role->role }}</p>
					</div>
				</div>
				<div class="card-body pt-0">
					<div class="mt-2">
						<div class="h6 text-center font-weight-300">
							<ul class="list-group">
								<li class="list-group-item">{{ $users->name }}</li>
								<li class="list-group-item">{{ $users->email }}</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header pb-0">
					<div class="d-flex align-items-center">
						<p class="mb-0">Edit Profile</p>
						<button class="btn btn-primary btn-sm ms-auto" id="btnEdit">Edit</button>
					</div>
				</div>
				<div class="card-body">
					@if (session()->has('success'))
					<div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
						<span class="text-white">{{ session()->get('success') }}</span>
						<button type="button" class="btn-close text-white" data-bs-dismiss="alert"
							aria-label="Close">X</button>
					</div>
					@elseif(session()->has('failed'))
					<div class="alert alert-danger mt-2 alert-dismissible fade show" role="alert">
						<span class="text-white">{{ session()->get('failed') }}</span>
						<button type="button" class="btn-close text-white" data-bs-dismiss="alert"
							aria-label="Close">X</button>
					</div>
					@endif
					<p class="text-uppercase text-sm">User Information</p>
					<div class="row">
						<form method="post"
							action="{{ route('profile.update', ['user' => session()->get('admin-account.id')]) }}">
							@method('patch')
							@csrf
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="username" class="form-control-label">Username</label>
										<input class="form-control" id="username" name="username" type="text" disabled
											value="{{ $users->username }}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="email" class="form-control-label">Email address</label>
										<input class="form-control" id="email" name="email" type="email" disabled
											value="{{ $users->email }}">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name" class="form-control-label">Name</label>
										<input class="form-control" id="name" name="name" disabled type="text"
											value="{{ $users->name }}">
									</div>
								</div>
							</div>
							<div class="form-group">
								<button class="btn btn-success d-none" id="btnS" type="submit">Save</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>

	</div>
</div>
@endsection

@section('datatables-js')
{{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script> --}}
<script src="{{ asset('assets/admin/assets/js/custom-js/user-set.js') }}"></script>
@endsection
