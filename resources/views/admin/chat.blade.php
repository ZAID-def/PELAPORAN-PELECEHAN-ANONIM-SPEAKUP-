<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - SpeakUp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bubble-admin {
            align-self: flex-end;
            background-color: #4f46e5;
            color: white;
            border-radius: 1.5rem 1.5rem 0 1.5rem;
        }
        .bubble-user {
            align-self: flex-start;
            background-color: #f3f4f6;
            color: #111827;
            border-radius: 1.5rem 1.5rem 1.5rem 0;
        }
        #messagesContainer {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
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

            <nav class="mb-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-white/10 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span>Manajemen Laporan</span>
                </a>

                <a href="{{ route('admin.chat.index') }}" class="flex items-center gap-3 rounded-lg bg-white/10 px-4 py-3 text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                    </svg>
                    <span>Customer Service</span>
                </a>

                <a href="{{ route('admin.perbandingan-laporan') }}" class="flex items-center gap-3 rounded-lg px-4 py-3 text-indigo-200 hover:bg-white/10 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Perbandingan Laporan</span>
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

            <div class="mb-6 flex-1 flex flex-col min-h-0">
                <p class="text-sm text-indigo-200 mb-2">List Sesi Aktif</p>
                <div id="sessionList" class="space-y-2 overflow-y-auto flex-1"></div>
            </div>

            <div class="border-t border-white/10 pt-4 text-sm text-indigo-200">
                <p class="mb-2">Admin: {{ Auth::user()->name }}</p>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full rounded-lg bg-white/10 px-4 py-3 text-left hover:bg-white/20 transition">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white border-b border-gray-200 px-8 py-5 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Customer Service Dashboard</p>
                    <h1 class="text-2xl font-bold text-gray-900">Kelola Chat Pelapor</h1>
                </div>
                <button id="refreshSessions" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Refresh Daftar
                </button>
            </header>

            <div class="flex-1 overflow-hidden p-8">
                <div class="h-full rounded-3xl bg-white shadow-lg overflow-hidden flex flex-col">

                    <!-- Chat header -->
                    <div class="border-b border-gray-200 px-6 py-4 flex items-center justify-between bg-gray-50">
                        <div class="flex items-center gap-3">
                            <div id="sessionAvatar" class="hidden h-9 w-9 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-bold">
                                P
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Sesi yang dipilih</p>
                                <h2 id="selectedSession" class="text-base font-semibold text-gray-900">Pilih seorang pelapor dari sidebar</h2>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span id="sessionBadge" class="hidden items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                <span class="h-2 w-2 rounded-full bg-green-500 inline-block animate-pulse"></span>
                                Sesi Aktif
                            </span>
                            <button id="deleteSessionButton" type="button" class="hidden rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-100 transition">
                                Hapus Sesi
                            </button>
                        </div>
                    </div>

                    <div class="flex-1 overflow-hidden lg:flex">
                        <!-- Sidebar session list (desktop) -->
                        <div class="hidden lg:flex lg:flex-col w-72 border-r border-gray-200 bg-slate-50">
                            <div class="p-4 border-b border-gray-200">
                                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Sesi Chat</p>
                            </div>
                            <div id="sessionSidebarList" class="flex-1 overflow-y-auto p-3 space-y-2"></div>
                        </div>

                        <!-- Chat area -->
                        <div class="flex-1 flex flex-col overflow-hidden">
                            <!-- Empty state -->
                            <div id="emptyState" class="flex-1 flex flex-col items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mb-4 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.97-4.03 9-9 9a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.97 4.03-9 9-9s9 4.03 9 9z"/>
                                </svg>
                                <p class="text-sm font-medium">Pilih sesi untuk mulai membalas</p>
                                <p class="text-xs mt-1 opacity-70">Pelapor akan melihat balasan Anda secara real-time</p>
                            </div>

                            <!-- Messages and input -->
                            <div id="chatArea" class="hidden flex-1 flex flex-col overflow-hidden">
                                <div id="messagesContainer" class="flex-1 overflow-y-auto px-6 py-4"></div>

                                <!-- Reply form -->
                                <div class="border-t border-gray-100 bg-white px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-1 relative">
                                            <input
                                                id="adminReplyInput"
                                                type="text"
                                                placeholder="Ketik balasan sebagai admin..."
                                                class="w-full rounded-2xl border border-gray-200 bg-gray-50 px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition"
                                                autocomplete="off"
                                            />
                                        </div>
                                        <button
                                            id="sendAdminReply"
                                            type="button"
                                            class="inline-flex items-center justify-center h-11 w-11 rounded-2xl bg-indigo-600 text-white hover:bg-indigo-700 active:bg-indigo-800 transition disabled:opacity-50 disabled:cursor-not-allowed"
                                            title="Kirim balasan (Enter)"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-2 ml-1">Tekan Enter atau klik tombol kirim untuk membalas pelapor</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <!-- Toast notification -->
    <div id="toast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 hidden">
        <div class="rounded-2xl bg-gray-900 px-5 py-3 text-sm text-white shadow-xl">
            <span id="toastMessage"></span>
        </div>
    </div>

    <script>
        let activeSession = null;
        let chatPollInterval = null;
        let isSending = false;

        // ──────────────────────────────────────────────
        // Toast helper
        // ──────────────────────────────────────────────
        function showToast(message, duration = 2500) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), duration);
        }

        // ──────────────────────────────────────────────
        // Load sessions into both sidebars
        // ──────────────────────────────────────────────
        async function loadSessions() {
            const response = await fetch('{{ route('admin.chat.sessions') }}');
            const data = await response.json();

            renderSessionList('sessionList', data.sessions, 'dark');
            renderSessionList('sessionSidebarList', data.sessions, 'light');

            if (!data.sessions.length) {
                document.getElementById('selectedSession').textContent = 'Belum ada sesi chat';
            }
        }

        function renderSessionList(containerId, sessions, theme) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';

            if (!sessions.length) {
                const empty = document.createElement('p');
                empty.className = theme === 'dark' ? 'text-sm text-indigo-200 px-2' : 'text-sm text-gray-400 px-2 py-4 text-center';
                empty.textContent = 'Belum ada sesi chat aktif.';
                container.appendChild(empty);
                return;
            }

            sessions.forEach(session => {
                const isActive = activeSession === session.session_id;
                const shortId = session.session_id.slice(0, 10) + '…';
                const timeStr = new Date(session.last_activity).toLocaleString('id-ID', { dateStyle: 'short', timeStyle: 'short' });
                const hasUnread = session.unread_count > 0;

                const btn = document.createElement('button');
                btn.type = 'button';

                if (theme === 'dark') {
                    btn.className = `w-full text-left rounded-xl px-3 py-3 transition ${isActive ? 'bg-white/20 ring-1 ring-white/30' : 'bg-white/5 hover:bg-white/10'}`;
                    btn.innerHTML = `
                        <div class="flex items-center justify-between mb-0.5">
                            <span class="font-medium text-sm text-white">${shortId}</span>
                            ${hasUnread ? `<span class="rounded-full bg-red-500 px-2 py-0.5 text-xs font-bold text-white">${session.unread_count}</span>` : ''}
                        </div>
                        <p class="text-xs text-indigo-300">${timeStr}</p>
                    `;
                } else {
                    btn.className = `w-full text-left rounded-xl px-3 py-3 border transition ${isActive ? 'bg-indigo-50 border-indigo-200' : 'bg-white border-transparent hover:bg-gray-100 hover:border-gray-200'}`;
                    btn.innerHTML = `
                        <div class="flex items-center justify-between mb-0.5">
                            <span class="font-semibold text-sm ${isActive ? 'text-indigo-700' : 'text-gray-800'}">${shortId}</span>
                            ${hasUnread ? `<span class="rounded-full bg-red-500 px-2 py-0.5 text-xs font-bold text-white">${session.unread_count}</span>` : ''}
                        </div>
                        <p class="text-xs ${isActive ? 'text-indigo-500' : 'text-gray-400'}">${timeStr}</p>
                    `;
                }

                btn.onclick = () => selectSession(session.session_id);
                container.appendChild(btn);
            });
        }

        // ──────────────────────────────────────────────
        // Select a session
        // ──────────────────────────────────────────────
        async function selectSession(sessionId) {
            activeSession = sessionId;

            // Update header
            document.getElementById('selectedSession').textContent = `Sesi: ${sessionId.slice(0, 16)}…`;
            document.getElementById('sessionAvatar').classList.remove('hidden');
            document.getElementById('sessionBadge').classList.remove('hidden');
            document.getElementById('deleteSessionButton').classList.remove('hidden');

            // Show chat area, hide empty state
            document.getElementById('emptyState').classList.add('hidden');
            document.getElementById('chatArea').classList.remove('hidden');
            document.getElementById('chatArea').classList.add('flex');

            // Focus reply input
            document.getElementById('adminReplyInput').focus();

            await loadMessages();
            await loadSessions(); // refresh unread badges
            startChatPolling();
        }

        // ──────────────────────────────────────────────
        // Load messages for active session
        // ──────────────────────────────────────────────
        async function loadMessages() {
            if (!activeSession) return;

            const response = await fetch(`/admin/chat/messages?session_id=${encodeURIComponent(activeSession)}`);
            const data = await response.json();
            const container = document.getElementById('messagesContainer');
            const wasAtBottom = container.scrollHeight - container.scrollTop - container.clientHeight < 60;

            container.innerHTML = '';

            if (!data.messages.length) {
                container.innerHTML = `
                    <div class="flex flex-col items-center justify-center h-full py-12 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-3 opacity-40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                        </svg>
                        <p class="text-sm">Belum ada pesan di sesi ini.</p>
                    </div>`;
                return;
            }

            data.messages.forEach(msg => {
                const isAdmin = msg.sender === 'admin';
                const timeStr = new Date(msg.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                const wrapper = document.createElement('div');
                wrapper.className = `flex ${isAdmin ? 'justify-end' : 'justify-start'}`;

                wrapper.innerHTML = `
                    <div class="group relative max-w-[70%]">
                        <div class="${isAdmin ? 'bubble-admin' : 'bubble-user'} px-4 py-3 shadow-sm">
                            <p class="text-sm leading-relaxed break-words">${escapeHtml(msg.message)}</p>
                            <p class="mt-1.5 text-xs ${isAdmin ? 'text-indigo-200' : 'text-gray-400'} flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 opacity-70" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                ${isAdmin ? 'Admin' : 'Pelapor'} &bull; ${timeStr}
                            </p>
                        </div>
                        <button
                            type="button"
                            onclick="deleteMessage(${msg.id_chat})"
                            class="absolute ${isAdmin ? '-left-7' : '-right-7'} top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition text-gray-400 hover:text-red-500"
                            title="Hapus pesan"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>`;

                container.appendChild(wrapper);
            });

            // Auto-scroll if near bottom or first load
            if (wasAtBottom || container.querySelectorAll('.flex').length <= data.messages.length) {
                container.scrollTop = container.scrollHeight;
            }
        }

        // ──────────────────────────────────────────────
        // Send admin reply
        // ──────────────────────────────────────────────
        async function sendAdminReply() {
            if (isSending) return;
            const input = document.getElementById('adminReplyInput');
            const sendBtn = document.getElementById('sendAdminReply');
            const message = input.value.trim();

            if (!activeSession) {
                showToast('Pilih sesi pelapor terlebih dahulu.');
                return;
            }
            if (!message) return;

            isSending = true;
            sendBtn.disabled = true;
            input.disabled = true;

            try {
                const res = await fetch('{{ route('admin.chat.reply') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ session_id: activeSession, message }),
                });

                if (!res.ok) throw new Error('Gagal mengirim pesan');

                input.value = '';
                await loadMessages();
                await loadSessions();
            } catch (e) {
                showToast('Gagal mengirim pesan. Coba lagi.');
            } finally {
                isSending = false;
                sendBtn.disabled = false;
                input.disabled = false;
                input.focus();
            }
        }

        // ──────────────────────────────────────────────
        // Delete message
        // ──────────────────────────────────────────────
        async function deleteMessage(messageId) {
            if (!confirm('Hapus pesan ini?')) return;

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

        // ──────────────────────────────────────────────
        // Delete entire session
        // ──────────────────────────────────────────────
        async function deleteSession() {
            if (!activeSession) return;
            if (!confirm(`Hapus seluruh sesi chat ${activeSession.slice(0, 16)}? Semua pesan akan dihapus secara permanen.`)) return;

            await fetch(`/admin/chat/sessions/${encodeURIComponent(activeSession)}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            });

            activeSession = null;
            stopChatPolling();

            document.getElementById('selectedSession').textContent = 'Pilih seorang pelapor dari sidebar';
            document.getElementById('sessionAvatar').classList.add('hidden');
            document.getElementById('sessionBadge').classList.add('hidden');
            document.getElementById('deleteSessionButton').classList.add('hidden');
            document.getElementById('chatArea').classList.add('hidden');
            document.getElementById('chatArea').classList.remove('flex');
            document.getElementById('emptyState').classList.remove('hidden');

            showToast('Sesi berhasil dihapus.');
            await loadSessions();
        }

        // ──────────────────────────────────────────────
        // Polling
        // ──────────────────────────────────────────────
        function startChatPolling() {
            if (chatPollInterval) return;
            chatPollInterval = setInterval(async () => {
                await loadMessages();
                await loadSessions();
            }, 2500);
        }

        function stopChatPolling() {
            if (!chatPollInterval) return;
            clearInterval(chatPollInterval);
            chatPollInterval = null;
        }

        // ──────────────────────────────────────────────
        // Escape HTML to prevent XSS
        // ──────────────────────────────────────────────
        function escapeHtml(str) {
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(str));
            return div.innerHTML;
        }

        // ──────────────────────────────────────────────
        // Event listeners
        // ──────────────────────────────────────────────
        document.getElementById('sendAdminReply').addEventListener('click', sendAdminReply);

        document.getElementById('adminReplyInput').addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendAdminReply();
            }
        });

        document.getElementById('deleteSessionButton').addEventListener('click', deleteSession);

        document.getElementById('refreshSessions').addEventListener('click', async () => {
            await loadSessions();
            showToast('Daftar sesi diperbarui.');
        });

        // ──────────────────────────────────────────────
        // Init
        // ──────────────────────────────────────────────
        loadSessions();

        // Lightly poll sessions even without active chat (to detect new incoming chats)
        setInterval(loadSessions, 5000);
    </script>
</body>
</html>
