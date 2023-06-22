<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = [
            'title'=>'List Pegawai',
            'var'=>'pegawai',
            'pegawais'=>Pegawai::with('jabatan')->get(),
            'jabatans'=>Jabatan::get()
        ];
        return view('admin.pegawai.index',$data);
    }

    public function show($id)
    {
        $pegawai = Pegawai::with('jabatan')->where('id',$id)->first();
        $data = [
            'title'=>'Detail Pegawai',
            'var'=>'pegawai',
            'pegawai'=>$pegawai,
            'jabatans'=>Jabatan::get()
        ];
        return view('admin.pegawai.detail',$data);
    }


    public function destroy(Pegawai $pegawai)
    {
        $delete = $pegawai->delete();
        if ($delete) {
            return redirect()->route('pegawai.index')->with('success', 'Data was deleted');
        } else {
            return redirect()->route('pegawai.index')->with('failed', 'Data failed to delete');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'nip'=>'required|unique:pegawais,nip',
            'golongan'=>'required',
            'pendidikan'=>'required',
            'tgl_lahir'=>'required'
        ]);
        $file=$request->file('profil');
        if($file){
            if (!Storage::exists('/public/profile')) {
                Storage::makeDirectory('public/profile', 0775, true);
            }
            $namaGambar =  date('d-m-s', strtotime(now())) . '.'.$file->getClientOriginalExtension();
            $img = Image::make($file->path());
            $img->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(Storage::path('public/profile/' . $namaGambar));
        }else{
            $namaGambar="default.webp";
        }

        $save = Pegawai::create([
            'nip'=>$request->nip,
            'nama'=>$request->nama,
            'golongan'=>$request->golongan,
            'tmt'=>date('y-m-d',strtotime($request->tmt)),
            'jabatan_id'=>$request->jabatan_id,
            'masa_kerja'=>date('y-m-d',strtotime($request->masa_kerja)),
            'nama_pelatihan'=>$request->nama_pelatihan,
            'lulus_pelatihan'=>$request->lulus_pelatihan,
            'lama_kerja'=>$request->lama_kerja,
            'pendidikan'=>$request->pendidikan,
            'thn_lulus'=>$request->thn_lulus,
            'tgl_lahir'=>date('y-m-d',strtotime($request->tgl_lahir)),
            'gambar'=>$namaGambar
        ]);
        if ($save) {
            return redirect()->route('pegawai.index')->with('success', 'Data was added');
        } else {
            return redirect()->route('pegawai.index')->with('failed', 'Data failed to added');
        }

    }

    public function update(Request $request,Pegawai $pegawai)
    {
        $request->validate([
            'nama'=>'required',
            'nip'=>'required|unique:pegawais,nip',
            'golongan'=>'required',
            'pendidikan'=>'required',
            'tgl_lahir'=>'required'
        ]);
        $file=$request->file('profil');
        if($file){
            if (!Storage::exists('/public/profile')) {
                Storage::makeDirectory('public/profile', 0775, true);
            }
            $namaGambar =  date('d-m-s', strtotime(now())) . '.'.$file->getClientOriginalExtension();
            $img = Image::make($file->path());
            $img->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(Storage::path('public/profile/' . $namaGambar));
        }else{
            $namaGambar=$pegawai->gambar;
        }

        $update = Pegawai::where('id',$pegawai->id)->update([
            'nip'=>$request->nip,
            'nama'=>$request->nama,
            'golongan'=>$request->golongan,
            'tmt'=>date('y-m-d',strtotime($request->tmt)),
            'jabatan_id'=>$request->jabatan_id,
            'masa_kerja'=>date('y-m-d',strtotime($request->masa_kerja)),
            'nama_pelatihan'=>$request->nama_pelatihan,
            'lulus_pelatihan'=>$request->lulus_pelatihan,
            'lama_kerja'=>$request->lama_kerja,
            'pendidikan'=>$request->pendidikan,
            'thn_lulus'=>$request->thn_lulus,
            'tgl_lahir'=>date('y-m-d',strtotime($request->tgl_lahir)),
            'gambar'=>$namaGambar
        ]);
        if ($update) {
            return redirect()->route('pegawai.details',['id'=>$pegawai->id])->with('success', 'Data was updated');
        } else {
            return redirect()->route('pegawai.details',['id'=>$pegawai->id])->with('failed', 'Data failed to update');
        }

    }

    public function jabatan_list()
    {
        $data = [
            'title' => 'List Jabatan',
            'var' => 'jabatan',
            'jabatans' => Jabatan::all()
        ];
        return view('admin.pegawai.jabatans', $data);
    }
    public function jabatan_save(Request $request)
    {
        $request->validate([
            'jabatan' => 'required'
        ]);
        $save = Jabatan::create([
            'jabatan' => $request->jabatan
        ]);
        if ($save) {
            return redirect()->route('jabatan.index')->with('success', 'Data was added');
        } else {
            return redirect()->route('jabatan.index')->with('failed', 'Data failed to added');
        }
    }
    public function jabatan_update(Request $request)
    {
        $request->validate([
            'jabatan' => 'required'
        ]);
        $id=$request->jabatan_id;
        $update = Jabatan::where('id',$id)->update([
            'jabatan' => $request->jabatan
        ]);
        if ($update) {
            return redirect()->route('jabatan.index')->with('success', 'Data was update');
        } else {
            return redirect()->route('jabatan.index')->with('failed', 'Data failed to update');
        }
    }
    public function jabatan_delete(Jabatan $jabatan)
    {
        $delete = $jabatan->delete();
        if ($delete) {
            return redirect()->route('jabatan.index')->with('success', 'Data was deleted');
        } else {
            return redirect()->route('jabatan.index')->with('failed', 'Data failed to delete');
        }
    }
    public function editJabatan($id)
    {
        $jabatans = Jabatan::where('id',$id)->first();
        return response()->json(['message'=>'success','data'=>$jabatans]);
    }

    public function pegawai_api()
    {
        $pegawais = Pegawai::with('jabatan')->get();
        return response()->json(['data'=>$pegawais]);
    }
}
