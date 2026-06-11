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
        $oldStatus = $laporan->status;
        $laporan->update(['status' => $request->status]);

        // Insert ke status_updates
        StatusUpdate::create([
            'id_laporan' => $laporan->id_laporan,
            'id_admin' => Auth::id(),
            'status' => $request->status,
            'tanggal_update' => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        
        // Hapus bukti terkait
        foreach ($laporan->buktis as $bukti) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($bukti->file_bukti);
            $bukti->delete();
        }
        
        // Hapus status updates
        $laporan->statusUpdates()->delete();
        
        // Hapus laporan
        $laporan->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Laporan berhasil dihapus.');
    }

    public function detail($id)
    {
        $laporan = Laporan::with('buktis')->findOrFail($id);
        return response()->json($laporan);
    }
}
