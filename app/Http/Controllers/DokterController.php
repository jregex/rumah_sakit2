<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Dokter',
            'dokters' => Dokter::get()
        ];
        return view('admin.dokter.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'spesialis' => 'required',
            'kontak' => 'required'
        ]);
        $save = Dokter::create([
            'nama_dokter' => $request->nama_dokter,
            'spesialis' => $request->spesialis,
            'kontak' => $request->kontak
        ]);
        if ($save) {
            return redirect()->route('dokter.index')->with('success', 'Data was Successfully added');
        } else {
            return redirect()->route('dokter.index')->with('failed', 'Data was failed added');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokter $dokter)
    {
        $data = [
            'title' => 'Edit Dokter',
            'dokters' => $dokter
        ];
        return view('admin.dokter.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'nama_dokter' => 'required',
            'spesialis' => 'required',
            'kontak' => 'required'
        ]);
        $update = $dokter->update([
            'nama_dokter' => $request->nama_dokter,
            'spesialis' => $request->spesialis,
            'kontak' => $request->kontak
        ]);
        if ($update) {
            return redirect()->route('dokter.index')->with('success', 'Data was Successfully updated');
        } else {
            return redirect()->route('dokter.index')->with('failed', 'Data was failed updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokter $dokter)
    {
        $row = Jadwal::where('dokter_id', $dokter->id)->count();
        if($row > 0) {
            return redirect()->route('dokter.index')->with('failed', 'Silahkan hapus terlebih dahulu data jadwal');
        } else {
            $delete = $dokter->delete();
            if ($delete) {
                return redirect()->route('dokter.index')->with('success', 'Data was Successfully deleted');
            } else {
                return redirect()->route('dokter.index')->with('failed', 'Data was failed deleted');
            }

        }
    }

}
