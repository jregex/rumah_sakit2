<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Ruangan;
use App\Models\Jadwal;
use PDF;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'jumlah_pasien' => Pasien::count(),
            'jumlah_ruangan' => Ruangan::count(),
            'jumlah_jadwal' => Jadwal::count()
        ];
        // return $data;
        return view('dashboard', $data);
    }

    public function downloadPdf()
    {
        $data = [
            'title' => 'List Jadwal',
            'jadwals' => Jadwal::with(['ruangan','pasien','dokter'])->get()
        ];
        $pdf = PDF::loadView('admin.jadwalpdf', $data);
        return $pdf->download('jadwal.pdf');
    }

    public function detail($jadwal)
    {
        $data = [
            'title' => 'Detail Jadwal',
            'jadwals' => Jadwal::where('id', $jadwal)->with(['ruangan','pasien','dokter'])->first()
        ];
        $pdf = PDF::loadView('admin.pdf', $data);
        return $pdf->download('struk.pdf');
    }

}
