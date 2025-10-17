<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Kecamatan;
use App\Models\Tanaman;
use App\Models\User;
use App\Models\Petugas;
use App\Models\HasilPanen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function laporanPetugas()
    {

        $users = User::query()->with('kecamatan')->where('role', Role::PETUGAS)->get();

        $pdf = Pdf::loadView('invoices.laporan-petugas', ['users' => $users, 'label' => 'Petugas Lapangan', 'pdf' => true]);

        return $pdf->download('laporan_data_petugas_lapangan'.date('d_m_Y').'.pdf');

    }

    public function laporanHasilPanenByKecamatan(Request $request) {

        // Ambil data kecamatan
        $kecamatan = Kecamatan::findOrFail($request->idKecamatan);

        // Hitung total hasil panen tiap tanaman di kecamatan tersebut
        $hasilPanenPerTanaman = HasilPanen::select('id_tanaman', DB::raw('SUM(jumlah) as total'))
            ->with('tanaman') // relasi ke tabel tanaman
            ->where('id_kecamatan', $request->idKecamatan)
            ->groupBy('id_tanaman')
            ->orderByDesc('total')
            ->get();


        return view('invoices.laporan-hasil-panen-kecamatan', [
            'kecamatan' => $kecamatan,
            'hasilPanenPerTanaman' => $hasilPanenPerTanaman,
            'label' => "Laporan Total Hasil Panen di Kecamatan {$kecamatan->nama_kecamatan}",
            'pdf' => false
        ]);

    }

    public function laporanHasilPanenByTanaman($idTanaman)
    {
    // Ambil data tanaman
    $tanaman = Tanaman::findOrFail($idTanaman);

    // Hitung total hasil panen per kecamatan untuk tanaman tersebut
    $hasilPanenPerKecamatan = HasilPanen::select('id_kecamatan', DB::raw('SUM(jumlah) as total'))
        ->with('kecamatan') // relasi ke kecamatan
        ->where('id_tanaman', $idTanaman)
        ->groupBy('id_kecamatan')
        ->orderByDesc('total')
        ->get();

    return view('invoices.laporan-hasil-panen-tanaman', [
        'tanaman' => $tanaman,
        'hasilPanenPerKecamatan' => $hasilPanenPerKecamatan,
        'label' => "Laporan Total Hasil Panen " . ucfirst($tanaman->nama_tanaman) . " Pada Tiap Kecamatan",
        'pdf' => false

    ]);
}

    public function laporanHasilPanen($idTanaman) {

        $hasilPanen = HasilPanen::with('tanaman', 'kecamatan')->where('id_tanaman', $idTanaman)->get();

        // $hasilPanenPerKecamatan = $hasilPanen->groupBy(function ($item) {
        //     return $item->petani->desa->kecamatan->nama;
        // });


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
            'pdf' => false,
            'id_tanaman' => $idTanaman
        ]);


    }

    public function generatePDF(Request $request)
    {


        $tanaman = Tanaman::findOrFail($request->id_tanaman);


        $hasilPanenPerKecamatan = HasilPanen::select('id_kecamatan', DB::raw('SUM(jumlah) as total'))
            ->with('kecamatan') // relasi ke kecamatan
            ->where('id_tanaman', $request->id_tanaman)
            ->groupBy('id_kecamatan')
            ->orderByDesc('total')
            ->get();

        $chartPath = null;

        // Ambil chart base64
        $chartImage = $request->input('chart_image');

        if ($chartImage) {
                // Decode Base64
            $chartImage = str_replace('data:image/png;base64,', '', $chartImage);
            $chartImage = str_replace(' ', '+', $chartImage);

            $imageName = 'chart_' . time() . '.png';

            // Simpan ke storage/app/public/charts
            $chartPath = 'charts/' . $imageName;
            Storage::disk('public')->put($chartPath, base64_decode($chartImage));
        }

        $pdf = Pdf::loadView('invoices.laporan-hasil-panen-tanaman', [
            'tanaman' => $tanaman,
            'hasilPanenPerKecamatan' => $hasilPanenPerKecamatan,
            'label' => "Laporan Total Hasil Panen " . ucfirst($tanaman->nama_tanaman) . " Pada Tiap Kecamatan",
            'chartPath' => $chartPath,
            'pdf' => true
        ]);

        return $pdf->download('laporan_hasil_panen_'.date('d_m_Y').'.pdf');
    }

}
