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
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-body px-2 pt-0 pb-2 p-4">
                       <form action="{{ route('posts.store') }}" class="px-4" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Input title">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option selected>--Pilih kategori--</option>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sumber">Sumber</label>
                            <input type="text" class="form-control" name="sumber" id="sumber" placeholder="Input sumber">
                        </div>
                        <div class="form-group mb-4">
                            <label for="body">Body</label>
                            <textarea name="body" id="body" class="form-control"></textarea>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <img id="previewImg" alt="PreviewImg" height="300" width="300"
                                    class="img-thumbnail">
                            </div>
                            <div class="col-md-9">
                                <div class="custom-file mb-2">
                                    <input type="file" class="form-control form-control-alternative" name="image"
                                        id="image" placeholder="Input file">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Save</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-danger">Batal</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('datatables-js')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/admin/assets/js/custom-js/custom-plugins.js') }}"></script>
    <script>
        CKEDITOR.replace('body',{
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

        let fileupload = document.querySelector('#image');
        fileupload.onchange=function(){
            uplaodImg(this);
        };
        function uplaodImg(image){
            let reader = new FileReader();
            let name = image.value;
            name = name.substring(name.lastIndexOf('\\')+1);
            reader.onload = (e)=>{
                // debugger;
                let preview = document.querySelector('#previewImg');
                preview.setAttribute('src',e.target.result);
                hide(preview);
                fadeIn2(preview,700);
            }
            reader.readAsDataURL(image.files[0]);
        }

    </script>

@endsection
