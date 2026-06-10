<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bukti Fisik - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-white/10 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Manajemen Laporan</span>
                </a>
                <a href="{{ route('admin.bukti.index') }}" class="flex items-center gap-3 rounded-lg bg-white/10 px-4 py-3 text-white hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span>Bukti Fisik</span>
                </a>
                <a href="{{ route('admin.chat.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-white/10 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                    </svg>
                    <span>Customer Service</span>
                </a>
                @if(Auth::user()->role === 'super_admin')
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-white/10 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 18a6 6 0 0112 0"/>
                    </svg>
                    <span>Kelola User</span>
                </a>
                @endif
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
 
        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-900">Manajemen Bukti Fisik</h1>
                </div>
                <a href="{{ route('admin.bukti.create') }}" class="flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Bukti
                </a>
            </header>
 
            <div class="flex-1 overflow-auto p-8">
                @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
                    {{ session('success') }}
                </div>
                @endif
 
                <!-- Filter & Search -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-5 mb-6">
                    <form action="{{ route('admin.bukti.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Cari ID Kasus</label>
                            <input type="text" name="kode_tracking" value="{{ request('kode_tracking') }}"
                                placeholder="Contoh: SPK-20260001"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Cari Lokasi Simpan</label>
                            <input type="text" name="lokasi_simpan" value="{{ request('lokasi_simpan') }}"
                                placeholder="Contoh: Ruang Arsip A"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Status Bukti</label>
                            <select name="status_bukti" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">Semua Status</option>
                                @foreach(['Disimpan','Dipinjam','Dipindahkan','Dimusnahkan','Dikembalikan'] as $status)
                                    <option value="{{ $status }}" {{ request('status_bukti') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                Cari
                            </button>
                            @if(request()->hasAny(['kode_tracking','lokasi_simpan','status_bukti']))
                            <a href="{{ route('admin.bukti.index') }}" class="px-3 py-2 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition text-sm">
                                Reset
                            </a>
                            @endif
                        </div>
                    </form>
                </div>
 
                <!-- Tabel -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-900">Daftar Bukti Fisik</h2>
                        <span class="text-sm text-gray-500">Total: <span class="font-semibold text-indigo-600">{{ $buktis->total() }}</span> item</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID Bukti</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Barang</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID Kasus</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Lokasi Simpan</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal Masuk</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($buktis as $bukti)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-indigo-600">#{{ $bukti->id_bukti }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 max-w-xs">
                                        <p class="font-medium truncate">{{ $bukti->nama_barang ?? '-' }}</p>
                                        @if($bukti->file_bukti)
                                        <p class="text-xs text-gray-400 mt-0.5">Ada file digital</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="font-medium text-gray-700">{{ $bukti->laporan->kode_tracking ?? '-' }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $bukti->lokasi_simpan ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusColor = match($bukti->status_bukti) {
                                                'Disimpan'     => 'bg-green-100 text-green-800 border-green-200',
                                                'Dipinjam'     => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                'Dipindahkan'  => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'Dimusnahkan'  => 'bg-red-100 text-red-800 border-red-200',
                                                'Dikembalikan' => 'bg-gray-100 text-gray-600 border-gray-200',
                                                default        => 'bg-gray-100 text-gray-600 border-gray-200',
                                            };
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusColor }}">
                                            {{ $bukti->status_bukti ?? 'Disimpan' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $bukti->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center gap-2">
                                            <!-- Edit (PBI #47) -->
                                            <a href="{{ route('admin.bukti.edit', $bukti->id_bukti) }}"
                                                class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Edit Status & Lokasi">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
 

                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex items-center gap-2">
                                            <!-- Edit (PBI #47) -->
                                            <a href="{{ route('admin.bukti.edit', $bukti->id_bukti) }}"
                                                class="p-1.5 text-indigo-600 hover:bg-indigo-50 rounded-lg transition" title="Perbarui Status & Lokasi Bukti">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            @if(Auth::user()->role === 'super_admin')
                                            <!-- Arsipkan placeholder -->
                                            @if(!in_array($bukti->status_bukti, ['Dimusnahkan','Dikembalikan']))
                                            <button onclick="showArchiveModal({{ $bukti->id_bukti }})"
                                                class="p-1.5 text-orange-500 hover:bg-orange-50 rounded-lg transition" title="Arsipkan Bukti">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                                </svg>
                                            </button>
                                            @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                            <p class="text-sm font-medium">Belum ada data bukti fisik</p>
                                            <p class="text-xs mt-1">Silakan tambahkan bukti baru atau sesuaikan filter.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($buktis->hasPages())
                    <div class="px-6 py-4 border-t bg-gray-50">
                        {{ $buktis->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Archive Modal -->
    <div id="archiveModal" onclick="if (event.target.id === 'archiveModal') hideArchiveModal()" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-[100]">
        <div onclick="event.stopImmediatePropagation()" class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b flex items-center justify-between bg-gray-50">
                <h3 class="font-semibold text-gray-900">Arsipkan Bukti Fisik</h3>
                <button onclick="hideArchiveModal()" class="text-2xl leading-none text-gray-400 hover:text-gray-600">×</button>
            </div>
            <form id="archiveForm" method="POST" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div>
                    <label class="text-sm font-medium text-gray-700 block mb-1.5">Status Akhir</label>
                    <select name="status_bukti" class="w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm" required>
                        <option value="Dikembalikan">Dikembalikan</option>
                        <option value="Dimusnahkan">Dimusnahkan</option>
                    </select>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 block mb-1.5">Catatan</label>
                    <textarea name="catatan" class="w-full rounded-xl border-gray-200 px-4 py-2.5 text-sm" rows="3" placeholder="Catatan pengarsipan..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="hideArchiveModal()" class="flex-1 py-3 rounded-xl border text-sm font-medium hover:bg-gray-50">Batal</button>
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-orange-600 text-white text-sm font-medium hover:bg-orange-700">Arsipkan Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showArchiveModal(id) {
            const modal = document.getElementById('archiveModal');
            const form = document.getElementById('archiveForm');
            form.action = '/admin/bukti/' + id + '/archive';
            modal.style.display = 'flex';
        }
        function hideArchiveModal() {
            document.getElementById('archiveModal').style.display = 'none';
        }
    </script>
</body>
</html>
