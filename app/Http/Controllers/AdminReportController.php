<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\StatusUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminReportController extends Controller
{
    public function dashboard()
    {
        $laporans = Laporan::with('buktis')->get();
        return view('admin.dashboard', compact('laporans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'status' => $request->status
        ]);

        // Insert ke status_updates
        StatusUpdate::create([
            'id_laporan' => $laporan->id_laporan,
            'id_admin' => Auth::id(),
            'status' => $request->status,
            'tanggal_update' => now(),
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Status laporan berhasil diperbarui.');
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

        return redirect()->route('admin.dashboard')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    public function detail($id)
    {
        $laporan = Laporan::with('buktis')->findOrFail($id);

        return response()->json($laporan);
    }

    // =========================
    // SAVE NOTES
    // =========================

    public function saveNote(Request $request, $id)
    {
        $request->validate([
            'notes' => 'nullable|string',
        ]);

        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'notes' => $request->notes
        ]);

        // Check if request is AJAX/JSON
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Catatan laporan berhasil disimpan.'
            ]);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Catatan laporan berhasil disimpan.');
    }

    // =========================
    // DELETE NOTES
    // =========================

    public function deleteNote($id)
    {
        $laporan = Laporan::findOrFail($id);

        $laporan->update([
            'notes' => null
        ]);

        // Check if request is AJAX/JSON
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Catatan laporan berhasil dihapus.'
            ]);
        }

        return redirect()->route('admin.dashboard')
            ->with('success', 'Catatan laporan berhasil dihapus.');
    }
}