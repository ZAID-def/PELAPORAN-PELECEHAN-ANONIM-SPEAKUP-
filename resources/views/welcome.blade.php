<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpeakUp - Ruang Aman untuk Bersuara</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-white">
    <header class="bg-indigo-900">
        <div class="container mx-auto px-4 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="rounded-full bg-white/10 p-2 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.761 0 5-2.686 5-6S14.761-1 12-1 7 1.686 7 5s2.239 6 5 6zM3 21c0-3.313 2.687-6 6-6h6c3.313 0 6 2.687 6 6" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-300">SpeakUp</p>
                    <p class="text-xs text-slate-400">Lapor Pelecehan & Diskriminasi</p>
                </div>
            </div>
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

    <main class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-slate-950 to-slate-900 opacity-95"></div>
        <div class="relative container mx-auto px-4 py-24">
            <div class="max-w-3xl mx-auto text-center">
                <p class="text-sm uppercase tracking-[0.4em] text-slate-400 mb-4">Ruang Aman untuk Bersuara</p>
                <h1 class="text-5xl font-extrabold leading-tight mb-6">Sistem Pelaporan Pelecehan dan Diskriminasi Berbasis Anonim</h1>
                <p class="text-lg text-slate-300 mb-10">Laporkan kejadian tanpa harus mengungkapkan identitas, kemudian pantau status laporan Anda dengan mudah menggunakan kode tracking unik.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('lapor.create') }}" class="inline-flex items-center justify-center rounded-full bg-white px-8 py-4 text-sm font-semibold text-indigo-900 shadow-lg shadow-indigo-900/20 hover:bg-slate-100 transition">
                        Lapor Sekarang (Anonim)
                    </a>
                    <a href="{{ route('track.form') }}" class="inline-flex items-center justify-center rounded-full border border-white/30 bg-white/10 px-8 py-4 text-sm font-semibold text-white hover:bg-white/20 transition">
                        Cek Status Laporan
                    </a>
                </div>
            </div>

            <div class="mt-20 grid gap-6 md:grid-cols-3">
                <div class="rounded-3xl bg-slate-950/80 p-8 shadow-xl shadow-black/20">
                    <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-700/20 text-indigo-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">100% Anonim</h3>
                    <p class="text-slate-400">Anda tidak perlu login atau mengungkap identitas untuk membuat laporan. Privasi terjaga.</p>
                </div>
                <div class="rounded-3xl bg-slate-950/80 p-8 shadow-xl shadow-black/20">
                    <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-700/20 text-indigo-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3M12 19a7 7 0 100-14 7 7 0 000 14z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Tracking Real-time</h3>
                    <p class="text-slate-400">Gunakan kode unik untuk memantau perkembangan laporan dan tindak lanjut kapan saja.</p>
                </div>
                <div class="rounded-3xl bg-slate-950/80 p-8 shadow-xl shadow-black/20">
                    <div class="mb-5 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-700/20 text-indigo-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M12 3v1m0 16v1m8.66-12.66l-.71.71M5.66 18.36l-.71.71M21 12h-1M4 12H3m16.66 4.66l-.71-.71M5.66 5.64l-.71-.71"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Tindak Lanjut Jelas</h3>
                    <p class="text-slate-400">Laporan dikelola oleh tim verifikasi dan ditindaklanjuti secara transparan oleh pihak kampus.</p>
                </div>
            </div>
        </div>
    </main>

    <div class="fixed bottom-6 right-6 z-50">
        <button id="chatToggle" class="flex items-center gap-2 rounded-full bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-2xl shadow-indigo-900/30 hover:bg-indigo-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
            </svg>
            Customer Service
        </button>

        <div id="chatWidget" class="hidden mt-4 w-80 rounded-3xl border border-white/10 bg-slate-950/95 shadow-2xl shadow-black/50 backdrop-blur-xl">
            <div class="flex items-center justify-between border-b border-white/10 px-4 py-4 text-white">
                <div>
                    <p class="font-semibold">Chat Pelapor</p>
                    <p class="text-xs text-slate-400">Sesi anonim akan tersimpan di browser Anda.</p>
                </div>
                <button id="closeChat" class="text-slate-300 hover:text-white">Tutup</button>
            </div>
            <div id="chatMessages" class="max-h-72 space-y-3 overflow-y-auto px-4 py-4"></div>
            <form id="chatForm" class="border-t border-white/10 px-4 py-4" onsubmit="return false;">
                <div class="mb-3">
                    <input id="chatInput" type="text" placeholder="Ketik pesan..." class="w-full rounded-2xl border border-slate-700 bg-slate-900 px-4 py-3 text-white placeholder:text-slate-500 focus:border-indigo-500 focus:outline-none" />
                </div>
                <button id="sendChat" type="button" class="w-full rounded-2xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition">Kirim</button>
        <!-- Chat toggle button with unread badge -->
        <div class="relative inline-block">
            <button id="chatToggle" class="flex items-center gap-2 rounded-full bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-2xl shadow-indigo-900/30 hover:bg-indigo-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z"/>
                </svg>
                Customer Service
            </button>
            <span id="unreadBadge" class="hidden absolute -top-1.5 -right-1.5 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs font-bold text-white ring-2 ring-slate-950"></span>
        </div>

        <!-- Chat widget -->
        <div id="chatWidget" class="hidden mt-3 w-80 rounded-3xl border border-white/10 bg-slate-950/95 shadow-2xl shadow-black/50 backdrop-blur-xl overflow-hidden">
            <!-- Header -->
            <div class="flex items-center justify-between border-b border-white/10 px-4 py-4 text-white bg-indigo-900/50">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-sm">Customer Service</p>
                        <div class="flex items-center gap-1">
                            <span class="h-1.5 w-1.5 rounded-full bg-green-400 animate-pulse"></span>
                            <p class="text-xs text-slate-300">Tim SpeakUp siap membantu</p>
                        </div>
                    </div>
                </div>
                <button id="closeChat" class="rounded-full p-1 text-slate-400 hover:text-white hover:bg-white/10 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Messages -->
            <div id="chatMessages" class="flex flex-col gap-2.5 max-h-72 overflow-y-auto px-4 py-4 scroll-smooth"></div>

            <!-- Input -->
            <form id="chatForm" class="border-t border-white/10 px-4 py-3 bg-slate-900/50" onsubmit="return false;">
                <div class="flex items-center gap-2">
                    <input
                        id="chatInput"
                        type="text"
                        placeholder="Ketik pesan..."
                        autocomplete="off"
                        class="flex-1 rounded-2xl border border-slate-700 bg-slate-900 px-4 py-2.5 text-sm text-white placeholder:text-slate-500 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 transition"
                    />
                    <button id="sendChat" type="button" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-indigo-600 text-white hover:bg-indigo-700 active:bg-indigo-800 transition disabled:opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                        </svg>
                    </button>
                </div>
                <p class="mt-2 text-center text-[10px] text-slate-500">Pesan Anda bersifat anonim &bull; Tekan Enter untuk kirim</p>
            </form>
        </div>
    </div>

    <script>
        const chatToggle = document.getElementById('chatToggle');
        const chatWidget = document.getElementById('chatWidget');
        const closeChat = document.getElementById('closeChat');
        const chatMessages = document.getElementById('chatMessages');
        const chatInput = document.getElementById('chatInput');
        const sendChat = document.getElementById('sendChat');
        const chatForm = document.getElementById('chatForm');
        let chatPollInterval = null;

        const chatToggle    = document.getElementById('chatToggle');
        const chatWidget    = document.getElementById('chatWidget');
        const closeChat     = document.getElementById('closeChat');
        const chatMessages  = document.getElementById('chatMessages');
        const chatInput     = document.getElementById('chatInput');
        const sendChat      = document.getElementById('sendChat');
        const chatForm      = document.getElementById('chatForm');
        const unreadBadge   = document.getElementById('unreadBadge');

        let chatPollInterval    = null;
        let backgroundPollInterval = null;
        let lastMessageCount    = 0;
        let isSending           = false;

        // ──────────────────────────────────────────────
        // Session ID (stored in localStorage)
        // ──────────────────────────────────────────────
        function getSessionId() {
            let sessionId = localStorage.getItem('speakup_chat_session');
            if (!sessionId) {
                sessionId = 'anon-' + Math.random().toString(36).substring(2, 12) + Date.now().toString(36);
                localStorage.setItem('speakup_chat_session', sessionId);
            }
            return sessionId;
        }

        async function loadChatMessages() {
            const sessionId = getSessionId();
            const response = await fetch(`/chat/messages?session_id=${encodeURIComponent(sessionId)}`);
            const data = await response.json();
            chatMessages.innerHTML = '';

            if (data.messages && data.messages.length) {
                data.messages.forEach(message => {
                    const bubble = document.createElement('div');
                    bubble.className = message.sender === 'admin' ? 'self-start rounded-3xl rounded-br-none bg-indigo-600 px-4 py-3 text-white max-w-[85%]' : 'self-end rounded-3xl rounded-bl-none bg-slate-800 px-4 py-3 text-slate-100 max-w-[85%]';
                    bubble.innerHTML = `<div class="text-sm">${message.message}</div><div class="mt-2 text-[11px] ${message.sender === 'admin' ? 'text-indigo-100' : 'text-slate-400'}">${message.sender === 'admin' ? 'Admin' : 'Anda'}</div>`;
                    chatMessages.appendChild(bubble);
                });
            } else {
                chatMessages.innerHTML = '<p class="text-center text-sm text-slate-500">Belum ada pesan. Mulai ketik dan kirim pesan Anda.</p>';
            }

            chatMessages.scrollTop = chatMessages.scrollHeight;
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
        // Load & render messages
        // ──────────────────────────────────────────────
        async function loadChatMessages() {
            const sessionId = getSessionId();
            let data;
            try {
                const res = await fetch(`/chat/messages?session_id=${encodeURIComponent(sessionId)}`);
                data = await res.json();
            } catch (e) {
                return;
            }

            const messages = data.messages || [];
            const isOpen = !chatWidget.classList.contains('hidden');

            // Count unread admin messages (admin replies not yet seen while widget is closed)
            const adminMessages = messages.filter(m => m.sender === 'admin');
            const newCount = adminMessages.length;

            // Show/hide unread badge on toggle button
            if (!isOpen && newCount > lastMessageCount) {
                const diff = newCount - lastMessageCount;
                unreadBadge.textContent = diff > 9 ? '9+' : diff;
                unreadBadge.classList.remove('hidden');
            }

            if (isOpen) {
                lastMessageCount = newCount;
                unreadBadge.classList.add('hidden');
                unreadBadge.textContent = '';
            }

            // Only re-render if widget is open
            if (!isOpen) return;

            const wasAtBottom = chatMessages.scrollHeight - chatMessages.scrollTop - chatMessages.clientHeight < 50;
            chatMessages.innerHTML = '';

            if (!messages.length) {
                chatMessages.innerHTML = `
                    <div class="py-6 text-center">
                        <p class="text-sm text-slate-500">Belum ada pesan.</p>
                        <p class="text-xs text-slate-600 mt-1">Mulai ketik dan kirim pesan Anda.</p>
                    </div>`;
                return;
            }

            messages.forEach(msg => {
                const isAdmin = msg.sender === 'admin';
                const timeStr = new Date(msg.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

                const wrapper = document.createElement('div');
                wrapper.className = `flex ${isAdmin ? 'justify-start' : 'justify-end'}`;

                wrapper.innerHTML = `
                    <div class="max-w-[80%] ${isAdmin
                        ? 'rounded-2xl rounded-tl-none bg-indigo-600 text-white'
                        : 'rounded-2xl rounded-tr-none bg-slate-800 text-slate-100'
                    } px-3.5 py-2.5">
                        <p class="text-sm leading-relaxed break-words">${escapeHtml(msg.message)}</p>
                        <p class="mt-1 text-[10px] ${isAdmin ? 'text-indigo-200' : 'text-slate-500'}">${isAdmin ? 'Admin' : 'Anda'} &bull; ${timeStr}</p>
                    </div>`;

                chatMessages.appendChild(wrapper);
            });

            if (wasAtBottom) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        // ──────────────────────────────────────────────
        // Polling (active when widget is open)
        // ──────────────────────────────────────────────
        function startChatPolling() {
            if (chatPollInterval) return;
            chatPollInterval = setInterval(loadChatMessages, 2500);
        }

        function stopChatPolling() {
            if (!chatPollInterval) return;
            clearInterval(chatPollInterval);
            chatPollInterval = null;
        }

        chatToggle.addEventListener('click', () => {
            const hidden = chatWidget.classList.toggle('hidden');
            if (!hidden) {
                loadChatMessages();
                startChatPolling();
        // Background polling (widget is closed) to detect new admin replies
        function startBackgroundPolling() {
            if (backgroundPollInterval) return;
            backgroundPollInterval = setInterval(async () => {
                if (!chatWidget.classList.contains('hidden')) return; // widget open, skip
                const sessionId = getSessionId();
                try {
                    const res = await fetch(`/chat/messages?session_id=${encodeURIComponent(sessionId)}`);
                    const data = await res.json();
                    const adminMessages = (data.messages || []).filter(m => m.sender === 'admin');
                    if (adminMessages.length > lastMessageCount) {
                        const diff = adminMessages.length - lastMessageCount;
                        unreadBadge.textContent = diff > 9 ? '9+' : diff;
                        unreadBadge.classList.remove('hidden');
                    }
                } catch (e) {}
            }, 5000);
        }

        // ──────────────────────────────────────────────
        // Toggle widget
        // ──────────────────────────────────────────────
        chatToggle.addEventListener('click', () => {
            const hidden = chatWidget.classList.toggle('hidden');
            if (!hidden) {
                // Widget opened
                loadChatMessages();
                startChatPolling();
                unreadBadge.classList.add('hidden');
                unreadBadge.textContent = '';
                setTimeout(() => chatInput.focus(), 100);
            } else {
                stopChatPolling();
            }
        });

        closeChat.addEventListener('click', () => {
            chatWidget.classList.add('hidden');
            stopChatPolling();
        });

        async function sendMessage() {
            const message = chatInput.value.trim();
            if (!message) return;
            const sessionId = getSessionId();

            await fetch('{{ route('chat.send') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ session_id: sessionId, message }),
            });

            chatInput.value = '';
            await loadChatMessages();
        }

        sendChat.addEventListener('click', sendMessage);
        chatForm.addEventListener('submit', async function (event) {
            event.preventDefault();
            await sendMessage();
        });
        // ──────────────────────────────────────────────
        // Send message
        // ──────────────────────────────────────────────
        async function sendMessage() {
            if (isSending) return;
            const message = chatInput.value.trim();
            if (!message) return;

            isSending = true;
            sendChat.disabled = true;
            chatInput.disabled = true;

            const sessionId = getSessionId();
            try {
                await fetch('{{ route('chat.send') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ session_id: sessionId, message }),
                });
                chatInput.value = '';
                await loadChatMessages();
            } catch (e) {
                // silent fail; message will retry on next poll
            } finally {
                isSending = false;
                sendChat.disabled = false;
                chatInput.disabled = false;
                chatInput.focus();
            }
        }

        sendChat.addEventListener('click', sendMessage);
        chatInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Start background polling immediately so unread badge shows up
        startBackgroundPolling();
    </script>
</body>
</html>