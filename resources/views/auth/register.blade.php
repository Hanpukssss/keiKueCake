<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar | keiKueCake</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-[#fdf7f2] text-slate-900 flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">
        <h1 class="text-xl font-semibold mb-2 text-center">Buat Akun Baru</h1>
        <p class="text-sm text-slate-600 mb-6 text-center">Daftar untuk mulai mengelola keiKueCake</p>
        <form id="registerForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                <input type="text" name="name" required class="w-full rounded-lg border border-slate-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full rounded-lg border border-slate-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full rounded-lg border border-slate-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full rounded-lg border border-slate-200 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-rose-400">
            </div>
            <button type="submit" class="w-full bg-rose-500 hover:bg-rose-600 text-white font-semibold py-2 rounded-lg">Daftar</button>
            <p class="text-sm text-center text-slate-600">Sudah punya akun? <a href="/login" class="text-rose-600 font-semibold">Masuk</a></p>
            <p id="registerError" class="text-sm text-rose-600 text-center"></p>
        </form>
    </div>

    <script>
        const form = document.getElementById('registerForm');
        const errorText = document.getElementById('registerError');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            errorText.textContent = '';
            const formData = new FormData(form);
            try {
                const res = await fetch('/api/auth/register', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        name: formData.get('name'),
                        email: formData.get('email'),
                        password: formData.get('password'),
                        password_confirmation: formData.get('password_confirmation'),
                    })
                });
                const data = await res.json();
                if (!res.ok) {
                    errorText.textContent = data.message || 'Registrasi gagal';
                    return;
                }
                // Setelah register, arahkan ke halaman login (tidak auto-login)
                window.location.href = '/login';
            } catch (error) {
                errorText.textContent = 'Terjadi kesalahan. Coba lagi.';
            }
        });
    </script>
</body>
</html>
