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
        $pdf = Pdf::loadView('invoices.laporan-petani', ['users' => $users, 'label' => 'Petani', 'pdf' => true]);

        return $pdf->download('laporan_data_petani_'.date('d_m_Y').'.pdf');

    }

    public function laporanPetugas()
    {

        $users = Petugas::all();

        $pdf = Pdf::loadView('invoices.laporan-petugas', ['users' => $users, 'label' => 'Petugas Lapangan', 'pdf' => true]);

        return $pdf->download('laporan_data_petugas_lapangan'.date('d_m_Y').'.pdf');

    }

    public function laporanHasilPanen($idTanaman) {

        $hasilPanen = HasilPanen::with(['petani', 'tanaman', 'petani.desa', 'petani.desa.kecamatan'])->where('id_tanaman', $idTanaman)->get();

        // $hasilPanenPerKecamatan = $hasilPanen->groupBy(function ($item) {
        //     return $item->petani->desa->kecamatan->nama;
        // });

        // dd($hasilPanenPerKecamatan);

        $hasilPanenPerKecamatan = $hasilPanen->groupBy(function ($item) {
            return $item->petani->desa->kecamatan->nama;
        })->map(function ($group) {
            return $group->sum('jumlah');
        })->take(5)->sortDesc();

        $labels = $hasilPanenPerKecamatan->keys()->toArray();
        $series = $hasilPanenPerKecamatan->values()->toArray();

        $chartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => $labels,
                'datasets' => [[
                    'label' => 'Total Panen',
                    'data' => $series,
                    'backgroundColor' => '#1E88E5',
                ]]
            ],
            'options' => [
                'plugins' => [
                    'legend' => ['display' => false]
                ]
            ]
        ];

        return view('invoices.laporan-hasil-panen', [
            'hasilPanen' => $hasilPanen,
            'label' => 'Hasil Panen',
            'labels' => $labels,
            'series' => $series,
            'pdf' => false
        ]);


    }

    public function generatePDF(Request $request)
    {
        $hasilPanen = HasilPanen::with(['petani', 'tanaman', 'petani.desa.kecamatan'])->get();

        // Ambil chart base64
        $chartImage = $request->input('chart_image');

        if ($chartImage) {
            // Decode Base64
            $chartImage = str_replace('data:image/png;base64,', '', $chartImage);
            $chartImage = str_replace(' ', '+', $chartImage);
            $imageName = 'chart_' . time() . '.png';

            $path = public_path('charts');

            // pastikan folder ada
            if (!\File::exists($path)) {
                \File::makeDirectory($path, 0755, true);
            }

            \File::put(public_path('charts/'.$imageName), base64_decode($chartImage));
        }

        $pdf = \Pdf::loadView('invoices.laporan-hasil-panen', [
            'hasilPanen' => $hasilPanen,
            'label' => 'Hasil Panen',
            'chartPath' => $imageName ?? null,
            'pdf' => true
        ]);

        return $pdf->download('laporan_hasil_panen_'.date('d_m_Y').'.pdf');
    }

}
