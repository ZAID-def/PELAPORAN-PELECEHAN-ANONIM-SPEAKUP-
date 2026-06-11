<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bukti Fisik - SpeakUp</title>
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
                    <h1 class="text-2xl font-bold text-gray-900">Tambah Bukti Fisik Baru</h1>
                </div>
                <a href="{{ route('admin.bukti.index') }}" class="flex items-center gap-2 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </header>

            <div class="flex-1 overflow-auto p-8">
                @if($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4 text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="bg-white rounded-lg shadow-md p-8 max-w-2xl">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                        <div class="p-2 bg-indigo-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">Pendaftaran Bukti Fisik</h2>
                            <p class="text-sm text-gray-500">Isi semua data bukti fisik dengan lengkap dan akurat</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.bukti.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf

                        <!-- ID Kasus -->
                        <div>
                            <label for="id_laporan" class="block text-sm font-medium text-gray-700 mb-1">
                                ID Kasus <span class="text-red-500">*</span>
                            </label>
                            <select name="id_laporan" id="id_laporan" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('id_laporan') border-red-400 @enderror">
                                <option value="">-- Pilih Kasus --</option>
                                @foreach($laporans as $laporan)
                                    <option value="{{ $laporan->id_laporan }}" {{ old('id_laporan') == $laporan->id_laporan ? 'selected' : '' }}>
                                        {{ $laporan->kode_tracking }} — {{ $laporan->jenis_kejadian }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_laporan')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Barang Bukti -->
                        <div>
                            <label for="nama_barang" class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Barang Bukti <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_barang" id="nama_barang"
                                value="{{ old('nama_barang') }}"
                                placeholder="Contoh: Ponsel Samsung Galaxy A12 warna hitam"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('nama_barang') border-red-400 @enderror"
                                required>
                            @error('nama_barang')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi Simpan -->
                        <div>
                            <label for="lokasi_simpan" class="block text-sm font-medium text-gray-700 mb-1">
                                Lokasi Simpan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="lokasi_simpan" id="lokasi_simpan"
                                value="{{ old('lokasi_simpan') }}"
                                placeholder="Contoh: Ruang Arsip A, Lemari 3, Rak 2"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('lokasi_simpan') border-red-400 @enderror"
                                required>
                            @error('lokasi_simpan')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Bukti Digital -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                File Bukti Digital <span class="text-gray-400">(opsional)</span>
                            </label>

                            <!-- Area Upload dengan Preview di Dalam -->
                            <div id="uploadArea"
                                class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-indigo-400 transition cursor-pointer bg-white">

                                <!-- Default State (belum ada file) -->
                                <div id="uploadDefault">
                                    <div class="flex justify-center mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        <span class="font-medium text-indigo-600">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, PDF, MP4, MOV — Maks. 20MB</p>
                                </div>

                                <!-- Preview State (saat ada gambar) -->
                                <div id="uploadPreview" class="hidden flex flex-col items-center">
                                    <img id="previewImage" class="max-h-40 rounded-lg shadow-sm border mb-3" alt="Preview">
                                    <p id="fileName" class="text-sm font-medium text-gray-700 break-all"></p>
                                    <button type="button" onclick="removePreview()"
                                            class="mt-2 text-xs text-red-500 hover:text-red-600 flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6h12v12"/>
                                        </svg>
                                        Hapus file
                                    </button>
                                </div>

                                <input type="file" name="file_bukti" id="file_bukti" class="hidden"
                                    accept="image/*,.pdf,.mp4,.mov">
                            </div>
                        </div>

                        <script>
                            const uploadArea = document.getElementById('uploadArea');
                            const fileInput = document.getElementById('file_bukti');
                            const uploadDefault = document.getElementById('uploadDefault');
                            const uploadPreview = document.getElementById('uploadPreview');
                            const previewImage = document.getElementById('previewImage');
                            const fileNameText = document.getElementById('fileName');

                            // Klik area upload → buka file picker
                            uploadArea.addEventListener('click', () => {
                                fileInput.click();
                            });

                            // Saat file dipilih
                            fileInput.addEventListener('change', function() {
                                const file = this.files[0];
                                if (!file) return;

                                // Tampilkan preview jika gambar
                                if (file.type.startsWith('image/')) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        previewImage.src = e.target.result;
                                        fileNameText.textContent = file.name;
                                        uploadDefault.classList.add('hidden');
                                        uploadPreview.classList.remove('hidden');
                                    }
                                    reader.readAsDataURL(file);
                                } else {
                                    // Untuk non-gambar (PDF, video, dll)
                                    fileNameText.textContent = file.name;
                                    previewImage.src = ''; // kosongkan preview
                                    uploadDefault.classList.add('hidden');
                                    uploadPreview.classList.remove('hidden');
                                }
                            });

                            // Fungsi hapus preview
                            function removePreview() {
                                fileInput.value = '';
                                uploadPreview.classList.add('hidden');
                                uploadDefault.classList.remove('hidden');
                            }
                        </script>
                        
                        <!-- Catatan -->
                        <div>
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">
                                Catatan <span class="text-gray-400 text-xs">(opsional)</span>
                            </label>
                            <textarea name="catatan" id="catatan" rows="3"
                                placeholder="Tambahkan catatan kondisi barang, cara penerimaan, dll."
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('catatan') }}</textarea>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit" class="flex items-center gap-2 bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Daftarkan Bukti
                            </button>
                            <a href="{{ route('admin.bukti.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</body>
</html>