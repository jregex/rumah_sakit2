@extends('layouts.main-admin')
@section('datatables-css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endsection
@section('content-admin')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger alert-sm border-none text-white" role="alert">
                        @foreach ($errors->all() as $error)
                            <span class="alert-text">* {{ $error }}</span> <br>
                        @endforeach
                    </div>
                @endif
                <div class="card">
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

                        <div class="card-header pb-0 d-flex align-items-center">
                            <h6>List {{ $title }}</h6>
                            <button class="btn btn-success btn-sm ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addModal">Tambah</button>
                        </div>
                        <div class="card-body px-2 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0" id="tb-users">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($users as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ ucfirst($item->role->role) ?? 'Operator' }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <div class="overflow-hidden d-flex align-items-center"
                                                        style="max-width:100px;max-height:100px">
                                                        <img src="{{ $item->image == 'default.webp' ? asset('assets/admin/assets/img/icons/default.webp') : asset('storage/userprofile/' . $item->image) }}"
                                                            class="img-thumbnail rounded-circle" alt="profile image"
                                                            style="object-fit: cover;-o-object-fit:cover;width:100%">
                                                    </div>
                                                </td>
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
                                                                action="{{ route('users.delete', ['user' => $item->id]) }}"
                                                                method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="dropdown-item text-white" type="submit"><i
                                                                        class="fa fa-trash text-danger"></i>
                                                                    Delete</button>
                                                            </form>
                                                        </li>
                                                        <li><a class="dropdown-item text-white"
                                                                href="{{ route('users.edit', ['user' => $item->id]) }}"><i
                                                                    class="fa fa-edit text-warning"></i> Edit</a></li>
                                                        {{-- <li><a class="dropdown-item" href="#">Something else here</a> --}}
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
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
                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" id="addForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="addModalLabel">{{ $title }}</h5>

                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="text-white" for="username">Username</label>
                            <input type="text" class="form-control form-control-alternative" name="username"
                                id="username" placeholder="Input username">
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="email">Email</label>
                            <input type="email" class="form-control form-control-alternative" name="email"
                                id="email" placeholder="Input email">
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="name">Name</label>
                            <input type="text" class="form-control form-control-alternative" name="name"
                                id="name" placeholder="Input name">
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="role_id">Role</label>
                            <select class="form-control form-control-alternative" id="role_id" name="role_id" required>
                                <option selected>--pilih role--</option>
                                <option value="1">Administrator</option>
                                <option value="2">Operator</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-white" for="password">Password</label>
                            <input type="password" class="form-control form-control-alternative" name="password"
                                id="password" placeholder="Input password">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <img id="previewImg" alt="PreviewImg" height="300" width="300"
                                    class="img-thumbnail">
                            </div>
                            <div class="col-md-8">
                                <div class="custom-file mb-2">
                                    <input type="file" class="form-control form-control-alternative" name="image"
                                        id="image" placeholder="Input File">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="resetData" class="btn btn-dark text-white"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-light">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('datatables-js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/assets/js/custom-js/custom-plugins.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/custom-js/user-set.js') }}"></script>
@endsection
