@extends('layouts.main-admin')

@section('content-admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dokter.update', ['dokter'=>$dokters->id]) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label class="text-white" for="nama_dokter">Nama dokter</label>
                        <input type="text" class="form-control form-control-alternative" name="nama_dokter"
                            id="nama_dokter" placeholder="Input nama dokter" value="{{$dokters->nama_dokter}}">
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="spesialis">Spesialis</label>
                        <select class="form-control form-control-alternative" id="spesialis" name="spesialis" required>
                            <option selected>--pilih role--</option>
                            <option value="gigi" {{$dokters->spesialis=='gigi' ? 'selected':''}}>Gigi</option>
                            <option value="kulit" {{$dokters->spesialis=='kulit' ? 'selected':''}}>Kulit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="kontak">Kontak</label>
                        <input type="text" class="form-control form-control-alternative" name="kontak" id="kontak"
                            placeholder="Input kontak" value="{{$dokters->kontak}}">
                    </div>
                    <div class="form-group float-end">
                        <a href="{{ route('dokter.index') }}" class="btn btn-danger">back</a>
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
