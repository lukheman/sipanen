<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\HasilPanen;
use App\Models\Kecamatan;
use App\Models\Tanaman;
use App\Models\User;
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

    public function laporanHasilPanenKecamatan($idKecamatan)
    {
        $kecamatan = \App\Models\Kecamatan::findOrFail($idKecamatan);
        
        $hasilPanen = HasilPanen::select(
                'id_tanaman',
                'tahun', // ← PASTIKAN TAHUN DI-SELECT!
                DB::raw('SUM(jumlah) as total')
            )
            ->with('tanaman:id_tanaman,nama_tanaman')
            ->where('id_kecamatan', $idKecamatan)
            ->groupBy('id_tanaman', 'tahun') // ← HARUS GROUP BY TAHUN JUGA!
            ->orderBy('tahun')
            ->get();

        return view('invoices.laporan-hasil-panen-kecamatan', [
            'kecamatan' => $kecamatan,
            'hasilPanen' => $hasilPanen, // ← PAKAI NAMA INI, SESUAI VIEW
            'label' => "Laporan Hasil Panen Kecamatan {$kecamatan->nama}",
            'pdf' => false,
        ]);
    }

    public function generateHasilPanenKecamatanPDF(Request $request)
    {
        $request->validate([
            'id_kecamatan' => 'required|exists:kecamatan,id_kecamatan',
            'chart_image' => 'nullable|string'
        ]);

        $idKecamatan = $request->id_kecamatan;
        $kecamatan = \App\Models\Kecamatan::findOrFail($idKecamatan);

        $hasilPanen = HasilPanen::select(
                'id_tanaman',
                'tahun',
                DB::raw('SUM(jumlah) as total')
            )
            ->with('tanaman:id_tanaman,nama_tanaman')
            ->where('id_kecamatan', $idKecamatan)
            ->groupBy('id_tanaman', 'tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        // Proses chart image (jika dikirim dari frontend)
        $chartPath = null;
        if ($request->filled('chart_image')) {
            $image = $request->chart_image;
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = 'chart_kecamatan_' . time() . '.png';
            $chartPath = 'charts/' . $imageName;
            \Storage::disk('public')->put($chartPath, base64_decode($image));
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('invoices.laporan-hasil-panen-kecamatan', [
            'hasilPanen' => $hasilPanen,
            'kecamatan' => $kecamatan,
            'label' => "Laporan Hasil Panen Kecamatan {$kecamatan->nama}",
            'chartPath' => $chartPath,
            'pdf' => true,
        ]);

        return $pdf->download('laporan_hasil_panen_kecamatan_' . $kecamatan->nama . '_' . date('d_m_Y') . '.pdf');
    }

    public function laporanHasilPanenByKecamatan(Request $request)
    {

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
            'pdf' => false,
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
            'label' => 'Laporan Total Hasil Panen '.ucfirst($tanaman->nama_tanaman).' Pada Tiap Kecamatan',
            'pdf' => false,

        ]);
    }

    public function laporanHasilPanen($idTanaman, $idKecamatan = 'all')
    {
        // Ambil data tanaman
        $tanaman = Tanaman::findOrFail($idTanaman);

        // Ambil nama kecamatan jika ada
        $namaKecamatan = $idKecamatan !== 'all'
        ? Kecamatan::find($idKecamatan)?->nama
        : 'Semua Kecamatan';

        // Ambil data hasil panen sesuai tanaman dan kecamatan (jika bukan 'all')
        $hasilPanenRaw = HasilPanen::with('kecamatan')
            ->selectRaw('tahun, SUM(jumlah) as total, id_kecamatan')
            ->where('id_tanaman', $idTanaman)
            ->when($idKecamatan !== 'all', function ($query) use ($idKecamatan) {
                $query->where('id_kecamatan', $idKecamatan);
            })
            ->groupBy('tahun', 'id_kecamatan')
            ->orderBy('tahun')
            ->get();

        // Ambil semua tahun unik untuk tanaman ini
        $semuaTahun = HasilPanen::where('id_tanaman', $idTanaman)
            ->distinct()
            ->orderBy('tahun')
            ->pluck('tahun')
            ->toArray();

        // Format data lengkap, pastikan setiap tahun ada, jika tidak ada total = 0
        $dataLengkap = collect($semuaTahun)->map(function ($tahun) use ($hasilPanenRaw) {
            $item = $hasilPanenRaw->firstWhere('tahun', $tahun);
            return [
                'tahun' => (int) $tahun,
                'total' => $item ? (float) $item->total : 0,
            ];
        })->values()->toArray();

        return view('invoices.laporan-hasil-panen', [
            'hasilPanen' => $dataLengkap,       // untuk chart & tabel
            'hasilPanenRaw' => $hasilPanenRaw,  // optional, data asli
            'label' => 'Hasil Panen',
            'tanaman' => $tanaman,
            'namaKecamatan' => $namaKecamatan,
            'id_kecamatan' => $idKecamatan,
            'pdf' => false
        ]);
    }

    public function generateHasilPanenPDF(Request $request)
    {
        // Ambil data tanaman
        $tanaman = Tanaman::findOrFail($request->id_tanaman);

        // Ambil nama kecamatan jika ada
        $namaKecamatan = $request->id_kecamatan !== 'all'
        ? Kecamatan::find($request->id_kecamatan)?->nama
        : 'Semua Kecamatan';

        // Ambil hasil panen sesuai tanaman dan kecamatan
        $hasilPanenRaw = HasilPanen::with('kecamatan')
            ->selectRaw('tahun, SUM(jumlah) as total, id_kecamatan')
            ->where('id_tanaman', $request->id_tanaman)
            ->when($request->id_kecamatan !== 'all', function ($query) use ($request) {
                $query->where('id_kecamatan', $request->id_kecamatan);
            })
            ->groupBy('tahun', 'id_kecamatan')
            ->orderBy('tahun')
            ->get();

        // Ambil semua tahun unik
        $semuaTahun = HasilPanen::where('id_tanaman', $request->id_tanaman)
            ->distinct()
            ->orderBy('tahun')
            ->pluck('tahun')
            ->toArray();

        // Format data lengkap untuk chart dan tabel
        $dataLengkap = collect($semuaTahun)->map(function ($tahun) use ($hasilPanenRaw) {
            $item = $hasilPanenRaw->firstWhere('tahun', $tahun);
            return [
                'tahun' => (int) $tahun,
                'total' => $item ? (float) $item->total : 0,
            ];
        })->values()->toArray();

        // Ambil chart base64 jika ada
        $chartPath = null;
        $chartImage = $request->input('chart_image');
        if ($chartImage) {
            $chartImage = str_replace('data:image/png;base64,', '', $chartImage);
            $chartImage = str_replace(' ', '+', $chartImage);

            $imageName = 'chart_'.time().'.png';
            $chartPath = 'charts/'.$imageName;
            Storage::disk('public')->put($chartPath, base64_decode($chartImage));
        }

        // Generate PDF
        $pdf = Pdf::loadView('invoices.laporan-hasil-panen', [
            'hasilPanen' => $dataLengkap,
            'hasilPanenRaw' => $hasilPanenRaw,
            'label' => 'Laporan Hasil Panen '.ucfirst($tanaman->nama_tanaman),
            'tanaman' => $tanaman,
            'namaKecamatan' => $namaKecamatan,
            'chartPath' => $chartPath,
            'pdf' => true,
        ]);

        return $pdf->download('laporan_hasil_panen_'.date('d_m_Y').'.pdf');
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

            $imageName = 'chart_'.time().'.png';

            // Simpan ke storage/app/public/charts
            $chartPath = 'charts/'.$imageName;
            Storage::disk('public')->put($chartPath, base64_decode($chartImage));
        }

        $pdf = Pdf::loadView('invoices.laporan-hasil-panen-tanaman', [
            'tanaman' => $tanaman,
            'hasilPanenPerKecamatan' => $hasilPanenPerKecamatan,
            'label' => 'Laporan Total Hasil Panen '.ucfirst($tanaman->nama_tanaman).' Pada Tiap Kecamatan',
            'chartPath' => $chartPath,
            'pdf' => true,
        ]);

        return $pdf->download('laporan_hasil_panen_'.date('d_m_Y').'.pdf');
    }

}
