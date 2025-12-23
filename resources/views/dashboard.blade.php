@extends('layouts.app')

@section('content')
<div class="grid md:grid-cols-3 gap-4">
    <div class="bg-white rounded-2xl shadow-md p-6 md:col-span-2">
        <div class="flex items-center gap-3 mb-4">
            <img src="/images/keikuecake-logo.png" alt="keiKueCake" class="h-12 w-12 object-contain drop-shadow">
            <div>
                <h2 class="text-xl font-semibold">Dashboard Admin</h2>
                <p class="text-slate-600 text-sm">Kelola produk, transaksi, dan stok.</p>
            </div>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div class="p-4 rounded-xl border border-rose-50 bg-rose-50/70 shadow-sm">
                <p class="text-sm uppercase tracking-[0.08em] text-rose-600 font-semibold mb-1">Produk</p>
                <p class="text-sm text-slate-700 mb-3">Tambah, edit harga/stok, dan hapus produk.</p>
                <a href="/products" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-rose-500 text-white font-semibold shadow hover:bg-rose-600">Buka Produk</a>
            </div>
            <div class="p-4 rounded-xl border border-emerald-50 bg-emerald-50/70 shadow-sm">
                <p class="text-sm uppercase tracking-[0.08em] text-emerald-700 font-semibold mb-1">Transaksi</p>
                <p class="text-sm text-slate-700 mb-3">Catat transaksi, stok otomatis berkurang/kembali.</p>
                <a href="/transactions" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold shadow hover:bg-emerald-700">Buka Transaksi</a>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-md p-6">
        <h3 class="text-lg font-semibold mb-2 text-slate-900">Status Autentikasi</h3>
        <p class="text-slate-700 mb-3 text-sm">Halaman ini membutuhkan token JWT. Jika token hilang/kedaluwarsa, Anda akan diarahkan kembali ke login.</p>
        <button id="checkToken" class="px-3 py-2 bg-rose-500 hover:bg-rose-600 text-white font-semibold rounded-lg">Cek Token</button>
        <p id="tokenStatus" class="text-sm mt-2 text-slate-600"></p>
    </div>
</div>

<script>
    function ensureToken() {
        const token = localStorage.getItem('token');
        if (!token) {
            window.location.href = '/login';
        }
        if (localStorage.getItem('role') !== 'admin') {
            window.location.href = '/catalog';
        }
        return token;
    }

    ensureToken();

    document.getElementById('checkToken')?.addEventListener('click', async () => {
        const token = ensureToken();
        const status = document.getElementById('tokenStatus');
        status.textContent = 'Memeriksa...';
        try {
            const res = await fetch('/api/auth/me', {
                headers: { 'Authorization': `Bearer ${token}` }
            });
            if (!res.ok) {
                throw new Error('Token tidak valid');
            }
            const data = await res.json();
            status.textContent = `Token valid untuk: ${data.email}`;
        } catch (err) {
            status.textContent = 'Token tidak valid / kedaluwarsa, silakan login ulang.';
            localStorage.removeItem('token');
            setTimeout(() => window.location.href = '/login', 1200);
        }
    });
</script>
@endsection
