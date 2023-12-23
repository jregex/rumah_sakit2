<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruangan;
use App\Models\Dokter;
use App\Models\Pasien;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Jadwal Ruangan',
            'jadwals' => Jadwal::with(['ruangan','pasien','dokter'])->get(),
            'ruangans' => Ruangan::where('ketersediaan', 0)->orderBy('no_ruangan', 'ASC')->get(['id','no_ruangan']),
            'dokters' => Dokter::get(['id','nama_dokter']),
            'pasiens' => Pasien::get(['id','nama_pasien']),
        ];
        return view('admin.jadwal.index', $data);

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
            'ruangan_id' => 'required',
            'dokter_id' => 'required',
            'pasien_id' => 'required',
            'tgl' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);
        $save = Jadwal::create([
            'ruangan_id' => $request->ruangan_id,
            'dokter_id' => $request->dokter_id,
            'pasien_id' => $request->pasien_id,
            'tgl' => $request->tgl,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);
        if ($save) {
            Ruangan::where('id', $request->ruangan_id)->update(['ketersediaan' => 1]);
            return redirect()->route('jadwal.index')->with('success', 'Data was Successfully added');
        } else {
            return redirect()->route('jadwal.index')->with('failed', 'Data was failed added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
        $data = [
            'title' => 'Edit Jadwal',
            'jadwals' => $jadwal,
            'pasiens' => Pasien::get(['id','nama_pasien']),
            'dokters' => Dokter::get(['id','nama_dokter']),
            'ruangans' => Ruangan::where('ketersediaan', 0)->orderBy('no_ruangan', 'ASC')->get(['id','no_ruangan'])
        ];
        return view('admin.jadwal.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'ruangan_id' => 'required',
            'dokter_id' => 'required',
            'pasien_id' => 'required',
            'tgl' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);
        $update = $jadwal->update([
            'ruangan_id' => $request->ruangan_id,
            'dokter_id' => $request->dokter_id,
            'pasien_id' => $request->pasien_id,
            'tgl' => $request->tgl,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai
        ]);
        if ($update) {
            Ruangan::where('id', $request->ruangan_id)->update(['ketersediaan' => 1]);
            return redirect()->route('jadwal.index')->with('success', 'Data was Successfully updated');
        } else {
            return redirect()->route('jadwal.index')->with('failed', 'Data was failed updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        $delete = $jadwal->delete();
        if ($delete) {
            return redirect()->route('jadwal.index')->with('success', 'Data was Successfully deleted');
        } else {
            return redirect()->route('jadwal.index')->with('failed', 'Data was failed deleted');
        }
    }

}
