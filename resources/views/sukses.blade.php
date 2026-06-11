<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Berhasil - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-2xl">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <h1 class="text-3xl font-bold mb-4 text-green-600">Laporan Berhasil Dikirim!</h1>
            <p class="text-lg mb-4">Terima kasih atas laporan Anda. Kami akan memprosesnya segera.</p>
            <p class="text-xl font-semibold mb-6">Kode Tracking Anda adalah: <span class="text-indigo-600">{{ session('kode_tracking') }}</span></p>
            <p class="text-sm text-gray-600 mb-4">Simpan kode ini untuk melacak status laporan Anda.</p>
            <a href="{{ route('track.form') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Lacak Laporan</a>
        </div>
    </div>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Berhasil Dikirim - SpeakUp</title>
    <meta name="description" content="Laporan Anda berhasil dikirim ke SpeakUp. Gunakan kode tracking untuk memantau status laporan.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }

        @keyframes float-in {
            0%   { opacity: 0; transform: translateY(30px) scale(.96); }
            100% { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes check-pop {
            0%   { transform: scale(0); opacity: 0; }
            60%  { transform: scale(1.15); }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes confetti-fall {
            0%   { transform: translateY(-20px) rotate(0deg); opacity: 1; }
            100% { transform: translateY(100px) rotate(720deg); opacity: 0; }
        }
        .card-anim { animation: float-in .5s ease forwards; }
        .check-anim { animation: check-pop .4s .3s ease both; }

        .confetti-piece {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 2px;
            animation: confetti-fall 1.5s ease forwards;
        }

        .kode-box {
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            border: 2px dashed #a5b4fc;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 flex items-center justify-center p-4">

    {{-- Background dots --}}
    <div class="fixed inset-0 opacity-10 pointer-events-none"
         style="background-image: radial-gradient(circle, #818cf8 1px, transparent 1px); background-size: 32px 32px;"></div>

    <div class="card-anim w-full max-w-lg relative">

        {{-- Confetti (dekorasi statis) --}}
        <div class="absolute -top-8 left-1/2 -translate-x-1/2 flex gap-3">
            @foreach(['#f59e0b','#6366f1','#10b981','#ef4444','#3b82f6','#f472b6'] as $c)
            <div class="confetti-piece" style="background:{{ $c }}; animation-delay: {{ $loop->index * 0.1 }}s; animation-duration: {{ 1.2 + $loop->index * 0.15 }}s;"></div>
            @endforeach
        </div>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            {{-- Header hijau --}}
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-8 pt-10 pb-16 text-center relative">
                {{-- Lingkaran check --}}
                <div class="check-anim inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-extrabold text-white">Laporan Berhasil Dikirim!</h1>
                <p class="text-emerald-100 mt-1 text-sm">Terima kasih telah berani bersuara. Kami akan segera memprosesnya.</p>

                {{-- Wave --}}
                <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 60" fill="none" preserveAspectRatio="none">
                    <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z" fill="white"/>
                </svg>
            </div>

            {{-- Body --}}
            <div class="px-8 pb-8 -mt-6 space-y-6">

                {{-- Kode tracking --}}
                @if(session('kode_tracking'))
                <div class="kode-box rounded-2xl p-5 text-center">
                    <p class="text-xs font-semibold text-indigo-500 uppercase tracking-widest mb-2">Kode Tracking Anda</p>
                    <div class="flex items-center justify-center gap-3">
                        <span id="kodeTracking" class="text-3xl font-extrabold text-indigo-700 tracking-widest font-mono">
                            {{ session('kode_tracking') }}
                        </span>
                        <button onclick="copyKode()" title="Salin kode"
                            class="p-2 rounded-lg bg-indigo-100 hover:bg-indigo-200 text-indigo-600 transition">
                            <svg id="iconCopy" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            <svg id="iconCheck" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-indigo-400 mt-2">Simpan kode ini untuk melacak status laporan Anda</p>
                </div>
                @endif

                {{-- Langkah selanjutnya --}}
                <div class="bg-slate-50 rounded-2xl p-5 space-y-3">
                    <p class="text-sm font-semibold text-slate-700">Langkah selanjutnya:</p>
                    <div class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-xs font-bold">1</span>
                        <p class="text-sm text-slate-600">Simpan kode tracking di atas di tempat yang aman.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                        <p class="text-sm text-slate-600">Tim kami akan memverifikasi laporan dalam 1×24 jam.</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                        <p class="text-sm text-slate-600">Gunakan kode tracking untuk memantau perkembangan laporan.</p>
                    </div>
                </div>

                {{-- Tombol aksi --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-1">
                    <a href="{{ route('track.form') }}"
                       class="flex-1 flex items-center justify-center gap-2 bg-indigo-600 text-white font-semibold px-5 py-3 rounded-xl hover:bg-indigo-700 transition text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Lacak Laporan
                    </a>
                    <a href="{{ route('lapor.create') }}"
                       class="flex-1 flex items-center justify-center gap-2 bg-slate-100 text-slate-700 font-semibold px-5 py-3 rounded-xl hover:bg-slate-200 transition text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buat Laporan Baru
                    </a>
                </div>

                <div class="text-center">
                    <a href="/" class="text-xs text-slate-400 hover:text-slate-600 transition">← Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyKode() {
            const kode = document.getElementById('kodeTracking').textContent.trim();
            navigator.clipboard.writeText(kode).then(() => {
                document.getElementById('iconCopy').classList.add('hidden');
                document.getElementById('iconCheck').classList.remove('hidden');
                setTimeout(() => {
                    document.getElementById('iconCopy').classList.remove('hidden');
                    document.getElementById('iconCheck').classList.add('hidden');
                }, 2000);
            });
        }
    </script>
</body>
</html>