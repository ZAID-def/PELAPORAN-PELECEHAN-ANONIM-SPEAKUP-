<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\ReportComparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportComparisonController extends Controller
{
    /**
     * Halaman utama Perbandingan Laporan
     */
    public function index()
    {
        $comparisons = ReportComparison::with('creator')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.perbandingan-laporan', compact('comparisons'));
    }

    /**
     * Simpan perbandingan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_month' => 'required|date',
            'end_month' => 'required|date|after_or_equal:start_month',
            'comparison_type' => 'required|in:bulanan,kategori,status',
            'category_filter' => 'nullable|string',
            'status_filter' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $comparison = ReportComparison::create([
            'name' => $request->name,
            'start_month' => $request->start_month,
            'end_month' => $request->end_month,
            'category_filter' => $request->category_filter,
            'status_filter' => $request->status_filter,
            'comparison_type' => $request->comparison_type,
            'notes' => $request->notes,
            'created_by' => Auth::id(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Perbandingan berhasil dibuat.',
            'data' => $comparison,
        ], 201);
    }

    /**
     * Detail perbandingan
     */
    public function show($id)
    {
        $comparison = ReportComparison::with('creator')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $comparison,
        ]);
    }

    /**
     * Update konfigurasi perbandingan
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_month' => 'required|date',
            'end_month' => 'required|date|after_or_equal:start_month',
            'comparison_type' => 'required|in:bulanan,kategori,status',
            'category_filter' => 'nullable|string',
            'status_filter' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $comparison = ReportComparison::findOrFail($id);

        $comparison->update([
            'name' => $request->name,
            'start_month' => $request->start_month,
            'end_month' => $request->end_month,
            'category_filter' => $request->category_filter,
            'status_filter' => $request->status_filter,
            'comparison_type' => $request->comparison_type,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Perbandingan berhasil diperbarui.',
            'data' => $comparison,
        ]);
    }

    /**
     * Hapus konfigurasi perbandingan (BUKAN data laporan)
     */
    public function destroy($id)
    {
        $comparison = ReportComparison::findOrFail($id);
        $comparison->delete();

        return response()->json([
            'success' => true,
            'message' => 'Perbandingan berhasil dihapus.',
        ]);
    }

    /**
     * Hasil perbandingan — query data laporan berdasarkan filter
     */
    public function result($id)
    {
        $comparison = ReportComparison::findOrFail($id);

        // Build query ke tabel laporans (READ ONLY, tidak mengubah data)
        $query = Laporan::query();

        // Filter berdasarkan rentang bulan (tanggal_kejadian)
        $query->whereDate('tanggal_kejadian', '>=', $comparison->start_month)
              ->whereDate('tanggal_kejadian', '<=', $comparison->end_month->endOfMonth());

        // Filter kategori jika ada
        if ($comparison->category_filter) {
            $query->where('jenis_kejadian', $comparison->category_filter);
        }

        // Filter status jika ada
        if ($comparison->status_filter) {
            $query->where('status', $comparison->status_filter);
        }

        // Clone query sebelum aggregate
        $totalLaporan = (clone $query)->count();

        // Jumlah laporan per bulan (untuk bar chart)
        // Query hanya bulan yang ada data
        $perBulanRaw = (clone $query)
            ->select(DB::raw("DATE_FORMAT(tanggal_kejadian, '%Y-%m') as bulan"), DB::raw('COUNT(*) as jumlah'))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get()
            ->keyBy('bulan');

        // Generate semua bulan dalam rentang agar bulan kosong tetap muncul di chart
        $perBulan = collect();
        $current = $comparison->start_month->copy()->startOfMonth();
        $end = $comparison->end_month->copy()->startOfMonth();

        while ($current->lte($end)) {
            $key = $current->format('Y-m');
            $perBulan->push([
                'bulan' => $key,
                'jumlah' => $perBulanRaw->has($key) ? $perBulanRaw->get($key)->jumlah : 0,
            ]);
            $current->addMonth();
        }

        // Jumlah per kategori (untuk pie/donut chart)
        $perKategori = (clone $query)
            ->select('jenis_kejadian', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('jenis_kejadian')
            ->orderByDesc('jumlah')
            ->get();

        // Jumlah per status
        $perStatus = (clone $query)
            ->select('status', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('status')
            ->orderByDesc('jumlah')
            ->get();

        // Kategori terbanyak
        $kategoriTerbanyak = $perKategori->first();

        // Status terbanyak
        $statusTerbanyak = $perStatus->first();

        return response()->json([
            'success' => true,
            'data' => [
                'comparison' => $comparison,
                'total_laporan' => $totalLaporan,
                'per_bulan' => $perBulan,
                'per_kategori' => $perKategori,
                'per_status' => $perStatus,
                'kategori_terbanyak' => $kategoriTerbanyak ? $kategoriTerbanyak->jenis_kejadian : '-',
                'status_terbanyak' => $statusTerbanyak ? $statusTerbanyak->status : '-',
            ],
        ]);
    }
}
