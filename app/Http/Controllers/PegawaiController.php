<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;

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
    public function jabatan_delete(Jabatan $jabatan)
    {
        $delete = $jabatan->delete();
        if ($delete) {
            return redirect()->route('jabatan.index')->with('success', 'Data was deleted');
        } else {
            return redirect()->route('jabatan.index')->with('failed', 'Data failed to delete');
        }
    }
}
