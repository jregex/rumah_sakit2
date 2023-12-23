@extends('layouts.main-admin')

@section('content-admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('jadwal.update', ['jadwal'=>$jadwals->id]) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="form-group">
						<label class="text-white" for="ruangan_id">Ruangan</label>
						<select class="form-control form-control-alternative" id="ruangan_id" name="ruangan_id"
							required>
							<option selected>--pilih ruangan--</option>
							@foreach($ruangans as $item)
							<option value="{{$item->id}}" {{$jadwals->ruangan->id==$item->id ? 'selected':''}}>{{$item->no_ruangan}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="text-white" for="dokter_id">Dokter</label>
						<select class="form-control form-control-alternative" id="dokter_id" name="dokter_id" required>
							<option selected>--pilih dokter--</option>
							@foreach($dokters as $item)
							<option value="{{$item->id}}" {{$jadwals->dokter->id==$item->id ? 'selected':''}}>{{$item->nama_dokter}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="text-white" for="pasien_id">Pasien</label>
						<select class="form-control form-control-alternative" id="pasien_id" name="pasien_id" required>
							<option selected>--pilih pasien--</option>
							@foreach($pasiens as $item)
							<option value="{{$item->id}}" {{$jadwals->pasien->id==$item->id ? 'selected':''}}>{{$item->nama_pasien}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label class="text-white" for="tgl">Tanggal</label>
						<input type="date" class="form-control form-control-alternative" id="tgl" name="tgl"
							placeholder="Input tanggal" value="{{date('Y-m-d',strtotime($jadwals->tgl))}}">
					</div>
                    <div class="form-group">
                        <label class="text-white" for="jam_mulai">Jam mulai</label>
                        <input type="time" class="form-control form-control-alternative" id="jam_mulai" name="jam_mulai"
							placeholder="Input jam mulai" value="{{$jadwals->jam_mulai}}">
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="jam_selesai">Jam selesai</label>
                        <input type="time" class="form-control form-control-alternative" id="jam_selesai" name="jam_selesai"
							placeholder="Input jam selesai" value="{{$jadwals->jam_selesai}}">
                    </div>
                    <div class="form-group float-end">
                        <a href="{{ route('jadwal.index') }}" class="btn btn-danger">back</a>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('datatables-js')
<script src="{{ asset('assets/admin/assets/js/custom-js/custom-plugins.js') }}"></script>
@endsection
