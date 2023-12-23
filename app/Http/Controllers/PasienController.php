<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Jadwal;

class PasienController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pasien',
            'pasiens' => Pasien::get()
        ];
        return view('admin.pasien.index', $data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'nama_pasien' => 'required',
            'tgllahir' => 'required',
            'alamat' => 'required',
            'kontak' => 'required'
        ]);
        $save = Pasien::create([
            'nama_pasien' => $request->nama_pasien,
            'tgllahir' => $request->tgllahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak
        ]);
        if ($save) {
            return redirect()->route('pasien.index')->with('success', 'Data was Successfully added');
        } else {
            return redirect()->route('pasien.index')->with('failed', 'Data was failed added');
        }
    }
    public function edit(Pasien $pasien)
    {
        $data = [
            'title' => 'Edit Pasien',
            'pasiens' => $pasien
        ];
        return view('admin.pasien.edit', $data);

    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama_pasien' => 'required',
            'tgllahir' => 'required',
            'alamat' => 'required',
            'kontak' => 'required'
        ]);
        $update = $pasien->update([
            'nama_pasien' => $request->nama_pasien,
            'tgllahir' => $request->tgllahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak
        ]);
        if ($update) {
            return redirect()->route('pasien.index')->with('success', 'Data was Successfully updated');
        } else {
            return redirect()->route('pasien.index')->with('failed', 'Data was failed updated');
        }
    }

    public function destroy(Pasien $pasien)
    {
        $row = Jadwal::where('pasien_id', $pasien->id)->count();
        if($row > 0) {
            return redirect()->route('pasien.index')->with('failed', 'Silahkan hapus terlebih dahulu data jadwal');
        } else {

            $delete = $pasien->delete();
            if ($delete) {
                return redirect()->route('pasien.index')->with('success', 'Data was Successfully deleted');
            } else {
                return redirect()->route('pasien.index')->with('failed', 'Data was failed deleted');
            }
        }
    }
}
