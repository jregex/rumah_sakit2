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
                        <h5>{{ $title }}</h5>
                        <button id="btnEdit" class="btn btn-primary">Edit</button>
                    </div>
                    <div class="card-body px-2 pt-0 pb-2 p-4">
                       <form action="{{ route('posts.update',['post'=>$posts->id]) }}" class="px-4" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Input title" value="{{$posts->title}}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select name="category_id" id="category_id" class="form-control" disabled>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}" {{$posts->category_id==$item->id ? 'selected':''}}>{{$item->category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input type="text" class="form-control" name="price" id="price" placeholder="Input price" value="{{$posts->price}}" disabled>
                        </div>
                        <div class="form-group mb-4">
                            <label for="desc">Deskripsi</label>
                            <textarea name="desc" id="desc" class="form-control" rows="20" cols="10" disabled>{!! $posts->desc !!}</textarea>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <img id="previewImg" alt="PreviewImg" src="{{ asset('storage/posts') }}/{{$posts->image}}" height="200" width="600"
                                    class="img-thumbnail">
                            </div>
                            <div class="col-md-9">
                                <div class="custom-file mb-2">
                                    <input type="file" class="form-control form-control-alternative" name="image"
                                        id="image" placeholder="Input file" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success d-none" type="submit" id="btnS">Save</button>
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
    <script src="{{ asset('assets/admin/assets/js/custom-js/posts-set.js') }}"></script>
@endsection
