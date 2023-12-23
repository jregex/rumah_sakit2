@extends('layouts.main-admin')

@section('content-admin')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h5>{{ $title }}</h5>
			</div>
			<div class="card-body">
				<form action="{{ route('ruangan.update', ['ruangan'=>$ruangans->id]) }}" method="POST">
					@method('patch')
					@csrf
					<div class="form-group">
						<label class="text-white" for="no_ruangan">No ruangan</label>
						<input type="text" class="form-control form-control-alternative" name="no_ruangan"
							id="no_ruangan" placeholder="Input no ruangan" value="{{$ruangans->no_ruangan}}">
					</div>
					<div class="form-group">
						<label class="text-white" for="tipe_ruangan">Tipe ruangan</label>
						<input type="text" class="form-control form-control-alternative" name="tipe_ruangan"
							id="tipe_ruangan" placeholder="Input tipe ruangan" value="{{$ruangans->tipe_ruangan}}">
					</div>
					<div class="form-group">
						<label class="text-white" for="ketersediaan">Ketersediaan</label>
						<select class="form-control form-control-alternative" id="ketersediaan" name="ketersediaan"
							required>
							<option selected>--pilih ketersediaan--</option>
							<option value="1" {{$ruangans->ketersediaan=='1' ? 'selected':''}}>Terisi</option>
							<option value="0" {{$ruangans->ketersediaan=='0' ? 'selected':''}}>Kosong</option>
						</select>
					</div>

					<div class="form-group float-end">
						<a href="{{ route('ruangan.index') }}" class="btn btn-danger">back</a>
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
