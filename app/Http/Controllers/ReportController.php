<?php

namespace App\Http\Controllers;

use App\Models\Bukti;
use App\Models\KategoriKejadian;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function create()
    {
        $kategoris = KategoriKejadian::where('is_active', true)->orderBy('nama_kategori')->get();
        return view('lapor', compact('kategoris'));
    }

    public function showTrackForm()
    {
        return view('track');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kejadian'   => 'required|string',
            'lokasi'           => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'deskripsi'        => 'required|string',
            'phone'            => 'nullable|string|max:20',
            'bukti'            => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Generate kode tracking
        $kodeTracking = 'SU-' . strtoupper(Str::random(6));

        try {
            // Simpan laporan
            $laporan = Laporan::create([
                'id_user'          => null,
                'jenis_kejadian'   => $request->jenis_kejadian,
                'lokasi'           => $request->lokasi,
                'tanggal_kejadian' => $request->tanggal_kejadian,
                'deskripsi'        => $request->deskripsi,
                'phone'            => $request->phone,
                'status'           => 'Menunggu Verifikasi',
                'tanggal_lapor'    => now(),
                'kode_tracking'    => $kodeTracking,
            ]);

            // Simpan bukti digital (aman)
            if ($request->hasFile('bukti')) {
                $file = $request->file('bukti');
                $path = $file->store('bukti', 'public');

                $laporan->bukti_file = $path;
                $laporan->bukti_tipe_file = $file->getMimeType();
                $laporan->save();
            }

            return redirect()->route('lapor.sukses')
                ->with('kode_tracking', $kodeTracking);

        } catch (\Exception $e) {
            // Catat error biar bisa dicek
            \Log::error('Gagal membuat laporan: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan laporan. Silakan coba lagi.');
        }
    }

    public function sukses()
    {
        return view('sukses');
    }

    public function track(Request $request)
    {
        $request->validate([
            'kode_tracking' => 'required|string',
        ]);

        $laporan = Laporan::where('kode_tracking', $request->kode_tracking)->first();

        if ($laporan) {
            return view('track', compact('laporan'));
        }

        return view('track')->withErrors(['kode_tracking' => 'Kode tracking tidak ditemukan.']);
    }
}
