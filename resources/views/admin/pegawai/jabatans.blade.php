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
                        <button data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-success">Add
                            Jabatan</button>
                    </div>
                    <div class="card-body px-2 pt-0 pb-2">
                        <div class="table-responsive pb-0">
                            {{-- <div class="px-2">
                                <input class="search form-control" placeholder="Search" />
                            </div> --}}
                            <table class="table table-striped" border="1" id="table-jabatan">
                                <thead class="text-center">
                                    <th>No</th>
                                    <th>Jabatan</th>
                                    <th>#</th>
                                </thead>
                                <tbody>
                                    @forelse ($jabatans as $item)
                                        <tr class="text-center">
                                            <td class="number">{{ $loop->iteration }}</td>
                                            <td class="jabatan">{{ $item->jabatan }}</td>
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
                                                            action="{{ route('jabatan.delete', ['jabatan' => $item->id]) }}"
                                                            method="post">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="dropdown-item text-white" type="submit"><i
                                                                    class="fa fa-trash text-danger"></i>
                                                                Delete</button>
                                                        </form>
                                                    </li>
                                                    <li><button class="dropdown-item text-white open-modal" value="{{$item->id}}"><i
                                                                class="fa fa-edit text-warning"></i> Edit</a></li>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="3">Empty Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button
                            onclick="x.DownloadCSV()"
                            class="mt-2 ms-3 border-0 btn btn-success shadow-none"
                        >
                            Download CSV
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-gradient-primary">
                <form action="{{ route('jabatan.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="addModalLabel">{{ $title }}</h5>

                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="text-white" for="jabatan">Jabatan</label>
                            <input type="text" class="form-control form-control-alternative" name="jabatan"
                                id="jabatan" placeholder="Input jabatan">
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
    <!-- Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-gradient-primary">
                <form action="{{ route('jabatan.update') }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="editModalLabel">Edit Jabatan</h5>

                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="text-white" for="jabatan">Jabatan</label>
                            <input type="text" class="form-control form-control-alternative" name="jabatan"
                                id="jabatan-edit" placeholder="Input jabatan">
                            <input type="hidden" id="jabatan-id" name="jabatan_id">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="reset" id="resetData" class="btn btn-dark text-white"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-light" id="btn-save">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('datatables-js')
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script> --}}
{{-- <script src="{{ asset('assets/admin/assets/js/plugins/rdata/index.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/gh/Rakhmadi/RdataTB@master/dist/index.js"></script>
<script>
    // let options = {
    //     valueNames: [ 'number', 'jabatan' ],
    // };

    // const jabatanList = new List('table-jabatan', options);
    let x = new RdataTB('table-jabatan',{
		//RenderJSON:[], // Convert Json to Table html
		ShowSearch:true, // show search field,
		ShowSelect:true, // show show select,
		ShowPaginate:true, // show paginate ,
		SelectionNumber:[5,10,20,50,100], //Change Option in Select
		ShowHighlight:false, // show Highlight if search
	    fixedTable:true, // fixed table
        sortAnimate:false, // show animated if sorted
		ShowTfoot:false,
		ExcludeColumnExport:["#"]
	});

    //edit modal trigger
    let tombolEdit = document.querySelectorAll('.open-modal');
    for(let i = 0; i < tombolEdit.length; i++) {
        tombolEdit[i].addEventListener('click',function(){
            let modal = new bootstrap.Modal('#editModal');
            const url = "/api/api-edit-jabatan";
            const tour_id= this.value;
            fetch(`${url}/${tour_id}`).then(res=>res.json()).then(res=>{
                modal.show();
                document.querySelector('#jabatan-edit').value=res.data.jabatan;
                document.querySelector('#jabatan-id').value=res.data.id;
            });
            // $.get(url + '/' + tour_id, function (data) {
            //     //success data
            //     console.log(data);
            //     $('#tour_id').val(data.id);
            //     $('#name').val(data.name);
            //     $('#details').val(data.details);
            //     $('#btn-save').val("update");
            // })
        });
    }

</script>
@endsection
