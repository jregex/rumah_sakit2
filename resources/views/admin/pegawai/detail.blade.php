@extends('layouts.main-admin')

@section('content-admin')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card card-profile">
                    <div class="p-3">
                        <img class="w-100 border-radius-md h-70" src="{{ asset('storage/profile') }}/{{$pegawai->gambar}}">
                    </div>
                    <div class="card-body pt-0 border-radius-md blur">
                        <div class="text-center mt-2">
                            <h5>
                                {{ $pegawai->nama }}
                            </h5>
                            <div class="h6 font-weight-300">
                                {{ $pegawai->nip }}
                            </div>
                            <h5 class="fw-bold text-primary">
                                {{$pegawai->jabatan->jabatan}}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <p class="mb-0">{{$title}}</p>
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
                        <div class="row">
                            <form method="post"
                                action="{{ route('pegawai.update', ['pegawai' => $pegawai->id]) }}">
                                @method('patch')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nip" class="form-control-label">NIP</label>
                                            <input class="form-control" id="nip" name="nip" type="text"
                                             value="{{ $pegawai->nip }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama" class="form-control-label">Nama</label>
                                            <input class="form-control" id="email" name="email" type="text"
                                             value="{{ $pegawai->nama }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="golongan" class="form-control-label">Golongan</label>
                                            <input class="form-control" id="golongan" name="golongan"
                                                type="text" value="{{ $pegawai->golongan }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tmt" >Tamat</label>
                                            <input type="date" class="form-control" name="tmt" id="tmt" value="{{$pegawai->tmt}}" placeholder="Masukkan Tamat">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label  for="jabatan">Jabatan</label>
                                            <select name="jabatan_id" id="jabatan" class="form-control" required>
                                                <option selected>--pilih jabatan--</option>
                                                @foreach ($jabatans as $item)
                                                    <option value="{{$item->id}}" {{$item->id==$pegawai->jabatan_id ? 'selected':''}}>{{$item->jabatan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="masa_kerja">Masa kerja</label>
                                            <input type="date" class="form-control" name="masa_kerja" id="masa_kerja" value="{{$pegawai->masa_kerja}}" placeholder="Masukkan masa kerja">
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $years=range(date('Y'),1950);
                                @endphp
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_pelatihan">Nama Pelatihan</label>
                                            <input type="text" class="form-control" name="nama_pelatihan" id="nama_pelatihan" value="{{$pegawai->nama_pelatihan}}" placeholder="Masukkan nama pelatihan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lulus_pelatihan">Lulus Pelatihan</label>
                                            <select name="lulus_pelatihan" id="lulus_pelatihan" class="form-control" required>
                                                <option selected>--pilih tahun--</option>
                                                @foreach ($years as $item)
                                                    <option value="{{$item}}" {{$item==$pegawai->lulus_pelatihan ? 'selected':''}}>{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lama_kerja">Lama Kerja</label>
                                            <input type="text" class="form-control" name="lama_kerja" id="lama_kerja" value="{{$pegawai->lama_kerja}}" placeholder="Masukkan lama kerja">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pendidikan">Pendidikan</label>
                                            <input type="text" class="form-control" name="pendidikan" value="{{$pegawai->pendidikan}}" id="pendidikan" placeholder="Masukkan pendidikan">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="thn_lulus">Tahun lulus</label>
                                            <select name="thn_lulus" id="thn_lulus" class="form-control" required>
                                                <option selected>--pilih tahun--</option>
                                                @foreach ($years as $item)
                                                    <option value="{{$item}}" {{$item==$pegawai->thn_lulus ? 'selected':''}}>{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tgl_lahir">Tanggal lahir</label>
                                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="{{$pegawai->tgl_lahir}}" min="1940-01-01" max="2030-12-30" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/profile') }}/{{$pegawai->gambar}}" id="previewImg" class="img-fluid bg-light mb-2" alt="profil">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                                <div class="custom-file mb-2">
                                                    <input type="file" class="form-control" id="profil" name="profil">
                                                    <label class="custom-file-label text-white" for="profil">Select Profile</label>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group float-right">
                                    <a href="{{ route('pegawai.index') }}" class="btn btn-danger">Back</a>
                                    <button class="btn btn-success" type="submit">update</button>
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
<script src="{{ asset('assets/admin/assets/js/custom-script/custom-plugins') }}"></script>
<script>
    let profile=document.querySelector('#profil');
    profile.onchange=function() {
        getURL(this);
    }

    function getURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            let filename = profile.value;
            filename = filename.substring(filename.lastIndexOf('\\') + 1);
            reader.onload = function(e) {
                // debugger;
                let previewImg=document.querySelector('#previewImg');
                // $('#previewImg').attr('src', e.target.result);
                previewImg.src=e.target.result;
                hide(previewImg);
                // $('#previewImg').fadeIn(500);
                // $('.custom-file-label').text(filename);
                fadeIn2(previewImg,500);
                let label=document.querySelector('.custom-file-label').innerText=filename;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
