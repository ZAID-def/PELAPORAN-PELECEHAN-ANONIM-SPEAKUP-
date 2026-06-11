<?php

namespace App\Http\Controllers;

use App\Models\Bukti;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminBuktiController extends Controller
{
    /**
     * PBI #46 - Tampilkan daftar semua bukti fisik
     */
    public function index(Request $request)
    {
        $query = Bukti::with('laporan');

        if ($request->filled('kode_tracking')) {
            $query->whereHas('laporan', function ($q) use ($request) {
                $q->where('kode_tracking', 'like', '%' . $request->kode_tracking . '%');
            });
        }

        if ($request->filled('lokasi_simpan')) {
            $query->where('lokasi_simpan', 'like', '%' . $request->lokasi_simpan . '%');
        }

        if ($request->filled('status_bukti')) {
            $query->where('status_bukti', $request->status_bukti);
        }

        $buktis = $query->latest()->paginate(15)->withQueryString();

        return view('admin.bukti', compact('buktis'));   // pastikan nama view sesuai
    }

    /**
     * PBI #45 - Tampilkan form tambah bukti baru
     */
    public function create()
    {
        $laporans = Laporan::select('id_laporan', 'kode_tracking', 'jenis_kejadian')->get();
        return view('admin.bukti_fisik.create', compact('laporans'));
    }

    /**
     * PBI #45 - Simpan bukti baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_laporan'    => 'required|exists:laporans,id_laporan',
            'nama_barang'   => 'required|string|max:255',
            'file_bukti'    => 'nullable|file|mimes:jpg,jpeg,png,pdf,mp4,mov|max:20480',
            'lokasi_simpan' => 'required|string|max:255',
            'catatan'       => 'nullable|string',
        ], [
            'id_laporan.required'    => 'ID Kasus wajib dipilih.',
            'id_laporan.exists'      => 'Kasus tidak ditemukan.',
            'nama_barang.required'   => 'Nama barang bukti wajib diisi.',
            'lokasi_simpan.required' => 'Lokasi simpan wajib diisi.',
            'file_bukti.mimes'       => 'File harus berupa JPG, PNG, PDF, MP4, atau MOV.',
            'file_bukti.max'         => 'Ukuran file maksimal 20MB.',
        ]);

        $filePath = null;
        $tipeFile = null;

        if ($request->hasFile('file_bukti')) {
            $file     = $request->file('file_bukti');
            $filePath = $file->store('bukti', 'public');
            $tipeFile = $file->getClientMimeType();
        }

        Bukti::create([
            'id_laporan'    => $request->id_laporan,
            'nama_barang'   => $request->nama_barang,
            'file_bukti'    => $filePath,
            'tipe_file'     => $tipeFile ?? '-',
            'status_bukti'  => 'Disimpan',
            'lokasi_simpan' => $request->lokasi_simpan,
            'catatan'       => $request->catatan,
        ]);

        return redirect()->route('admin.bukti.index')
            ->with('success', 'Bukti fisik berhasil didaftarkan.');
    }

    /**
     * PBI #47 - Tampilkan form edit status & lokasi bukti
     */
    public function edit($id)
    {
        $bukti    = Bukti::with('laporan')->findOrFail($id);
        $laporans = Laporan::select('id_laporan', 'kode_tracking', 'jenis_kejadian')->get();
        return view('admin.bukti_fisik.edit', compact('bukti', 'laporans'));
    }

    /**
     * PBI #47 - Perbarui status & lokasi bukti
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_bukti'  => 'required|in:Disimpan,Dipinjam,Dipindahkan,Dimusnahkan,Dikembalikan',
            'lokasi_simpan' => 'required|string|max:255',
            'catatan'       => 'nullable|string',
        ], [
            'status_bukti.required'  => 'Status bukti wajib dipilih.',
            'status_bukti.in'        => 'Status bukti tidak valid.',
            'lokasi_simpan.required' => 'Lokasi simpan wajib diisi.',
        ]);

        $bukti = Bukti::findOrFail($id);
        $bukti->update([
            'status_bukti'  => $request->status_bukti,
            'lokasi_simpan' => $request->lokasi_simpan,
            'catatan'       => $request->catatan,
        ]);

        return redirect()->route('admin.bukti.index')
            ->with('success', 'Status dan lokasi bukti berhasil diperbarui.');
    }

    /**
     * PBI #48 - Arsipkan bukti (ubah status menjadi Dimusnahkan/Dikembalikan)
     * Hanya bisa dilakukan jika kasus sudah berstatus 'Selesai'
     */
    public function archive(Request $request, $id)
    {
        $request->validate([
            'status_bukti' => 'required|in:Dimusnahkan,Dikembalikan',
            'catatan'      => 'nullable|string|max:500',
        ]);

        $bukti = Bukti::with('laporan')->findOrFail($id);

        // Validasi sesuai User Story PBI #48
        if ($bukti->laporan->status !== 'Selesai') {
            return back()->with('error', 'Bukti hanya bisa diarsipkan jika kasus sudah berstatus Selesai.');
        }

        $adminName = Auth::user()->name;
        $tanggal   = now()->format('d/m/Y H:i');

        $catatanBaru = "[$tanggal] Diarsipkan oleh {$adminName} | Status: {$request->status_bukti}\n" . 
                    ($request->catatan ? "Alasan: {$request->catatan}" : "");

        $bukti->update([
            'status_bukti' => $request->status_bukti,
            'catatan'      => $bukti->catatan 
                ? $bukti->catatan . "\n\n" . $catatanBaru 
                : $catatanBaru,
        ]);

        return redirect()->route('admin.bukti.index')
            ->with('success', 'Bukti berhasil diarsipkan dengan status: ' . $request->status_bukti);
    }

    /**
     * PBI #48 - Hapus permanen data bukti
     * Hanya bisa dilakukan jika kasus sudah berstatus 'Selesai'
     */
    public function destroy($id)
    {
        $bukti = Bukti::with('laporan')->findOrFail($id);

        // Validasi sesuai User Story PBI #48
        if ($bukti->laporan->status !== 'Selesai') {
            return back()->with('error', 'Bukti hanya bisa dihapus jika kasus sudah berstatus Selesai.');
        }

        // Hapus file fisik jika ada
        if ($bukti->file_bukti) {
            Storage::disk('public')->delete($bukti->file_bukti);
        }

        $bukti->delete();

        return redirect()->route('admin.bukti.index')
            ->with('success', 'Data bukti fisik berhasil dihapus.');
    }
}