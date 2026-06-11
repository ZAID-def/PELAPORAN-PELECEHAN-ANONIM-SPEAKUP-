<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Jenis Kejadian - SpeakUp Admin</title>
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

                <a href="{{ route('admin.chat.index') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-white/10 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                    </svg>
                    <span>Customer Service</span>
                </a>

                <!-- Kategori Kejadian - Active -->
                <a href="{{ route('admin.kategori.create') }}" class="flex items-center gap-3 rounded-lg bg-white/10 px-4 py-3 text-white hover:bg-white/20 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span>Kategori Kejadian</span>
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
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-900">Kategori Jenis Kejadian</h1>
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

            <!-- Content -->
            <div class="flex-1 overflow-auto p-8">

                {{-- Alert Sukses --}}
                @if(session('success'))
                <div id="alert-success" class="mb-6 flex items-start gap-3 rounded-xl bg-green-50 border border-green-200 p-4 text-green-700 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="flex-1">
                        <p class="font-medium">Berhasil!</p>
                        <p class="text-sm text-green-600">{{ session('success') }}</p>
                    </div>
                    <button onclick="document.getElementById('alert-success').remove()" class="text-green-400 hover:text-green-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif

                {{-- Alert Error --}}
                @if($errors->any())
                <div class="mb-6 flex items-start gap-3 rounded-xl bg-red-50 border border-red-200 p-4 text-red-700 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="font-medium">Ada kesalahan pada form!</p>
                        <ul class="mt-1 text-sm text-red-600 list-disc list-inside space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Form Card -->
                <div class="max-w-2xl mx-auto">
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                        <!-- Card Header -->
                        <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 px-8 py-6">
                            <div class="flex items-center gap-3">
                                <div class="bg-white/20 rounded-xl p-2.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-white">Tambah Kategori Baru</h2>
                                    <p class="text-indigo-200 text-sm">Tambahkan jenis kejadian yang akan tampil di halaman lapor</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Body -->
                        <form action="{{ route('admin.kategori.store') }}" method="POST" id="form-kategori">
                            @csrf
                            <div class="px-8 py-6 space-y-6">

                                <!-- Nama Kategori -->
                                <div>
                                    <label for="nama_kategori" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                        Nama Kategori <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="text"
                                            name="nama_kategori"
                                            id="nama_kategori"
                                            value="{{ old('nama_kategori') }}"
                                            placeholder="Contoh: Pelecehan Seksual"
                                            maxlength="255"
                                            required
                                            class="w-full pl-10 pr-4 py-3 border @error('nama_kategori') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition"
                                        >
                                    </div>
                                    @error('nama_kategori')
                                        <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <p class="mt-1 text-xs text-gray-500">Nama ini akan tampil sebagai pilihan di dropdown form lapor.</p>
                                </div>

                                <!-- Deskripsi -->
                                <div>
                                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                        Deskripsi <span class="text-gray-400 font-normal">(opsional)</span>
                                    </label>
                                    <div class="relative">
                                        <textarea
                                            name="deskripsi"
                                            id="deskripsi"
                                            rows="4"
                                            maxlength="500"
                                            placeholder="Jelaskan secara singkat tentang kategori kejadian ini..."
                                            class="w-full px-4 py-3 border @error('deskripsi') border-red-400 bg-red-50 @else border-gray-300 @enderror rounded-xl text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition resize-none"
                                        >{{ old('deskripsi') }}</textarea>
                                    </div>
                                    <div class="flex items-center justify-between mt-1">
                                        @error('deskripsi')
                                            <p class="text-sm text-red-600 flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @else
                                            <span></span>
                                        @enderror
                                        <p class="text-xs text-gray-400" id="char-count">0 / 500</p>
                                    </div>
                                </div>

                                <!-- Status Aktif -->
                                <div class="flex items-start gap-4 bg-indigo-50 rounded-xl p-4 border border-indigo-100">
                                    <div class="flex items-center h-5 mt-0.5">
                                        <input
                                            type="checkbox"
                                            name="is_active"
                                            id="is_active"
                                            value="1"
                                            {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                                            class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer"
                                        >
                                    </div>
                                    <div>
                                        <label for="is_active" class="text-sm font-semibold text-gray-800 cursor-pointer">Aktifkan Kategori</label>
                                        <p class="text-xs text-gray-500 mt-0.5">Jika dicentang, kategori ini akan langsung tampil sebagai pilihan di halaman lapor.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- Form Footer -->
                            <div class="px-8 py-5 bg-gray-50 border-t border-gray-200 flex items-center justify-between gap-3">
                                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition text-sm font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                    </svg>
                                    Kembali
                                </a>
                                <button
                                    type="submit"
                                    id="btn-submit"
                                    class="flex items-center gap-2 px-6 py-2.5 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 active:bg-indigo-800 transition text-sm font-semibold shadow-sm hover:shadow-md"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                    Tambah Kategori
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Info tip -->
                    <div class="mt-5 flex items-start gap-3 bg-amber-50 border border-amber-200 rounded-xl p-4 text-amber-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-0.5 flex-shrink-0 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm">
                            <span class="font-semibold">Catatan:</span> Kategori yang ditambahkan akan muncul sebagai opsi pada dropdown <strong>Jenis Kejadian</strong> di halaman lapor anonim.
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Character counter for deskripsi
        const textarea = document.getElementById('deskripsi');
        const charCount = document.getElementById('char-count');

        function updateCharCount() {
            const length = textarea.value.length;
            charCount.textContent = length + ' / 500';
            charCount.className = length > 450
                ? 'text-xs text-orange-500'
                : length >= 500
                    ? 'text-xs text-red-500'
                    : 'text-xs text-gray-400';
        }

        textarea.addEventListener('input', updateCharCount);
        updateCharCount(); // init on load

        // Prevent double submit
        const form = document.getElementById('form-kategori');
        const btnSubmit = document.getElementById('btn-submit');
        form.addEventListener('submit', function () {
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = `
                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                Menyimpan...
            `;
            btnSubmit.classList.add('opacity-75', 'cursor-not-allowed');
        });
    </script>
</body>
</html>
