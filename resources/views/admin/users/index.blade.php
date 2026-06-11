<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - SpeakUp</title>
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
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Halo, {{ Auth::user()->name }}</p>
                    <h1 class="text-2xl font-bold text-gray-900">Kelola User</h1>
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
                @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4 text-red-700">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Form Tambah User -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Tambah Admin Baru</h3>
                            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                                    <input type="text" name="name" required value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" required value="{{ old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                                    <input type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    @error('password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Peran</label>
                                    <select name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                        <option value="">-- Pilih Peran --</option>
                                        <option value="admin">Admin</option>
                                        <option value="super_admin">Super Admin</option>
                                    </select>
                                    @error('role') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition font-medium">
                                    Tambah User
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Daftar User -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="border-b border-gray-200 px-8 py-6 flex items-center justify-between">
                                <h2 class="text-2xl font-bold text-gray-900">Daftar Admin</h2>
                                <div class="text-right">
                                    <p class="text-sm text-gray-600">Total Admin</p>
                                    <p class="text-3xl font-bold text-indigo-600">{{ count($users) }}</p>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 border-b border-gray-200">
                                        <tr>
                                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Peran</th>
                                            <th class="px-8 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @forelse($users as $user)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-8 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $user->name }}
                                                @if($user->id === Auth::id()) <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Anda</span> @endif
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-600">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap">
                                                @if($user->id !== Auth::id())
                                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select name="role" onchange="this.form.submit()" class="text-sm px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent cursor-pointer">
                                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="super_admin" {{ $user->role === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                                    </select>
                                                </form>
                                                @else
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">{{ ucfirst($user->role) }} (Anda)</span>
                                                @endif
                                            </td>
                                            <td class="px-8 py-4 whitespace-nowrap text-sm space-x-2">
                                                @if($user->id !== Auth::id())
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 transition">Hapus</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="px-8 py-12 text-center text-gray-500">
                                                Tidak ada admin terdaftar
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
