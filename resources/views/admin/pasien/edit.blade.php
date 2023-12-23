@extends('layouts.main-admin')

@section('content-admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ $title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pasien.update', ['pasien'=>$pasiens->id]) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label class="text-white" for="nama_pasien">Nama pasien</label>
                        <input type="text" class="form-control form-control-alternative" name="nama_pasien"
                            id="nama_pasien" placeholder="Input nama pasien" value="{{$pasiens->nama_pasien}}">
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="tgllahir">Tanggal lahir</label>
                        <input type="date" class="form-control form-control-alternative" name="tgllahir" id="tgllahir"
                            placeholder="Input tgl lahir" value="{{$pasiens->tgllahir}}">
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="name">Alamat</label>
                        <textarea name="alamat" id="alamat" cols="5" rows="5"
                            class="form-control form-control-alternative"
                            placeholder="Input alamat">{{$pasiens->alamat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="text-white" for="kontak">Kontak</label>
                        <input type="text" class="form-control form-control-alternative" name="kontak" id="kontak"
                            placeholder="Input kontak" value="{{$pasiens->kontak}}">
                    </div>
                    <div class="form-group float-end">
                        <a href="{{ route('pasien.index') }}" class="btn btn-danger">back</a>
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
