@extends('layouts.main-admin')

@section('content-admin')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Perusahaan</p>
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
                        <p class="text-uppercase text-sm">Informasi tentang perusahaan</p>
                        <div class="row">
                            <form method="post"
                                action="{{ route('settings.update', ['setting' => $settings->id]) }}" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama" class="form-control-label">Nama</label>
                                            <input class="form-control" id="nama" name="nama" type="text"
                                                disabled value="{{ $settings->nama }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-control-label">Email address</label>
                                            <input class="form-control" id="email" name="email" type="email"
                                                disabled value="{{ $settings->email }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3 d-flex justify-content-center">
                                        <img src="{{ $settings->profile == 'default.webp' ? asset('assets/admin/assets/img/icons/default.webp') : asset('storage/setting/' . $settings->profile) }}" width="150" height="150" class="img-fluid img-thumbnail" id="previewImg" alt="Profile Comp">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <input type="file" class="form-control" id="profile" placeholder="profile" name="profile" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lat" class="form-control-label">Lokasi Latitude</label>
                                            <input class="form-control" id="lat" name="lat" type="text"
                                                disabled value="{{ $settings->lat }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="long" class="form-control-label">Lokasi longitude</label>
                                            <input class="form-control" id="long" name="long" type="email"
                                                disabled value="{{ $settings->long }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="alamat" class="form-control-label">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="10" rows="5" class="form-control" disabled>{{$settings->alamat}}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label for="desc" class="form-control-label">Deskripsi</label>
                                            <textarea name="desc" id="desc" class="form-control">{{$settings->desc}}</textarea>
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
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/admin/assets/js/custom-js/custom-plugins.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/custom-js/profile-set.js') }}"></script>
    <script>
        CKEDITOR.replace('desc',{
            toolbar: [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
            { name: 'clipboard', groups: [ 'clipboard', 'undo' ]},
            { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
            { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
            { name: 'insert', items: [ 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
            '/',
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'others', items: [ '-' ] }
        ],
        });
    </script>
@endsection
