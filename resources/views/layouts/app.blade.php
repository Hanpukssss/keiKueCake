<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>keiKueCake Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-b from-[#fef1f6] via-white to-[#fde9f3] text-slate-900">
    <div class="max-w-6xl mx-auto px-4 py-8 space-y-6">
        <header class="bg-white/80 backdrop-blur border border-rose-50 rounded-3xl shadow-lg p-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="/images/keikuecake-logo.png" alt="keiKueCake" class="h-12 w-12 object-contain drop-shadow">
                <div>
                    <h1 class="text-2xl font-semibold">keiKueCake</h1>
                    <p class="text-sm text-slate-600">Dashboard admin</p>
                </div>
            </div>
            <nav class="flex items-center gap-2" id="navLinks">
                <a href="/dashboard" class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-rose-50" data-admin-nav>Dashboard</a>
                <a href="/products" class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-rose-50" data-admin-nav>Produk</a>
                <a href="/transactions" class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-rose-50" data-admin-nav>Transaksi</a>
                <a href="/catalog" class="px-3 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:bg-rose-50">Katalog</a>
                <button id="logoutBtn" class="px-3 py-2 text-sm font-semibold text-white bg-rose-500 hover:bg-rose-600 rounded-lg">Logout</button>
            </nav>
        </header>

        <main>
            @yield('content')
        </main>
        <div id="toast" class="fixed bottom-4 right-4 z-50 hidden">
            <div id="toastInner" class="px-4 py-3 rounded-lg shadow-lg text-sm font-semibold"></div>
        </div>
    </div>

    <script>
        const logoutBtn = document.getElementById('logoutBtn');
        const adminLinks = document.querySelectorAll('[data-admin-nav]');
        const role = localStorage.getItem('role');
        const path = window.location.pathname;

        // Link admin tidak lagi disembunyikan agar menu stabil
        adminLinks.forEach(link => {
            link.classList.remove('hidden');
            if (link.getAttribute('href') === path) {
                link.classList.add('bg-rose-100', 'text-rose-700');
            }
        });

        if (logoutBtn) {
            logoutBtn.addEventListener('click', async () => {
                const token = localStorage.getItem('token');
                if (!token) {
                    window.location.href = '/login';
                    return;
                }
                try {
                    await fetch('/api/auth/logout', {
                        method: 'POST',
                        headers: { 'Authorization': `Bearer ${token}` }
                    });
                } catch (e) {
                    console.error(e);
                } finally {
                    localStorage.removeItem('token');
                    window.location.href = '/login';
                }
            });
        }

        window.showToast = function (message, type = 'info') {
            const toast = document.getElementById('toast');
            const inner = document.getElementById('toastInner');
            if (!toast || !inner) return;
            inner.textContent = message;
            inner.className = 'px-4 py-3 rounded-lg shadow-lg text-sm font-semibold ' + (type === 'error' ? 'bg-rose-500 text-white' : 'bg-emerald-500 text-white');
            toast.classList.remove('hidden', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.classList.add('hidden'), 200);
            }, 2000);
        };
    </script>
</body>
</html>
