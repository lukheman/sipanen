<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Petugas;
use App\Models\HasilPanen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanPetani()
    {

        $users = User::all();
        $pdf = Pdf::loadView('invoices.laporan-petani', ['users' => $users, 'label' => 'Petani']);

        return $pdf->download('laporan_data_petani_'.date('d_m_Y').'.pdf');

    }

    public function laporanPetugas()
    {

        $users = Petugas::all();

        $pdf = Pdf::loadView('invoices.laporan-petugas', ['users' => $users, 'label' => 'Petugas Lapangan']);

        return $pdf->download('laporan_data_petugas_lapangan'.date('d_m_Y').'.pdf');

    }

    public function laporanHasilPanen() {

        $hasilPanen = HasilPanen::with(['petani', 'tanaman'])->get();

        $pdf = Pdf::loadView('invoices.laporan-hasil-panen', ['hasilPanen' => $hasilPanen, 'label' => 'Hasil Panen']);

        return $pdf->download('laporan_hasil_panen_'.date('d_m_Y').'.pdf');


    }

}
