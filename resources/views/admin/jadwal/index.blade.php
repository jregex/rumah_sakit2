@extends('layouts.main-admin')
@section('datatables-css')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endsection
@section('content-admin')
<div class="container-fluid py-4">
	<div class="row">
		<div class="col-md-12">
			@if (count($errors) > 0)
			<div class="alert alert-danger alert-sm border-none text-white" role="alert">
				@foreach ($errors->all() as $error)
				<span class="alert-text">* {{ $error }}</span> <br>
				@endforeach
			</div>
			@endif
			<div class="card">
				<div class="card mb-2">
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

					<div class="card-header pb-0 d-flex align-items-center">
						<h6>List {{ $title }}</h6>
                        <div class="ms-auto">
                            <a href="{{ route('jadwal.pdf') }}" class="btn btn-dark btn-sm">Cetak</a>
						<button class="btn btn-success btn-sm" data-bs-toggle="modal"
							data-bs-target="#addModal">Tambah</button>
                        </div>
					</div>
					<div class="card-body px-2 pt-0 pb-2">
						<div class="table-responsive p-0">
							<table class="table align-items-center justify-content-center mb-0" id="tb-jadwal">
								<thead class="text-center">
									<tr>
										<th>No</th>
										<th>Ruangan</th>
										<th>Dokter</th>
										<th>Pasien</th>
										<th>Tanggal</th>
										<th>Jam mulai</th>
										<th>Jam selesai</th>
										<th>#</th>
									</tr>
								</thead>
								<tbody class="text-center p-4">
									@foreach ($jadwals as $item)
									<tr>
										<td>{{ $loop->iteration }}</td>
										<td>{{ $item->ruangan->no_ruangan }}</td>
										<td>{{ $item->dokter->nama_dokter }}</td>
										<td>{{ $item->pasien->nama_pasien }}</td>
										<td>{{ date('d/m/Y',strtotime($item->tgl)) }}</td>
										<td>{{ date('H:i',strtotime($item->jam_mulai)) }}</td>
										<td>{{ date('H:i',strtotime($item->jam_selesai)) }}</td>
										<td class="align-middle">
											<button
												class="btn btn-link text-secondary mb-0 rounded-circle bg-light text-dark"
												id="dropdownMenuButton1" data-bs-toggle="dropdown"
												aria-expanded="false">
												<i class="fa fa-ellipsis-v text-md"></i>
											</button>
											<ul class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton1">
												<li>
													<form
														action="{{ route('jadwal.destroy', ['jadwal' => $item->id]) }}"
														method="post">
														@method('delete')
														@csrf
														<button class="dropdown-item text-white" type="submit"><i
																class="fa fa-trash text-danger"></i>
															Delete</button>
													</form>
												</li>
												<li><a class="dropdown-item text-white"
														href="{{ route('jadwal.edit', ['jadwal' => $item->id]) }}"><i
															class="fa fa-edit text-warning"></i> Edit</a>
												</li>
                                                <li><a class="dropdown-item text-white"
                                                    href="{{ route('jadwal.detail', ['jadwal' => $item->id]) }}"><i
                                                        class="fas fa-file-pdf text-success"></i>  Cetak</a>
                                            </li>
											</ul>
										</td>
									</tr>
									@endforeach

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
	aria-labelledby="addModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content bg-gradient-success">
			<form action="{{ route('jadwal.store') }}" method="post" id="addForm">
				@csrf
				<div class="modal-header">
					<h5 class="modal-title text-white" id="addModalLabel">{{ $title }}</h5>

				</div>
				<div class="modal-body">

					<div class="form-group">
						<label class="text-white" for="ruangan_id">Ruangan</label>
						<select class="form-control form-control-alternative" id="ruangan_id" name="ruangan_id"
							required>
							<option selected>--pilih ruangan--</option>
							@foreach($ruangans as $item)
							<option value="{{$item->id}}">{{$item->no_ruangan}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="text-white" for="dokter_id">Dokter</label>
						<select class="form-control form-control-alternative" id="dokter_id" name="dokter_id" required>
							<option selected>--pilih dokter--</option>
							@foreach($dokters as $item)
							<option value="{{$item->id}}">{{$item->nama_dokter}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="text-white" for="pasien_id">Pasien</label>
						<select class="form-control form-control-alternative" id="pasien_id" name="pasien_id" required>
							<option selected>--pilih pasien--</option>
							@foreach($pasiens as $item)
							<option value="{{$item->id}}">{{$item->nama_pasien}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="text-white" for="tgl">Tanggal</label>
						<input type="date" class="form-control form-control-alternative" id="tgl" name="tgl"
							placeholder="Input tanggal">
					</div>
                    <div class="form-group">
                        <label class="text-white" for="jam_mulai">Jam mulai</label>
                        <input type="time" class="form-control form-control-alternative" id="jam_mulai" name="jam_mulai"
							placeholder="Input jam mulai">
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="jam_selesai">Jam selesai</label>
                        <input type="time" class="form-control form-control-alternative" id="jam_selesai" name="jam_selesai"
							placeholder="Input jam selesai">
                    </div>

				</div>
				<div class="modal-footer">
					<button type="button" id="resetData" class="btn btn-dark text-white"
						data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-light">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('datatables-js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('assets/admin/assets/js/custom-js/custom-plugins.js') }}"></script>
<script src="{{ asset('assets/admin/assets/js/custom-js/jadwal-set.js') }}"></script>
@endsection
