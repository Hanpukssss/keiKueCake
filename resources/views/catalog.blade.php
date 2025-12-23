<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Kue | keiKueCake</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-[#fdf7f2] text-slate-900">
    <div class="max-w-6xl mx-auto px-4 py-10 space-y-6">
        <header class="flex flex-col gap-2">
            <p class="text-xs uppercase tracking-[0.2em] text-rose-500 font-semibold">Katalog keiKueCake</p>
            <h1 class="text-3xl font-bold text-slate-900">Temukan kue favoritmu.</h1>
            <p class="text-slate-700">Tanpa login, lihat stok dan harga terkini. Admin silakan ke dashboard untuk kelola.</p>
        </header>

        <div class="bg-white rounded-3xl shadow-lg p-5 border border-rose-50">
            <div class="flex items-center gap-3">
                <input id="searchInput" type="text" placeholder="Cari kue / rasa..." class="w-full rounded-xl border border-rose-100 px-4 py-3 focus:ring-2 focus:ring-rose-300">
            </div>
        </div>

        <section>
            <div id="productGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>
            <p id="catalogError" class="text-rose-600 text-sm mt-3"></p>
        </section>
    </div>

    <script>
        const productGrid = document.getElementById('productGrid');
        const catalogError = document.getElementById('catalogError');
        const searchInput = document.getElementById('searchInput');
        let products = [];

        function formatPrice(value) {
            return `Rp ${Number(value).toLocaleString('id-ID')}`;
        }

        function render(list) {
            if (!list.length) {
                productGrid.innerHTML = '<div class="text-slate-500 col-span-full">Belum ada produk.</div>';
                return;
            }
            productGrid.innerHTML = '';
            list.forEach(p => {
                const card = document.createElement('div');
                card.className = 'bg-white shadow rounded-2xl p-4 border border-rose-50 hover:-translate-y-1 transition transform';
                const image = p.image ? `<img src="${p.image}" alt="${p.name}" class="h-32 w-full object-cover rounded-xl mb-3">` : `<div class="h-32 w-full rounded-xl mb-3 bg-gradient-to-r from-rose-50 to-pink-100 flex items-center justify-center text-rose-400 text-sm">keiKueCake</div>`;
                card.innerHTML = `
                    ${image}
                    <div class="flex items-start justify-between gap-2 mb-1">
                        <div class="font-semibold text-lg text-slate-900">${p.name}</div>
                        <span class="text-xs px-3 py-1 rounded-full bg-rose-50 text-rose-600">Stok ${p.stock}</span>
                    </div>
                    <div class="text-sm font-semibold text-rose-500 mb-1">${formatPrice(p.price)}</div>
                    <p class="text-sm text-slate-700 line-clamp-2">${p.description ?? ''}</p>
                `;
                productGrid.appendChild(card);
            });
        }

        function applyFilter() {
            const q = (searchInput?.value || '').toLowerCase();
            const filtered = products.filter(p => p.name.toLowerCase().includes(q) || (p.description || '').toLowerCase().includes(q));
            render(filtered);
        }

        async function loadCatalog() {
            productGrid.innerHTML = '<div class="text-slate-500">Memuat...</div>';
            try {
                const res = await fetch('/api/public/products');
                if (!res.ok) throw new Error();
                const data = await res.json();
                products = data.data || [];
                applyFilter();
            } catch (e) {
                catalogError.textContent = 'Gagal memuat katalog.';
            }
        }

        searchInput?.addEventListener('input', applyFilter);
        loadCatalog();
    </script>
</body>
</html>
