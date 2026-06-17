<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bukti Fisik - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        {{-- ─── SIDEBAR ─────────────────────────────── --}}
            <aside class="w-72 bg-gradient-to-b from-indigo-900 to-indigo-800 text-white flex flex-col shrink-0 shadow-2xl">
                {{-- Logo --}}
                <div class="px-6 py-7 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="rounded-xl bg-white/10 p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-bold text-lg leading-tight">SpeakUp</p>
                            <p class="text-xs text-indigo-300">Admin Panel</p>
                        </div>
                    </div>
                </div>

                {{-- Nav --}}
                <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
                    <!-- Menu Manajemen Laporan -->
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <span>Manajemen Laporan</span>
                        @if(isset($stats['baru_hari_ini']) && $stats['baru_hari_ini'] > 0)
                            <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full badge-new">
                                {{ $stats['baru_hari_ini'] }}
                            </span>
                        @endif
                    </a>

                    <!--MENU KATEGORI LAPORAN -->
                    <a href="{{ route('admin.kategori.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.kategori.*') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <span>Kategori Laporan</span>
                    </a>

                    <!-- Menu Bukti Fisik (dari branch kita) -->
                    <a href="{{ route('admin.bukti.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.bukti.*') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <span>Bukti Fisik</span>
                    </a>

                    <!-- Menu Customer Service -->
                    <a href="{{ route('admin.chat.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.chat.*') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                        </svg>
                        <span>Customer Service</span>
                    </a>

                    <!-- Menu Perbandingan Laporan (dari main) -->
                    <a href="{{ route('admin.perbandingan-laporan') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.perbandingan-laporan') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Perbandingan Laporan</span>
                    </a>

                    @if(Auth::user()->role === 'super_admin')
                    <!-- Menu Kelola User -->
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 rounded-xl px-4 py-3 font-medium transition 
                                {{ request()->routeIs('admin.users.*') ? 'bg-white/15 text-white' : 'text-indigo-200 hover:bg-white/10 hover:text-white' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Kelola User</span>
                    </a>
                    @endif
                </nav>

                {{-- User + Logout --}}
                <div class="px-4 py-5 border-t border-white/10">
                    <div class="flex items-center gap-3 mb-4 px-2">
                        <div class="w-9 h-9 rounded-full bg-indigo-500 flex items-center justify-center text-sm font-bold uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-indigo-300 capitalize">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center gap-3 rounded-xl px-4 py-2.5 text-indigo-200 hover:bg-red-600 hover:text-white transition font-medium text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </aside>
            </header>
            
        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-900">Perbarui Status & Lokasi Bukti</h1>
                    <p class="text-sm text-gray-500 mt-0.5">PBI #47 - Update posisi bukti fisik secara real-time</p>
                </div>
                <a href="{{ route('admin.bukti.index') }}" class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50 transition">
                    ← Kembali ke Daftar Bukti
                </a>
            </header>

            <div class="flex-1 overflow-auto p-8">
                @if($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4 text-red-700">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="max-w-3xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <!-- Header Info -->
                        <div class="px-8 py-6 bg-gradient-to-r from-indigo-50 to-white border-b">
                            <div class="flex items-start justify-between">
                                <div>
                                    <div class="text-xs uppercase tracking-widest text-indigo-600 font-semibold">ID Bukti #{{ $bukti->id_bukti }}</div>
                                    <div class="text-2xl font-bold text-gray-900 mt-1">{{ $bukti->nama_barang }}</div>
                                    <div class="text-sm text-gray-500 mt-1">Kasus: <span class="font-mono font-medium text-indigo-600">{{ $bukti->laporan->kode_tracking ?? 'N/A' }}</span></div>
                                </div>
                                <div class="text-right">
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border {{ $bukti->status_bukti === 'Disimpan' ? 'bg-green-100 text-green-700 border-green-200' : 'bg-yellow-100 text-yellow-700 border-yellow-200' }}">
                                        Status Saat Ini: {{ $bukti->status_bukti }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('admin.bukti.update', $bukti->id_bukti) }}" method="POST" class="p-8 space-y-8">
                            @csrf
                            @method('PUT')

                            <!-- Readonly Info -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 tracking-wider mb-1.5">JENIS KEJADIAN</label>
                                    <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700">{{ $bukti->laporan->jenis_kejadian ?? '-' }}</div>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-500 tracking-wider mb-1.5">TANGGAL MASUK</label>
                                    <div class="px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700">{{ $bukti->created_at->format('d F Y H:i') }}</div>
                                </div>
                            </div>

                            <!-- Editable Fields for PBI #47 -->
                            <div class="border-t pt-8">
                                <h3 class="text-sm font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                    <span class="inline-block w-2 h-2 bg-indigo-600 rounded-full"></span>
                                    PERBARUI STATUS & LOKASI (WAJIB DIISI)
                                </h3>
                                
                                {{-- Tampilkan File yang Sudah Ada --}}
                                @if($bukti->file_bukti)
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">File Saat Ini</label>

                                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-2xl">
                                        <div class="flex flex-col md:flex-row items-start gap-4">
                                            
                                            {{-- Preview Gambar --}}
                                            @if($bukti->tipe_file && str_contains($bukti->tipe_file, 'image'))
                                                <div>
                                                    <img src="{{ Storage::url($bukti->file_bukti) }}" 
                                                        alt="Current File"
                                                        class="max-h-48 rounded-xl border border-gray-200 shadow-sm object-contain"
                                                        onerror="this.style.display='none'">
                                                </div>
                                            @else
                                                {{-- Non-Image File --}}
                                                <div class="flex items-center gap-3 p-3 bg-white border rounded-xl">
                                                    <div class="p-3 bg-gray-100 rounded-xl">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-sm font-medium text-gray-800 break-all">
                                                            {{ basename($bukti->file_bukti) }}
                                                        </p>
                                                        <p class="text-xs text-gray-500">{{ $bukti->tipe_file ?? 'Unknown' }}</p>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="flex-1">
                                                <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 mb-2">
                                                    File sudah tersimpan
                                                </div>
                                                <p class="text-xs text-orange-600">
                                                    Upload file baru di bawah jika ingin mengganti file ini.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Status -->
                                    <div>
                                        <label for="status_bukti" class="block text-sm font-medium text-gray-700 mb-1.5">Status Bukti Saat Ini <span class="text-red-500">*</span></label>
                                        <select name="status_bukti" id="status_bukti" required class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-xl px-4 py-3 text-sm">
                                            @foreach(['Disimpan', 'Dipinjam', 'Dipindahkan', 'Dimusnahkan', 'Dikembalikan'] as $status)
                                                <option value="{{ $status }}" {{ $bukti->status_bukti == $status ? 'selected' : '' }}>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                        <p class="mt-1.5 text-xs text-gray-500">Pilih status terkini bukti (misal: Dipinjam untuk penyidikan)</p>
                                    </div>

                                    <!-- Lokasi -->
                                    <div>
                                        <label for="lokasi_simpan" class="block text-sm font-medium text-gray-700 mb-1.5">Lokasi Penyimpanan <span class="text-red-500">*</span></label>
                                        <input type="text" name="lokasi_simpan" id="lokasi_simpan" value="{{ old('lokasi_simpan', $bukti->lokasi_simpan) }}" required
                                            class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-xl px-4 py-3 text-sm"
                                            placeholder="Contoh: Ruang Arsip A - Rak 3">
                                        <p class="mt-1.5 text-xs text-gray-500">Update lokasi jika bukti dipindahkan antar ruang</p>
                                    </div>
                                </div>

                                <!-- Ganti File Bukti (Opsional) -->
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Ganti File Bukti <span class="text-gray-400">(opsional)</span>
                                    </label>

                                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-5 text-center hover:border-indigo-400 transition">
                                        <input type="file" name="file_bukti" id="file_bukti" class="hidden"
                                            accept="image/*,.pdf,.mp4,.mov">

                                        <div onclick="document.getElementById('file_bukti').click()" class="cursor-pointer">
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium text-indigo-600">Klik untuk ganti file</span>
                                            </p>
                                            <p class="text-xs text-gray-400 mt-1">JPG, PNG, PDF, MP4, MOV — Maks 20MB</p>
                                        </div>

                                        <!-- Preview File Baru -->
                                        <div id="newFilePreview" class="hidden mt-4 flex flex-col items-center">
                                            <img id="newPreviewImg" class="max-h-32 rounded-lg border mb-2" alt="Preview Baru">
                                            <p id="newFileName" class="text-sm text-gray-700 font-medium"></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Catatan -->
                                <div class="mt-6">
                                    <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1.5">Catatan / Riwayat Perubahan</label>
                                    <textarea name="catatan" id="catatan" rows="4" class="w-full border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 rounded-2xl px-4 py-3 text-sm"
                                        placeholder="Contoh: Dipinjam oleh penyidik pada 08/06/2026 untuk keperluan visum et repertum. Akan dikembalikan setelah 3 hari.">{{ old('catatan', $bukti->catatan) }}</textarea>
                                    <p class="mt-1.5 text-xs text-gray-500">Catat alasan perubahan status/lokasi agar selalu terlacak (audit trail)</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-4 pt-4 border-t">
                                <a href="{{ route('admin.bukti.index') }}" class="px-6 py-3 text-sm font-medium text-gray-600 hover:text-gray-800 transition">Batal</a>
                                <button type="submit" dusk="btn-update-bukti" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 transition text-white text-sm font-semibold rounded-2xl shadow-sm flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7"/>
                                    </svg>
                                    SIMPAN PERUBAHAN STATUS & LOKASI
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-6 text-center">
                        <p class="text-xs text-gray-400">Perubahan status & lokasi akan tercatat secara otomatis untuk keperluan audit dan pelacakan bukti fisik.</p>
                    </div>
                    <script>
                        const newFileInput = document.getElementById('file_bukti');
                        const newPreviewContainer = document.getElementById('newFilePreview');
                        const newPreviewImg = document.getElementById('newPreviewImg');
                        const newFileName = document.getElementById('newFileName');

                        if (newFileInput) {
                            newFileInput.addEventListener('change', function() {
                                const file = this.files[0];
                                if (!file) return;

                                newFileName.textContent = file.name;

                                if (file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = e => {
                                        newPreviewImg.src = e.target.result;
                                        newPreviewContainer.classList.remove('hidden');
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    newPreviewImg.src = '';
                                    newPreviewContainer.classList.remove('hidden');
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
