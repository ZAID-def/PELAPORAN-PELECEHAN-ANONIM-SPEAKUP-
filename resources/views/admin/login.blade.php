<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-50 relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
    </div>

    <header class="w-full bg-indigo-900">
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

    <!-- Main container -->
    <div class="relative w-full max-w-md mt-8 mx-auto px-4">
        <!-- Login card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden backdrop-blur-xl border border-white/20">
            <!-- Header section -->
            <div class="bg-gradient-to-r from-indigo-900 via-indigo-800 to-purple-900 p-8 text-center">
                <div class="flex justify-center mb-4">
                    <div class="rounded-full bg-white/10 p-4 backdrop-blur-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m7 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Login Admin SpeakUp</h1>
                <p class="text-sm text-indigo-200">Masukkan kredensial admin Anda untuk melanjutkan</p>
            </div>

            <!-- Form section -->
            <div class="p-8">
                @if($errors->any())
                    <div class="mb-6 rounded-xl bg-red-50 border-l-4 border-red-500 p-4">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600 mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <h3 class="font-semibold text-red-800 mb-2">Terjadi kesalahan:</h3>
                                <ul class="space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li class="text-sm text-red-700">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <!-- Email input -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-800 mb-2">Email</label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email') }}" 
                                required 
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:outline-none transition bg-gray-50 hover:bg-white @error('email') border-red-500 @enderror" 
                                placeholder="admin@kampus.ac.id"
                            >
                        </div>
                        @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Password input -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-800 mb-2">Password</label>
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <input 
                                type="password" 
                                name="password" 
                                id="password" 
                                required 
                                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:border-indigo-500 focus:outline-none transition bg-gray-50 hover:bg-white @error('password') border-red-500 @enderror" 
                                placeholder="••••••••"
                            >
                        </div>
                        @error('password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Submit button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg font-semibold text-lg hover:shadow-lg hover:from-indigo-700 hover:to-purple-700 transition transform hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2 mt-6"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Masuk
                    </button>

                    <!-- Info text -->
                    <p class="text-center text-xs text-gray-500 mt-4">
                        *Hanya untuk Admin Kampus dan Super Admin.
                    </p>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Kembali ke 
                <a href="/" class="font-semibold text-indigo-600 hover:text-indigo-700 transition">beranda</a>
            </p>
        </div>
    </div>
</body>
</html>
