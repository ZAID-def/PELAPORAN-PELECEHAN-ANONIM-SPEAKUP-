<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\StatusUpdate;
use Illuminate\Http\Request;
use App\Models\Bukti;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminReportController extends Controller
{
    public function dashboard(Request $request)
    {
        $query = Laporan::with('buktis')->orderBy('tanggal_lapor', 'desc');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan jenis kejadian
        if ($request->filled('jenis')) {
            $query->where('jenis_kejadian', $request->jenis);
        }

        // Pencarian kode tracking atau deskripsi
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_tracking', 'like', "%{$search}%")
                    ->orWhere('jenis_kejadian', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $laporans = $query->get();

        // Statistik
        $allLaporans = Laporan::all();
        $stats = [
            'total'               => $allLaporans->count(),
            'menunggu_verifikasi' => $allLaporans->where('status', 'Menunggu Verifikasi')->count(),
            'diproses'            => $allLaporans->where('status', 'Diproses')->count(),
            'selesai'             => $allLaporans->where('status', 'Selesai')->count(),
            'ditolak'             => $allLaporans->where('status', 'Ditolak')->count(),
            'baru_hari_ini'       => Laporan::whereDate('tanggal_lapor', today())->count(),
        ];

        return view('admin.dashboard', compact('laporans', 'stats'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $laporan = Laporan::findOrFail($id);
        $oldStatus = $laporan->status;
        $laporan->update(['status' => $request->status]);

        // Insert ke status_updates
        StatusUpdate::create([
            'id_laporan'   => $laporan->id_laporan,
            'id_admin'     => Auth::id(),
            'status'       => $request->status,
            'tanggal_update' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        

        // Hapus bukti terkait
        foreach ($laporan->buktis as $bukti) {
            Storage::disk('public')->delete($bukti->file_bukti);
            $bukti->delete();
        }
        
        // Hapus status updates
        $laporan->statusUpdates()->delete();

        // Hapus laporan
        $laporan->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil dihapus.');
    }

    public function saveNotes(Request $request, $id)
    {
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'notes' => $request->input('notes'),
        ]);

        // Return JSON untuk AJAX, atau redirect untuk form submit
        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Catatan admin berhasil disimpan.']);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Catatan admin berhasil disimpan.');
    }

    public function deleteNotes($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update(['notes' => null]);

        // Return JSON untuk AJAX, atau redirect untuk form submit
        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Catatan admin berhasil dihapus.']);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Catatan admin berhasil dihapus.');
    }

    public function detail($id)
    {
        $laporan = Laporan::with('buktis', 'statusUpdates')->findOrFail($id);

        return response()->json($laporan);
    }

    /**
     * Simpan catatan admin untuk laporan (notes feature)
     */
    public function saveNote(Request $request, $id)
    {
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update([
            'notes' => $request->input('notes'),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Catatan admin berhasil disimpan.']);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Catatan admin berhasil disimpan.');
    }

    /**
     * Hapus catatan admin dari laporan
     */
    public function deleteNote($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->update(['notes' => null]);

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Catatan admin berhasil dihapus.']);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Catatan admin berhasil dihapus.');
    }
}

