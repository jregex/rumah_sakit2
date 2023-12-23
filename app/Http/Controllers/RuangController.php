<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Ruangan',
            'ruangans' => Ruangan::orderBy('no_ruangan', 'ASC')->get()
        ];
        return view('admin.ruangan.index', $data);
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
            'no_ruangan' => 'required',
            'tipe_ruangan' => 'required'
        ]);
        $save = Ruangan::create([
            'no_ruangan' => $request->no_ruangan,
            'tipe_ruangan' => $request->tipe_ruangan,
            'ketersediaan' => 0
        ]);
        if ($save) {
            return redirect()->route('ruangan.index')->with('success', 'Data was Successfully added');
        } else {
            return redirect()->route('ruangan.index')->with('failed', 'Data was failed added');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruangan $ruangan)
    {
        $data = [
            'title' => 'Edit Ruangan',
            'ruangans' => $ruangan
        ];
        return view('admin.ruangan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'no_ruangan' => 'required',
            'tipe_ruangan' => 'required',
            'ketersediaan' => 'required'
        ]);
        $update = $ruangan->update([
            'no_ruangan' => $request->no_ruangan,
            'tipe_ruangan' => $request->tipe_ruangan,
            'ketersediaan' => $request->ketersediaan
        ]);
        if ($update) {
            return redirect()->route('ruangan.index')->with('success', 'Data was Successfully updated');
        } else {
            return redirect()->route('ruangan.index')->with('failed', 'Data was failed updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        $delete = $ruangan->delete();
        if ($delete) {
            return redirect()->route('ruangan.index')->with('success', 'Data was Successfully deleted');
        } else {
            return redirect()->route('ruangan.index')->with('failed', 'Data was failed deleted');
        }
    }
}
