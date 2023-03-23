    @extends('layouts.main-admin')

    @section('content-admin')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="#">

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control form-control-alternative"
                                    id="username" value="{{ $users->username }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control form-control-alternative"
                                    id="email" value="{{ $users->email }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control form-control-alternative"
                                    id="name" value="{{ $users->name }}">
                            </div>
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select name="role_id" id="role_id" class="form-control form-control-alternative">
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $users->role_id ? 'selected' : '' }}>
                                            {{ ucfirst($item->role) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-4 mb-2">
                                    <img id="previewImg"
                                        src="{{ $users->image == 'default.webp' ? asset('assets/admin/assets/img/icons/default.webp') : asset('storage/userprofile/' . $users->image) }}"
                                        alt="PreviewImg" height="200" width="200" class="img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <div class="custom-file mb-2">
                                        <input type="file" class="form-control form-control-alternative" name="image"
                                            id="image" placeholder="Input File">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-end">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-success ms-2" id="update">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('datatables-js')
        <script src="{{ asset('assets/admin/assets/js/custom-js/custom-plugins.js') }}"></script>
        <script>
            let fileupload = document.querySelector('#image');
            fileupload.onchange = function() {
                uplaodImg(this);
            };

            function uplaodImg(image) {
                let reader = new FileReader();
                let name = image.value;
                name = name.substring(name.lastIndexOf('\\') + 1);
                reader.onload = (e) => {
                    // debugger;
                    let preview = document.querySelector('#previewImg');
                    preview.setAttribute('src', e.target.result);
                    hide(preview);
                    fadeIn2(preview, 700);
                }
                reader.readAsDataURL(image.files[0]);
            }
        </script>
    @endsection
