<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | keiKueCake</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-gradient-to-b from-[#ffe6f1] via-white to-[#ffe6f1] text-slate-900 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 border border-rose-50">
        <div class="flex flex-col items-center mb-6">
            <img src="/images/keikuecake-logo.png" alt="keiKueCake" class="h-14 w-14 object-contain drop-shadow mb-2">
            <p class="text-xs uppercase tracking-[0.2em] text-rose-500 font-semibold">keiKueCake</p>
            <p class="text-sm text-slate-600">Manis di setiap gigitan</p>
        </div>
        <h1 class="text-xl font-semibold mb-2 text-center text-slate-900">Masuk</h1>
        <p class="text-sm text-slate-600 mb-4 text-center">Gunakan akun Anda untuk mengakses dashboard.</p>
        <form id="loginForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full rounded-xl border border-slate-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full rounded-xl border border-slate-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">
            </div>
            <button type="submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white font-semibold py-2.5 rounded-xl shadow">Masuk</button>
            <p class="text-sm text-center text-slate-600">Belum punya akun? <a href="/register" class="text-rose-600 font-semibold">Daftar</a></p>
            <p id="loginError" class="text-sm text-rose-600 text-center"></p>
        </form>
    </div>

    <script>
        const form = document.getElementById('loginForm');
        const errorText = document.getElementById('loginError');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            errorText.textContent = '';
            const formData = new FormData(form);
            try {
                const res = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        email: formData.get('email'),
                        password: formData.get('password'),
                    })
                });
                const data = await res.json();
                if (!res.ok) {
                    errorText.textContent = data.message || 'Login gagal';
                    errorText.className = 'text-sm text-rose-600 text-center';
                    return;
                }
                localStorage.setItem('token', data.access_token);
                localStorage.setItem('role', data.user.role);
                errorText.textContent = 'Login berhasil, mengalihkan...';
                errorText.className = 'text-sm text-emerald-600 text-center';
                setTimeout(() => {
                    window.location.href = data.user.role === 'admin' ? '/dashboard' : '/home';
                }, 500);
            } catch (error) {
                errorText.textContent = 'Terjadi kesalahan. Coba lagi.';
            }
        });
    </script>
</body>
</html>
