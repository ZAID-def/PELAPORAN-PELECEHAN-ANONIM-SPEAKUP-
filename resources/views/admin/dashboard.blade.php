<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <aside class="w-72 bg-indigo-900 text-white p-6 flex flex-col">
            <div class="flex items-center gap-3 mb-8">
                <div class="rounded-full bg-white/10 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-wider">SpeakUp</p>
                    <p class="text-xs text-indigo-200">Admin Panel</p>
                </div>
            </div>

            <nav class="flex-1 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg bg-white/10 px-4 py-3 text-white hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Manajemen Laporan</span>
                </a>
            </nav>

            <div class="border-t border-white/10 pt-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-red-600 hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </header>

            <div class="flex-1 overflow-auto p-8">
                @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="border-b border-gray-200 px-8 py-6 flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-gray-900">Daftar Laporan Masuk</h2>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Total Laporan</p>
                            <p class="text-3xl font-bold text-indigo-600">{{ count($laporans) }}</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID Laporan</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jenis Kejadian</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Notes</th>
                                    <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @forelse($laporans as $laporan)
                                <tr class="hover:bg-gray-50 transition">
                                    
                                    <td class="px-8 py-4 whitespace-nowrap">
                                        <span class="text-sm font-medium text-indigo-600">
                                            {{ $laporan->kode_tracking }}
                                        </span>
                                    </td>

                                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $laporan->tanggal_kejadian->format('Y-m-d') }}
                                    </td>

                                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $laporan->jenis_kejadian }}
                                    </td>

                                    <td class="px-8 py-4 whitespace-nowrap">
                                        <form action="{{ route('admin.reports.updateStatus', $laporan->id_laporan) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PATCH')

                                            <select name="status"
                                                onchange="this.form.submit()"
                                                class="text-sm px-3 py-1.5 border rounded-lg cursor-pointer
                                                @if($laporan->status == 'Menunggu Verifikasi') bg-yellow-100 border-yellow-300 text-yellow-800
                                                @elseif($laporan->status == 'Diproses') bg-blue-100 border-blue-300 text-blue-800
                                                @elseif($laporan->status == 'Selesai') bg-green-100 border-green-300 text-green-800
                                                @else bg-gray-100 border-gray-300 text-gray-800
                                                @endif">

                                                <option value="Menunggu Verifikasi" {{ $laporan->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>
                                                    Menunggu Verifikasi
                                                </option>

                                                <option value="Diproses" {{ $laporan->status == 'Diproses' ? 'selected' : '' }}>
                                                    Diproses
                                                </option>

                                                <option value="Selesai" {{ $laporan->status == 'Selesai' ? 'selected' : '' }}>
                                                    Selesai
                                                </option>

                                                <option value="Ditolak" {{ $laporan->status == 'Ditolak' ? 'selected' : '' }}>
                                                    Ditolak
                                                </option>
                                            </select>
                                        </form>
                                    </td>

                                    <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-700 max-w-xs truncate">
                                        {{ $laporan->notes ?? 'Belum ada catatan' }}
                                    </td>

                                    <td class="px-8 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center gap-2">
                                            <!-- Edit Notes -->
                                            <button type="button"
                                                class="edit-note-btn text-yellow-600 hover:text-yellow-900 transition"
                                                data-report-id="{{ $laporan->id_laporan }}"
                                                data-notes="{{ $laporan->notes ?? '' }}"
                                                title="Edit Notes">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z"/>
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M18.364 7.636L14.828 4.1"/>
                                                </svg>
                                            </button>

                                            <!-- View Detail -->
                                            <button type="button"
                                                onclick="showDetail({{ $laporan->id_laporan }})"
                                                class="text-indigo-600 hover:text-indigo-900 transition"
                                                title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </button>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.reports.destroy', $laporan->id_laporan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 transition" title="Hapus Laporan">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="6" class="px-8 py-12 text-center text-gray-500">
                                        Tidak ada laporan masuk
                                    </td>
                                </tr>

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full mx-4">
            <div class="px-8 py-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">Detail Laporan</h3>
                <button type="button" onclick="closeDetail()" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-8 py-6 space-y-4 max-h-96 overflow-y-auto">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">ID Laporan</p>
                        <p id="detailId" class="text-lg font-semibold text-gray-900"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Status</p>
                        <p id="detailStatus" class="text-lg font-semibold"></p>
                    </div>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Jenis Kejadian</p>
                    <p id="detailJenis" class="text-base text-gray-900 font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Lokasi</p>
                    <p id="detailLokasi" class="text-base text-gray-900 font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Kejadian</p>
                    <p id="detailTanggal" class="text-base text-gray-900 font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Deskripsi</p>
                    <p id="detailDeskripsi" class="text-base text-gray-900 bg-gray-50 p-3 rounded-lg whitespace-pre-wrap"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Nomor Telepon</p>
                    <p id="detailPhone" class="text-base text-gray-900 font-medium"></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Catatan</p>
                    <p id="detailNotes" class="text-base text-gray-900 bg-gray-50 p-3 rounded-lg whitespace-pre-wrap">Tidak ada catatan</p>
                </div>
                <div id="detailBukti" class="hidden">
                    <p class="text-sm text-gray-600">Bukti</p>
                    <div id="buktiContainer" class="grid grid-cols-1 gap-2"></div>
                </div>
            </div>
            <div class="px-8 py-4 border-t border-gray-200 flex justify-end">
                <button type="button" onclick="closeDetail()" class="px-4 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400 transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Note Modal -->
    <div id="noteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full mx-4">

            <div class="px-8 py-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-xl font-bold text-gray-900">
                    Catatan / Alasan Penolakan
                </h3>

                <button type="button"
                    onclick="closeNoteModal()"
                    class="text-gray-500 hover:text-gray-700">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form id="noteForm" method="POST" class="px-8 py-6 space-y-4">

                @csrf
                @method('PUT')

                <div>
                    <label for="notes"
                        class="block text-sm font-medium text-gray-700 mb-1">
                        Catatan
                    </label>

                    <textarea id="notes"
                        name="notes"
                        rows="5"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        placeholder="Masukkan catatan atau alasan penolakan..."></textarea>
                </div>

                <div class="flex items-center justify-between gap-4">

                    <button type="button"
                        onclick="deleteNote()"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">

                        Hapus Catatan
                    </button>

                    <div class="flex gap-2">

                        <button type="button"
                            onclick="closeNoteModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-900 rounded-lg hover:bg-gray-400 transition">

                            Batal
                        </button>

                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">

                            Simpan Catatan
                        </button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Get CSRF token helper
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]')?.content || 
                   document.querySelector('input[name="_token"]')?.value;
        }

        // Setup event listeners for edit note buttons
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-note-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const reportId = this.getAttribute('data-report-id');
                    const notes = this.getAttribute('data-notes');
                    openNoteModal(reportId, notes);
                });
            });
        });

        // Detail Modal Functions
        function showDetail(id) {
            fetch(`/admin/reports/${id}/detail`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detailId').textContent = data.kode_tracking;
                    document.getElementById('detailJenis').textContent = data.jenis_kejadian;
                    document.getElementById('detailLokasi').textContent = data.lokasi;
                    document.getElementById('detailDeskripsi').textContent = data.deskripsi;
                    document.getElementById('detailTanggal').textContent = new Date(data.tanggal_kejadian).toLocaleString('id-ID');
                    document.getElementById('detailPhone').textContent = data.phone || 'Tidak disediakan';
                    document.getElementById('detailNotes').textContent = data.notes || 'Tidak ada catatan';
                    
                    let statusColor = 'bg-gray-100 text-gray-800';
                    if(data.status === 'Menunggu Verifikasi') statusColor = 'bg-yellow-100 text-yellow-800';
                    else if(data.status === 'Diproses') statusColor = 'bg-blue-100 text-blue-800';
                    else if(data.status === 'Selesai') statusColor = 'bg-green-100 text-green-800';
                    else if(data.status === 'Ditolak') statusColor = 'bg-red-100 text-red-800';
                    
                    document.getElementById('detailStatus').innerHTML = `<span class="px-3 py-1 rounded-full text-xs font-semibold ${statusColor}">${data.status}</span>`;
                    
                    // Tampilkan bukti
                    const buktiContainer = document.getElementById('buktiContainer');
                    buktiContainer.innerHTML = '';
                    if(data.buktis && data.buktis.length > 0) {
                        document.getElementById('detailBukti').classList.remove('hidden');
                        data.buktis.forEach(bukti => {
                            const img = document.createElement('img');
                            img.src = `/storage/${bukti.file_bukti}`;
                            img.className = 'max-w-full h-auto rounded-lg shadow-md';
                            img.alt = 'Bukti laporan';
                            buktiContainer.appendChild(img);
                        });
                    } else {
                        document.getElementById('detailBukti').classList.add('hidden');
                    }
                    
                    document.getElementById('detailModal').classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat detail laporan');
                });
        }

        function closeDetail() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Note Modal Functions
        function openNoteModal(id, notes) {
            const noteForm = document.getElementById('noteForm');
            noteForm.action = `/admin/reports/${id}/notes`;
            document.getElementById('notes').value = notes || '';
            noteForm.dataset.reportId = id;
            document.getElementById('noteModal').classList.remove('hidden');
        }

        function closeNoteModal() {
            document.getElementById('noteModal').classList.add('hidden');
            document.getElementById('noteForm').reset();
        }

        function deleteNote() {
            if (!confirm('Apakah Anda yakin ingin menghapus catatan ini?')) {
                return;
            }

            const form = document.getElementById('noteForm');
            const reportId = form.dataset.reportId;
            
            if (!reportId) {
                alert('Error: ID laporan tidak ditemukan');
                return;
            }

            fetch(`/admin/reports/${reportId}/notes`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-Token': getCsrfToken(),
                    'Content-Type': 'application/json',
                }
            })
            .then(response => {
                if (response.ok) {
                    closeNoteModal();
                    location.reload();
                } else {
                    alert('Error: Gagal menghapus catatan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error: Gagal menghapus catatan');
            });
        }

        // Handle Note Form Submission
        document.getElementById('noteForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const noteTextarea = document.getElementById('notes');
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': getCsrfToken(),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        notes: noteTextarea.value,
                        _method: 'PUT'
                    })
                });

                if (response.ok) {
                    // Close modal
                    closeNoteModal();
                    // Reload page to show updated data
                    location.reload();
                } else {
                    const errorData = await response.json();
                    alert('Error: ' + (errorData.message || 'Gagal menyimpan catatan'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error: Gagal menyimpan catatan');
            }
        });

        // Click outside modal to close
        document.getElementById('detailModal')?.addEventListener('click', function(e) {
            if(e.target === this) closeDetail();
        });

        document.getElementById('noteModal')?.addEventListener('click', function(e) {
            if(e.target === this) closeNoteModal();
        });

        // Auto-hide modals after page refresh
        window.addEventListener('DOMContentLoaded', () => {
            document.getElementById('noteModal')?.classList.add('hidden');
            document.getElementById('detailModal')?.classList.add('hidden');
        });
    </script>
</body>
</html>