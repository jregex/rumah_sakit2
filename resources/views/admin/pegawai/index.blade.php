@extends('layouts.main-admin')


@section('content-admin')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                @if (session()->get('errors'))
                    <div class="alert alert-danger fade show text-white" role="alert">
                        @foreach ($errors->all() as $error)
                            <span class="alert-text">* {{ $error }}</span> <br>
                        @endforeach
                    </div>
                @endif
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
                    <div class="card-header d-flex justify-content-between">
                        <h5>{{$title}}</h5>
                        <button data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success">Add
                            Pegawai</button>
                    </div>
                    <div class="card-body px-2 pt-0 pb-2" id="table-pegawai">
                        <div class="table-responsive pb-0" >
                            <div class="px-2">
                                <input class="search form-control" placeholder="Search" />
                            </div>

                            <table class="table table-striped">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>#</th>
                                </thead>
                                <tbody class="list">
                                    @forelse ($pegawais as $item)
                                        <tr>
                                            <td class="number">{{$loop->iteration}}</td>
                                            <td class="nama"><a href="{{ route('pegawai.details', ['id'=>$item->id]) }}" class="btn btn-link text-primary">{{$item->nama}} </a></td>
                                            <td class="jabatan">{{$item->jabatan->jabatan}}</td>
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
                                                            action="{{ route('pegawai.delete', ['pegawai' => $item->id]) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="dropdown-item text-white" type="submit"><i
                                                                    class="fa fa-trash text-danger"></i>
                                                                Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="4">Empty Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

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
            <div class="modal-content bg-gradient-primary">
                <form action="{{ route('pegawai.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="addModalLabel">Add Pegawai</h5>

                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nip" class="text-white">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukkan NIP">
                        </div>
                        <div class="form-group">
                            <label for="nama" class="text-white">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama">
                        </div>
                        <div class="form-group">
                            <label for="golongan" class="text-white">Golongan</label>
                            <input type="text" class="form-control" name="golongan" id="golongan" placeholder="Masukkan golongan">
                        </div>
                        <div class="form-group">
                            <label for="tmt" class="text-white">Tamat</label>
                            <input type="date" class="form-control" name="tmt" id="tmt" placeholder="Masukkan Tamat">
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="jabatan">Jabatan</label>
                            <select name="jabatan_id" id="jabatan" class="form-control" required>
                                <option selected>--pilih jabatan--</option>
                                @foreach ($jabatans as $item)
                                    <option value="{{$item->id}}">{{$item->jabatan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="masa_kerja" class="text-white">Masa kerja</label>
                            <input type="date" class="form-control" name="masa_kerja" id="masa_kerja" placeholder="Masukkan masa kerja">
                        </div>
                        <div class="form-group">
                            <label for="nama_pelatihan" class="text-white">Nama Pelatihan</label>
                            <input type="text" class="form-control" name="nama_pelatihan" id="nama_pelatihan" placeholder="Masukkan nama pelatihan">
                        </div>
                        @php
                            $years=range(date('Y'),1950);
                        @endphp
                        <div class="form-group">
                            <label for="lulus_pelatihan" class="text-white">Lulus Pelatihan</label>
                            <select name="lulus_pelatihan" id="lulus_pelatihan" class="form-control" required>
                                <option selected>--pilih tahun--</option>
                                @foreach ($years as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lama_kerja" class="text-white">Lama Kerja</label>
                            <input type="text" class="form-control" name="lama_kerja" id="lama_kerja" placeholder="Masukkan lama kerja">
                        </div>
                        <div class="form-group">
                            <label for="pendidikan" class="text-white">Pendidikan</label>
                            <input type="text" class="form-control" name="pendidikan" id="pendidikan" placeholder="Masukkan pendidikan">
                        </div>
                        <div class="form-group">
                            <label for="thn_lulus" class="text-white">Tahun lulus</label>
                            <select name="thn_lulus" id="thn_lulus" class="form-control" required>
                                <option selected>--pilih tahun--</option>
                                @foreach ($years as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir" class="text-white">Tanggal lahir</label>
                            <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" min="1940-01-01" max="2030-12-30" placeholder="dd-mm-yyyy">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('assets/admin/assets/img/icons/default.webp') }}" id="previewImg" class="img-fluid bg-white mb-2" alt="profil">
                                </div>
                                <div class="col-md-9 custom-file mb-2">
                                    <input type="file" class="form-control" id="profil" name="profil">
                                    <label class="custom-file-label text-white" for="profil">Select Profile</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" id="resetData" class="btn btn-dark text-white"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('datatables-js')
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
<script src="{{ asset('assets/admin/assets/js/custom-script/custom-plugins') }}"></script>
<script>

    let options = {
        valueNames: [ 'number', 'nama','jabatan' ],
    };

    const userList = new List('table-pegawai', options);

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
