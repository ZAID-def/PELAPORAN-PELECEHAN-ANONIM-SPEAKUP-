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
        return view('lapor');
    }

    public function showTrackForm()
    {
        return view('track');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kejadian' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date|before_or_equal:now',
            'deskripsi' => 'required|string',
            'phone' => 'nullable|string|max:20|regex:/^[0-9]+$/',
            'tanggal_kejadian' => 'required|date',
            'deskripsi' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Generate kode tracking
        $kodeTracking = 'SU-' . strtoupper(Str::random(6));

        // Simpan laporan
        $laporan = Laporan::create([
            'id_user' => null, // Anonim
            'jenis_kejadian' => $request->jenis_kejadian,
            'lokasi' => $request->lokasi,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'deskripsi' => $request->deskripsi,
            'phone' => $request->phone,
            'status' => 'Menunggu Verifikasi',
            'tanggal_lapor' => now(),
            'kode_tracking' => $kodeTracking,
        ]);

        // Jika ada file bukti
        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $path = $file->store('bukti', 'public');

            Bukti::create([
                'id_laporan' => $laporan->id_laporan,
                'file_bukti' => $path,
                'tipe_file' => $file->getMimeType(),
            ]);
        }

        return redirect()->route('lapor.sukses')->with('kode_tracking', $kodeTracking);
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
