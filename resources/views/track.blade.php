<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Laporan - SpeakUp</title>
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
    </header>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8 text-center">Cek Status Laporan</h1>

        @if(!isset($laporan))
        <!-- Search Form -->
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md mb-8">
            <form action="{{ route('track') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <input type="text" name="kode_tracking" id="kode_tracking" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="SU-A1B2C3">
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition duration-300 font-medium">
                    Cari
                </button>
            </form>
        </div>
        @endif

        @if($errors->any())
        <div class="max-w-md mx-auto bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(isset($laporan))
        <!-- Results Area -->
        <div class="max-w-4xl mx-auto">
            <!-- Report Card -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-xl font-semibold">ID Laporan: {{ $laporan->kode_tracking }}</h2>
                        <p class="text-gray-600 mt-1">{{ $laporan->tanggal_kejadian->format('d/m/Y H:i') }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $laporan->status == 'Menunggu Verifikasi' ? 'bg-yellow-100 text-yellow-800' :
                           ($laporan->status == 'Diproses' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                        {{ $laporan->status }}
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-medium text-gray-700 mb-2">Jenis Kejadian</h3>
                        <p>{{ $laporan->jenis_kejadian }}</p>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-700 mb-2">Lokasi</h3>
                        <p>{{ $laporan->lokasi }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="font-medium text-gray-700 mb-2">Deskripsi</h3>
                    <p class="text-gray-600">{{ $laporan->deskripsi }}</p>
                </div>

                {{-- Catatan Admin (PBI terkait) - tampil di halaman tracking user --}}
                @if($laporan->notes && trim($laporan->notes) !== '')
                <div class="mt-6 p-4 bg-amber-50 border border-amber-200 rounded-xl">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-amber-600">📝</span>
                        <h3 class="font-semibold text-amber-800">Catatan dari Admin</h3>
                    </div>
                    <p class="text-amber-700 whitespace-pre-wrap text-sm leading-relaxed">{{ $laporan->notes }}</p>
                    <p class="text-[10px] text-amber-600 mt-2">Catatan ini ditambahkan oleh tim admin untuk informasi lebih lanjut.</p>
                </div>
                @endif
            </div>

            <!-- Timeline -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-lg font-semibold mb-6">Riwayat Status</h3>
                <div class="space-y-4">
                    @php
                        $statusUpdates = $laporan->statusUpdates ?? collect();
                        $statuses = collect([
                            ['status' => 'Menunggu Verifikasi', 'date' => $laporan->created_at, 'description' => 'Laporan diterima dan menunggu verifikasi'],
                            ['status' => 'Diproses', 'date' => null, 'description' => 'Laporan sedang diproses'],
                            ['status' => 'Selesai', 'date' => null, 'description' => 'Laporan telah selesai ditangani']
                        ]);

                        foreach ($statuses as $index => $statusItem) {
                            $update = $statusUpdates->where('status', $statusItem['status'])->first();
                            $isCompleted = $update || ($laporan->status == $statusItem['status']) || ($index == 0);
                            $date = $update ? $update->created_at : ($index == 0 ? $laporan->created_at : null);
                    @endphp

                    <div class="flex items-start space-x-4">
                        <div class="flex flex-col items-center">
                            <div class="w-4 h-4 rounded-full {{ $isCompleted ? 'bg-indigo-600' : 'bg-gray-300' }}"></div>
                            @if($index < $statuses->count() - 1)
                            <div class="w-0.5 h-16 {{ $isCompleted ? 'bg-indigo-600' : 'bg-gray-300' }} mt-2"></div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium {{ $isCompleted ? 'text-gray-900' : 'text-gray-500' }}">
                                    {{ $statusItem['status'] }}
                                </h4>
                                @if($date)
                                <span class="text-sm text-gray-500">{{ $date->format('d/m/Y H:i') }}</span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ $statusItem['description'] }}</p>
                        </div>
                    </div>

                    @php } @endphp
                </div>

                <div class="mt-6">
                    <a href="{{ route('track.form') }}" class="inline-block bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        Cari Laporan Lain
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</body>
</html>