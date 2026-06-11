<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <aside class="w-72 bg-indigo-900 text-white p-6 flex flex-col">
            <div class="flex items-center gap-3 mb-8">
                <div class="rounded-full bg-white/10 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-wider">Customer Service</p>
                    <p class="text-xs text-indigo-200">Chat Pelapor Anonim</p>
                </div>
            </div>

            <nav class="flex-1 space-y-2">     
                <!-- Menu Manajemen Laporan -->
                <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-3 rounded-lg px-4 py-3 transition 
                        {{ request()->routeIs('admin.dashboard') 
                            ? 'bg-white/10' 
                            : 'hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span class="text-indigo-200">Manajemen Laporan</span>
                </a>

                <!-- Menu Bukti Fisik -->
                <a href="{{ route('admin.bukti.index') }}" 
                class="flex items-center gap-3 rounded-lg px-4 py-3 transition 
                        {{ request()->routeIs('admin.bukti.*') 
                            ? 'bg-white/10' 
                            : 'hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <span class="text-indigo-200">Bukti Fisik</span>
                </a>

                <!-- Menu Customer Service -->
                <a href="{{ route('admin.chat.index') }}" 
                class="flex items-center gap-3 rounded-lg px-4 py-3 transition 
                        {{ request()->routeIs('admin.chat.*') 
                            ? 'bg-white/10' 
                            : 'hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                    </svg>
                    <span class="text-indigo-200">Customer Service</span>
                </a>

                @if(Auth::user()->role === 'super_admin')
                <!-- Menu Kelola User -->
                <a href="{{ route('admin.users.index') }}" 
                class="flex items-center gap-3 rounded-lg px-4 py-3 transition 
                        {{ request()->routeIs('admin.users.*') 
                            ? 'bg-white/10' 
                            : 'hover:bg-white/10' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M7 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-indigo-200">Kelola User</span>
                </a>
                @endif

            </nav>

            <div class="mb-6">
                <p class="text-sm text-indigo-200 mb-2">List Sesi Aktif</p>
                <div id="sessionList" class="space-y-3 overflow-auto max-h-[calc(100vh-250px)]"></div>
            </div>

            <div class="mt-auto border-t border-white/10 pt-4 text-sm text-indigo-200">
                <p class="mb-2">Admin: {{ Auth::user()->name }}</p>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full rounded-lg bg-white/10 px-4 py-3 text-left hover:bg-white/20 transition">Logout</button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Customer Service Dashboard</p>
                    <h1 class="text-2xl font-bold text-gray-900">Kelola Chat Pelapor</h1>
                </div>
                <button id="refreshSessions" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 transition">Refresh Daftar</button>
            </header>

            <div class="flex-1 overflow-hidden p-8">
                <div class="h-full rounded-3xl bg-white shadow-lg overflow-hidden flex flex-col">
                    <div class="border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Sesi yang dipilih</p>
                            <h2 id="selectedSession" class="text-lg font-semibold text-gray-900">Pilih seorang pelapor</h2>
                        </div>
                        <div class="flex items-center gap-3">
                            <button id="deleteSessionButton" type="button" class="hidden rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition">Hapus Sesi</button>
                            <span id="sessionBadge" class="hidden inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-sm font-semibold text-indigo-700"></span>
                        </div>
                    </div>

                    <div class="flex-1 overflow-hidden lg:flex">
                        <div class="hidden lg:block w-80 border-r border-gray-200 bg-slate-50 p-4 overflow-y-auto" id="chatSidebar">
                            <p class="text-sm font-semibold text-gray-600 mb-4">Sesi</p>
                            <div id="sessionSidebarList" class="space-y-3"></div>
                        </div>

                        <div class="flex-1 flex flex-col p-6">
                            <div id="messagesContainer" class="flex-1 space-y-4 overflow-y-auto pr-2"></div>
                            <form id="adminReplyForm" class="mt-6 flex gap-3" onsubmit="return false;">
                                <input id="adminReplyInput" type="text" placeholder="Ketik balasan admin..." class="flex-1 rounded-2xl border border-gray-200 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                <button id="sendAdminReply" class="rounded-2xl bg-indigo-600 px-5 py-3 text-white hover:bg-indigo-700 transition">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        let activeSession = null;
        let chatPollInterval = null;

        async function loadSessions() {
            const response = await fetch('{{ route('admin.chat.sessions') }}');
            const data = await response.json();
            const list = document.getElementById('sessionList');
            const sidebar = document.getElementById('sessionSidebarList');
            list.innerHTML = '';
            sidebar.innerHTML = '';

            if (!data.sessions.length) {
                list.innerHTML = '<p class="text-sm text-indigo-200">Belum ada sesi chat.</p>';
                document.getElementById('selectedSession').textContent = 'Pilih seorang pelapor';
                document.getElementById('sessionBadge').classList.add('hidden');
                return;
            }

            data.sessions.forEach(session => {
                const sessionItem = document.createElement('button');
                sessionItem.type = 'button';
                sessionItem.className = `w-full text-left rounded-2xl px-4 py-3 bg-white/5 hover:bg-white/10 transition ${activeSession === session.session_id ? 'border border-indigo-300 bg-white/10' : ''}`;
                sessionItem.innerHTML = `<div class="flex items-center justify-between"><span class="font-medium">${session.session_id.slice(0, 8)}...</span>${session.unread_count ? `<span class="rounded-full bg-red-500 px-2 py-0.5 text-xs font-semibold text-white">${session.unread_count}</span>` : ''}</div><p class="text-xs text-indigo-200">Terakhir: ${new Date(session.last_activity).toLocaleString('id-ID')}</p>`;
                sessionItem.onclick = () => selectSession(session.session_id);
                list.appendChild(sessionItem);

                const sidebarItem = document.createElement('button');
                sidebarItem.type = 'button';
                sidebarItem.className = `w-full text-left rounded-2xl px-4 py-3 hover:bg-gray-100 transition ${activeSession === session.session_id ? 'bg-gray-100' : 'bg-white'}`;
                sidebarItem.innerHTML = `<div class="flex items-center justify-between"><span class="font-semibold text-gray-900">${session.session_id.slice(0, 8)}...</span>${session.unread_count ? `<span class="rounded-full bg-red-500 px-2 py-0.5 text-xs font-semibold text-white">${session.unread_count}</span>` : ''}</div><p class="text-xs text-gray-500">${new Date(session.last_activity).toLocaleString('id-ID')}</p>`;
                sidebarItem.onclick = () => selectSession(session.session_id);
                sidebar.appendChild(sidebarItem);
            });
        }

        async function selectSession(sessionId) {
            activeSession = sessionId;
            document.getElementById('selectedSession').textContent = `Sesi: ${sessionId}`;
            document.getElementById('sessionBadge').textContent = 'Pesan baru terdeteksi';
            document.getElementById('sessionBadge').classList.remove('hidden');
            document.getElementById('deleteSessionButton').classList.remove('hidden');
            await loadMessages();
            await loadSessions();
            startChatPolling();
        }

        async function loadMessages() {
            if (!activeSession) return;
            const response = await fetch(`/admin/chat/messages?session_id=${encodeURIComponent(activeSession)}`);
            const data = await response.json();
            const container = document.getElementById('messagesContainer');
            container.innerHTML = '';

            if (!data.messages.length) {
                container.innerHTML = '<p class="text-sm text-gray-500">Belum ada pesan di sesi ini.</p>';
            }

            data.messages.forEach(message => {
                const bubble = document.createElement('div');
                bubble.className = message.sender === 'admin' ? 'self-end max-w-[75%] rounded-3xl rounded-br-none bg-indigo-600 px-4 py-3 text-white shadow' : 'self-start max-w-[75%] rounded-3xl rounded-bl-none bg-gray-100 px-4 py-3 text-gray-900 shadow-sm';
                bubble.innerHTML = `
                    <div class="flex ${message.sender === 'admin' ? 'justify-end' : 'justify-between'} items-start gap-3">
                        <div>
                            <div class="text-sm">${message.message}</div>
                            <div class="mt-2 text-xs ${message.sender === 'admin' ? 'text-white/70' : 'text-gray-500'}">${message.sender === 'admin' ? 'Admin' : 'Pelapor'}</div>
                        </div>
                        <button type="button" class="text-xs text-white/70 hover:text-white" onclick="deleteMessage(${message.id_chat})">Hapus</button>
                    </div>
                `;
                container.appendChild(bubble);
            });

            container.scrollTop = container.scrollHeight;
            document.getElementById('sessionBadge').classList.add('hidden');
        }

        async function deleteMessage(messageId) {
            if (!messageId || !activeSession) return;
            if (!confirm('Yakin ingin menghapus pesan ini?')) return;

            await fetch(`/admin/chat/messages/${messageId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            });

            await loadMessages();
            await loadSessions();
        }

        async function deleteSession() {
            if (!activeSession) return;
            if (!confirm('Yakin ingin menghapus sesi chat ini beserta semua pesannya?')) return;

            await fetch(`/admin/chat/sessions/${encodeURIComponent(activeSession)}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            });

            activeSession = null;
            document.getElementById('selectedSession').textContent = 'Pilih seorang pelapor';
            document.getElementById('deleteSessionButton').classList.add('hidden');
            document.getElementById('sessionBadge').classList.add('hidden');
            document.getElementById('messagesContainer').innerHTML = '';
            await loadSessions();
        }

        function startChatPolling() {
            if (chatPollInterval) return;

            chatPollInterval = setInterval(async () => {
                if (!activeSession) {
                    await loadSessions();
                    return;
                }
                await loadMessages();
                await loadSessions();
            }, 2500);
        }

        function stopChatPolling() {
            if (!chatPollInterval) return;
            clearInterval(chatPollInterval);
            chatPollInterval = null;
        }

        document.getElementById('sendAdminReply').addEventListener('click', async () => {
            const input = document.getElementById('adminReplyInput');
            const message = input.value.trim();
            if (!activeSession || !message) return;

            await fetch('{{ route('admin.chat.reply') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ session_id: activeSession, message }),
            });

            input.value = '';
            await loadMessages();
            await loadSessions();
        });

        document.getElementById('deleteSessionButton').addEventListener('click', async () => {
            await deleteSession();
        });

        document.getElementById('refreshSessions').addEventListener('click', async () => {
            await loadSessions();
        });

        loadSessions();
        startChatPolling();
    </script>
</body>
</html>