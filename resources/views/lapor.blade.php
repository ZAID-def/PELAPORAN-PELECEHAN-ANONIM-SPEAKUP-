<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor Anonim - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-indigo-900">
        <div class="container mx-auto px-4 py-5 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 text-white">
                <div class="rounded-full bg-white/10 p-2 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.761 0 5-2.686 5-6S14.761-1 12-1 7 1.686 7 5s2.239 6 5 6zM3 21c0-3.313 2.687-6 6-6h6c3.313 0 6 2.687 6 6" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-300">SpeakUp</p>
                    <p class="text-xs text-slate-400">Lapor Pelecehan & Diskriminasi</p>
                </div>
            </a>
            <nav class="flex items-center gap-3">
                <a href="{{ route('track.form') }}" class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm text-white hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Cek Status
                </a>
                <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-sm font-semibold text-indigo-900 hover:bg-slate-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z"/></svg>
                    Admin
                </a>
            </nav>
        </div>
    <main class="container mx-auto px-4 py-10">
        <div class="max-w-3xl mx-auto text-center mb-10">
            <h1 class="text-4xl font-bold text-slate-900">Lapor Anonim</h1>
            <p class="text-lg text-slate-600 mt-3">Ruang Aman untuk Bersuara</p>
        </div>

        <!-- Form -->
        <div class="bg-white p-8 rounded-lg shadow-md">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Data Belum Lengkap!</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label for="jenis_kejadian" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kejadian</label>
                    <select name="jenis_kejadian" id="jenis_kejadian" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Pilih Jenis Kejadian</option>
                        @forelse($kategoris as $kategori)
                            <option value="{{ $kategori->nama_kategori }}" {{ old('jenis_kejadian') == $kategori->nama_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @empty
                            <option value="" disabled>Belum ada kategori tersedia</option>
                        @endforelse
                        <option value="Pelecehan Seksual">Pelecehan Seksual</option>
                        <option value="Kekerasan Fisik">Kekerasan Fisik</option>
                        <option value="Kekerasan Verbal">Kekerasan Verbal</option>
                        <option value="Diskriminasi">Diskriminasi</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label for="tanggal_kejadian" class="block text-sm font-medium text-gray-700 mb-2">Waktu Kejadian</label>
                    <input type="datetime-local" name="tanggal_kejadian" id="tanggal_kejadian" max="{{ now()->format('Y-m-d\TH:i') }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="datetime-local" name="tanggal_kejadian" id="tanggal_kejadian" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                    <input type="tel" name="phone" id="phone" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="tel" name="phone" id="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="bukti" class="block text-sm font-medium text-gray-700 mb-2">Upload Bukti</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-md p-4 text-center hover:border-indigo-500 transition-colors">
                        <input type="file" name="bukti" id="bukti" accept=".jpg,.jpeg,.png,.pdf" class="hidden" onchange="updateFileName(this)">
                        <label for="bukti" class="cursor-pointer">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 mb-2" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <p>Klik untuk upload bukti</p>
                                <p class="text-sm">Format: JPG, PNG, PDF. Maksimal 2MB</p>
                            </div>
                        </label>
                        <div id="file-name" class="mt-2 text-sm text-indigo-600 hidden"></div>
                    <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-indigo-500 hover:bg-indigo-50/30 transition-all duration-300 relative">
                        <input type="file" name="bukti" id="bukti" accept=".jpg,.jpeg,.png,.pdf" class="hidden" onchange="handleFileSelect(this)">

                        <!-- Estado inicial: zona de upload -->
                        <label for="bukti" id="upload-placeholder" class="cursor-pointer block">
                            <div class="text-gray-400">
                                <svg class="mx-auto h-12 w-12 mb-3" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <p class="text-gray-600 font-medium">Klik untuk upload bukti</p>
                                <p class="text-sm text-gray-400 mt-1">Format: JPG, PNG, PDF. Maksimal 2MB</p>
                            </div>
                        </label>

                        <!-- Estado con archivo: preview card -->
                        <div id="file-preview" class="hidden">
                            <div class="flex items-center gap-4 bg-white border border-gray-200 rounded-lg p-3 shadow-sm text-left">
                                <!-- Thumbnail / Ikon -->
                                <div id="file-thumbnail" class="flex-shrink-0 w-14 h-14 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center border border-gray-200">
                                    <!-- Diisi oleh JavaScript -->
                                </div>

                                <!-- Info File -->
                                <div class="flex-1 min-w-0">
                                    <p id="file-display-name" class="text-sm font-semibold text-gray-800 truncate" title=""></p>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        <span id="file-type-badge" class="inline-block bg-indigo-100 text-indigo-700 font-semibold px-1.5 py-0.5 rounded text-[10px] uppercase tracking-wide"></span>
                                        <span class="mx-1 text-gray-300">•</span>
                                        <span id="file-size-display" class="text-gray-500"></span>
                                    </p>
                                    <label for="bukti" class="inline-flex items-center gap-1 text-xs text-indigo-600 hover:text-indigo-800 cursor-pointer mt-1 font-medium transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5m0 0l5 5m-5-5v12"/></svg>
                                        Ganti file
                                    </label>
                                </div>

                                <!-- Tombol Hapus -->
                                <button type="button" onclick="removeFile()" class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600 transition-all duration-200" title="Hapus file">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Error message -->
                        <div id="file-error" class="hidden mt-3">
                            <div class="inline-flex items-center gap-2 bg-red-50 border border-red-200 text-red-600 text-sm rounded-lg px-4 py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span id="file-error-text"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-300 font-medium">
                    Kirim Laporan
                </button>
            </form>
        </div>
    </div>

    <script>
        function updateFileName(input) {
            const fileName = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileName.textContent = 'File dipilih: ' + input.files[0].name;
                fileName.classList.remove('hidden');
            } else {
                fileName.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
</body>
        const ALLOWED_TYPES = ['image/jpeg', 'image/png', 'application/pdf'];
        const MAX_SIZE = 2 * 1024 * 1024; // 2MB

        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        }

        function getFileExtension(name) {
            return name.split('.').pop().toUpperCase();
        }

        function handleFileSelect(input) {
            const errorEl = document.getElementById('file-error');
            const errorText = document.getElementById('file-error-text');
            const placeholder = document.getElementById('upload-placeholder');
            const preview = document.getElementById('file-preview');
            const uploadArea = document.getElementById('upload-area');

            // Sembunyikan error sebelumnya
            errorEl.classList.add('hidden');

            if (!input.files || !input.files[0]) {
                return;
            }

            const file = input.files[0];

            // Validasi tipe file
            if (!ALLOWED_TYPES.includes(file.type)) {
                showError('Format file tidak didukung. Gunakan JPG, PNG, atau PDF.');
                input.value = '';
                return;
            }

            // Validasi ukuran file
            if (file.size > MAX_SIZE) {
                showError('Ukuran file terlalu besar. Maksimal 2MB (file Anda: ' + formatFileSize(file.size) + ').');
                input.value = '';
                return;
            }

            // Tampilkan preview
            showPreview(file);
        }

        function showError(message) {
            const errorEl = document.getElementById('file-error');
            const errorText = document.getElementById('file-error-text');
            const placeholder = document.getElementById('upload-placeholder');
            const preview = document.getElementById('file-preview');

            errorText.textContent = message;
            errorEl.classList.remove('hidden');
            placeholder.classList.remove('hidden');
            preview.classList.add('hidden');
        }

        function showPreview(file) {
            const placeholder = document.getElementById('upload-placeholder');
            const preview = document.getElementById('file-preview');
            const thumbnail = document.getElementById('file-thumbnail');
            const nameEl = document.getElementById('file-display-name');
            const typeEl = document.getElementById('file-type-badge');
            const sizeEl = document.getElementById('file-size-display');
            const uploadArea = document.getElementById('upload-area');
            const errorEl = document.getElementById('file-error');

            // Sembunyikan placeholder & error, tampilkan preview
            placeholder.classList.add('hidden');
            errorEl.classList.add('hidden');
            preview.classList.remove('hidden');

            // Update border style saat file ada
            uploadArea.classList.remove('border-dashed', 'border-gray-300');
            uploadArea.classList.add('border-solid', 'border-indigo-200', 'bg-indigo-50/20');

            // Nama file
            nameEl.textContent = file.name;
            nameEl.title = file.name;

            // Tipe file
            const ext = getFileExtension(file.name);
            typeEl.textContent = ext;

            // Ukuran file
            sizeEl.textContent = formatFileSize(file.size);

            // Thumbnail
            thumbnail.innerHTML = '';
            if (file.type.startsWith('image/')) {
                // Gambar: tampilkan thumbnail
                const img = document.createElement('img');
                img.classList.add('w-full', 'h-full', 'object-cover');
                img.alt = file.name;
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
                thumbnail.appendChild(img);
            } else {
                // PDF: tampilkan ikon
                thumbnail.innerHTML = `
                    <div class="flex flex-col items-center justify-center w-full h-full bg-red-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9l-5-5H7a2 2 0 00-2 2v13a2 2 0 002 2z"/>
                            <polyline points="13 3 13 9 19 9" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="text-[9px] font-bold text-red-500 mt-0.5">PDF</span>
                    </div>
                `;
            }
        }

        function removeFile() {
            const input = document.getElementById('bukti');
            const placeholder = document.getElementById('upload-placeholder');
            const preview = document.getElementById('file-preview');
            const uploadArea = document.getElementById('upload-area');
            const errorEl = document.getElementById('file-error');

            // Reset input file
            input.value = '';

            // Kembalikan tampilan ke kondisi awal
            placeholder.classList.remove('hidden');
            preview.classList.add('hidden');
            errorEl.classList.add('hidden');

            // Kembalikan border style
            uploadArea.classList.add('border-dashed', 'border-gray-300');
            uploadArea.classList.remove('border-solid', 'border-indigo-200', 'bg-indigo-50/20');
        }
    </script>
</body>
</html>