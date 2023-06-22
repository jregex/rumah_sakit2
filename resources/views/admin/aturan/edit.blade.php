@extends('layouts.main-admin')

@section('content-admin')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('aturan.update', ['aturan'=>$aturans->id]) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="aturan">Aturan</label>
                            <input type="text" name="aturan" class="form-control form-control-alternative"
                                id="aturan" value="{{ $aturans->aturan }}">
                        </div>
                        <div class="form-group">
                            <label for="jenis_id">Jenis Aturan</label>
                            <select name="jenis_id" id="jenis_id" class="form-control form-control-alternative">
                                @foreach ($jenis_aturan as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $aturans->category_aturan_id ? 'selected' : '' }}>
                                        {{ $item->jenis_aturan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file_aturan_new">File Aturan</label>
                            <input type="file" class="form-control form-control-alternative mb-3" id="file_aturan_new" name="file_aturan_new" value="{{$aturans->file_aturan}}">
                            <input type="text" name="file_aturan" class="form-control form-control-alternative" value="{{$aturans->file_aturan}}" disabled>
                        </div>

                        <div class="form-group d-flex justify-content-end">
                            <a href="{{ route('aturan.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-success ms-2">update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
