<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>keiKueCake | Toko Kue Manis</title>
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-gradient-to-b from-[#ffe6f1] via-white to-[#ffe6f1] text-slate-900">
    <div class="absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-24 -left-24 w-72 h-72 bg-pink-300/40 blur-3xl rounded-full"></div>
        <div class="absolute -bottom-24 -right-10 w-80 h-80 bg-rose-400/30 blur-3xl rounded-full"></div>
    </div>

        <header class="max-w-6xl mx-auto px-4 py-6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="/images/keikuecake-logo.png" alt="keiKueCake" class="h-12 w-12 object-contain drop-shadow">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-rose-500">keiKueCake</p>
                    <p class="text-sm text-slate-600">Manis di setiap gigitan</p>
                </div>
            </div>
            <nav class="flex items-center gap-4 text-sm font-semibold">
                <a href="/catalog" class="text-slate-700 hover:text-rose-600">Katalog</a>
                <a href="#best" class="text-slate-700 hover:text-rose-600">Best Seller</a>
                <a href="#kenapa" class="text-slate-700 hover:text-rose-600">Kenapa Kami</a>
                <a id="navAuthBtn" href="/login" class="px-4 py-2 rounded-full bg-rose-500 text-white hover:bg-rose-600 shadow-md">Login</a>
            </nav>
        </header>

    <main class="max-w-6xl mx-auto px-4 pb-16">
        <section class="grid md:grid-cols-2 gap-8 items-center py-10 fade-section reveal">
            <div class="space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white shadow text-rose-500 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span> Fresh baked daily
                </div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight text-slate-900">
                    Kue manis, mood naik, hari cerah.
                </h1>
                <p class="text-slate-700 text-lg">Kue premium, bahan bagus, siap untuk surprise kecil atau pesta besar.</p>
                <div class="flex items-center gap-3">
                    <a href="#quick-order" class="px-5 py-3 rounded-xl bg-rose-500 text-white font-semibold shadow-lg hover:bg-rose-600">Pesan Cepat</a>
                    <a href="https://wa.me/08xxxxxxxxxx" class="px-4 py-3 rounded-xl bg-white text-rose-500 font-semibold shadow hover:shadow-md">Chat WhatsApp</a>
                </div>
                <div class="flex items-center gap-6 pt-4">
                    <div>
                        <p class="text-3xl font-bold text-rose-500">500+</p>
                        <p class="text-sm text-slate-600">Pelanggan</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-rose-500">50+</p>
                        <p class="text-sm text-slate-600">Varian</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-rose-500">4.9⭐</p>
                        <p class="text-sm text-slate-600">Rating</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="rounded-3xl bg-white shadow-2xl p-6 flex flex-col gap-4">
                    <div class="relative overflow-hidden rounded-2xl h-64">
                        <div class="absolute inset-0 bg-gradient-to-tr from-rose-500/40 via-white/0 to-pink-300/40 pointer-events-none"></div>
                        <img id="heroImageA" class="hero-image" src="{{ asset('images/hero-1.jpg') }}" alt="Cake">
                        <img id="heroImageB" class="hero-image hidden" src="{{ asset('images/hero-2.jpg') }}" alt="Cake">
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-lg font-semibold text-slate-900">Signature Strawberry Cake</p>
                            <p class="text-sm text-slate-600">Lapisan sponge, krim vanilla, stroberi segar.</p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-bold text-rose-500">Rp 120K</p>
                            <p class="text-xs text-slate-500">Free topping marshmallow</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="best" class="py-12 fade-section reveal">
            <div class="bg-gradient-to-r from-rose-50 to-white border border-rose-100 rounded-3xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-rose-500 font-semibold">Favorit</p>
                        <h2 class="text-2xl font-bold text-slate-900">Best seller minggu ini</h2>
                        <p class="text-sm text-slate-600">Dipilih dari penjualan tertinggi dan rating pelanggan.</p>
                    </div>
                    <a href="/catalog" class="text-sm font-semibold text-rose-600 hover:text-rose-700">Lihat semua →</a>
                </div>
                <div id="bestGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4"></div>
                <p id="bestError" class="text-sm text-rose-600 mt-2"></p>
            </div>
        </section>

        <section id="kenapa" class="py-12 grid md:grid-cols-2 gap-6 items-start fade-section reveal">
            <div class="space-y-4 bg-white/90 rounded-3xl shadow-lg p-6 border border-rose-50">
                <p class="text-xs uppercase tracking-[0.2em] text-rose-500 font-semibold">Kenapa pilih kami</p>
                <h2 class="text-2xl font-bold text-slate-900">Sederhana, cepat, memuaskan.</h2>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <span class="w-3 h-3 rounded-full bg-rose-500 mt-1.5"></span>
                        <div>
                            <p class="font-semibold text-slate-900">Bahan premium</p>
                            <p class="text-sm text-slate-600">Mentega asli, cokelat Belgia, buah segar.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="w-3 h-3 rounded-full bg-rose-500 mt-1.5"></span>
                        <div>
                            <p class="font-semibold text-slate-900">Custom mudah</p>
                            <p class="text-sm text-slate-600">Minimalist, karakter, atau floral sesuai brief.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="w-3 h-3 rounded-full bg-rose-500 mt-1.5"></span>
                        <div>
                            <p class="font-semibold text-slate-900">Kirim cepat</p>
                            <p class="text-sm text-slate-600">Same-day area tertentu, packing aman.</p>
                        </div>
                    </div>
                </div>
                <div class="bg-rose-50 border border-rose-100 rounded-2xl p-4">
                    <p class="font-semibold text-rose-600">Chat cepat?</p>
                    <p class="text-sm text-slate-700">WA 08xx-xxxx-xxxx atau IG @keiKueCake.</p>
                </div>
            </div>
            <div class="space-y-5 bg-white/90 rounded-3xl shadow-lg p-6 border border-rose-50">
                <p class="text-xs uppercase tracking-[0.2em] text-rose-500 font-semibold">Layanan</p>
                <h2 class="text-2xl font-bold text-slate-900">Kami sediakan</h2>
                <div class="grid sm:grid-cols-2 gap-3">
                    <div class="bg-white shadow rounded-xl p-4 border border-rose-50">
                        <p class="font-semibold text-rose-500 mb-1">Hampers</p>
                        <p class="text-sm text-slate-600">Gift manis siap kirim.</p>
                    </div>
                    <div class="bg-white shadow rounded-xl p-4 border border-rose-50">
                        <p class="font-semibold text-rose-500 mb-1">Dessert Table</p>
                        <p class="text-sm text-slate-600">Setup cantik untuk acara.</p>
                    </div>
                    <div class="bg-white shadow rounded-xl p-4 border border-rose-50">
                        <p class="font-semibold text-rose-500 mb-1">Snack Box</p>
                        <p class="text-sm text-slate-600">Meeting & corporate.</p>
                    </div>
                    <div class="bg-white shadow rounded-xl p-4 border border-rose-50">
                        <p class="font-semibold text-rose-500 mb-1">Birthday Cake</p>
                        <p class="text-sm text-slate-600">Tema bebas, full custom.</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 text-xs font-semibold text-rose-600">
                    <span class="px-3 py-2 rounded-full bg-rose-50 border border-rose-100">Pilih paket</span>
                    <span class="px-3 py-2 rounded-full bg-rose-50 border border-rose-100">Setujui detail</span>
                    <span class="px-3 py-2 rounded-full bg-rose-50 border border-rose-100">Kami kirim</span>
                </div>
            </div>
        </section>

        <section class="py-12 reveal">
            <div class="max-w-6xl mx-auto bg-white/90 rounded-3xl shadow-lg p-6 border border-rose-50 grid md:grid-cols-2 gap-6 items-center">
                <div class="grid grid-cols-2 gap-3">
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1481399237920-4cbf82c91e3b?auto=format&fit=crop&w=800&q=80" class="h-44 w-full object-cover" alt="Cake">
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1481391032119-d89fee407e44?auto=format&fit=crop&w=800&q=80" class="h-44 w-full object-cover" alt="Cupcake">
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1464349153735-7db50ed83c84?auto=format&fit=crop&w=800&q=80" class="h-44 w-full object-cover" alt="Dessert">
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1458640904116-093b74971de9?auto=format&fit=crop&w=800&q=80" class="h-44 w-full object-cover" alt="Macaron">
                    </div>
                </div>
                <div class="space-y-4">
                    <p class="text-sm uppercase tracking-[0.2em] text-rose-500 font-semibold">Tentang keiKueCake</p>
                    <h2 class="text-3xl font-bold text-slate-900">Temukan pengalaman manis baru.</h2>
                    <p class="text-slate-700">Kami adalah toko kue yang fokus pada rasa premium dan desain rapi. Dari cake ulang tahun, wedding cake, hingga dessert table, semua dibuat fresh setiap hari.</p>
                    <p class="text-slate-700">Tim pastry kami siap membantu menyesuaikan tema dan anggaran. Pilih paket favorit, konsultasi singkat, dan kue akan kami siapkan untuk momen spesial Anda.</p>
                    <a href="/catalog" class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-rose-500 text-white font-semibold shadow hover:bg-rose-600 w-fit">Jelajahi Katalog</a>
                </div>
            </div>
        </section>

        <section class="py-12 reveal">
            <div class="bg-gradient-to-r from-rose-500 to-pink-400 text-white rounded-3xl shadow-2xl p-8 flex flex-col md:flex-row gap-6 items-center justify-between">
                <div class="flex-1 space-y-3">
                    <p class="text-sm uppercase tracking-[0.2em] font-semibold">Apa kata mereka</p>
                    <div class="grid sm:grid-cols-2 gap-3">
                        <div class="bg-white/15 rounded-2xl p-4 border border-white/20">
                            <p class="text-white/90 mb-2">“Kue ulang tahun rapi, enak, dan on-time!”</p>
                            <p class="font-semibold text-white">Nadia</p>
                        </div>
                        <div class="bg-white/15 rounded-2xl p-4 border border-white/20">
                            <p class="text-white/90 mb-2">“Hampers corporate elegan, klien senang.”</p>
                            <p class="font-semibold text-white">Raka</p>
                        </div>
                    </div>
                </div>
                <div class="flex-1 space-y-3 md:text-right">
                    <h3 class="text-2xl font-bold">Buat momen manis sekarang.</h3>
                    <p class="text-white/90 text-sm">Pesan kue custom, hampers, atau dessert table. Kami siap bantu.</p>
                </div>
            </div>
        </section>

        <section id="quick-order" class="py-12">
            <div class="max-w-5xl mx-auto bg-white/90 rounded-3xl shadow-lg p-6 border border-rose-50">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="md:w-1/2 space-y-3">
                        <p class="text-xs uppercase tracking-[0.2em] text-rose-500 font-semibold">Quick order</p>
                        <h2 class="text-2xl font-bold text-slate-900">Pesan langsung dari stok.</h2>
                        <p class="text-sm text-slate-700">Pilih produk dengan stok tersedia. Jika habis, akan ada pemberitahuan.</p>
                        <form id="quickOrderForm" class="space-y-3">
                            <div>
                                <label class="text-sm font-semibold text-slate-800">Produk</label>
                                <select id="productSelect" class="w-full rounded-xl border border-rose-100 px-3 py-3 focus:ring-2 focus:ring-rose-300 bg-white">
                                    <option value="">Memuat produk...</option>
                                </select>
                                <p id="productInfo" class="text-sm text-slate-600 mt-1"></p>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="text-sm font-semibold text-slate-800">Qty</label>
                                    <input id="orderQty" type="number" min="1" value="1" class="w-full rounded-xl border border-rose-100 px-3 py-3 focus:ring-2 focus:ring-rose-300">
                                </div>
                                <div>
                                    <label class="text-sm font-semibold text-slate-800">Tanggal (opsional)</label>
                                    <input type="date" class="w-full rounded-xl border border-rose-100 px-3 py-3 focus:ring-2 focus:ring-rose-300">
                                </div>
                            </div>
                            <textarea rows="3" placeholder="Catatan (opsional)" class="w-full rounded-xl border border-rose-100 px-3 py-2 focus:ring-2 focus:ring-rose-300"></textarea>
                            <button class="w-full bg-rose-500 hover:bg-rose-600 text-white font-semibold py-3 rounded-xl">Kirim Transaksi</button>
                            <p id="quickOrderMessage" class="text-sm text-rose-600"></p>
                        </form>
                    </div>
                    <div class="md:w-1/2 space-y-4">
                        <div class="rounded-2xl overflow-hidden shadow">
                            <iframe
                                class="w-full h-64"
                                src="https://www.google.com/maps?q=-7.921757,112.597791&hl=id&z=15&output=embed"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="bg-rose-50 border border-rose-100 rounded-2xl p-4">
                            <p class="text-sm text-slate-700">Jam buka: 09.00 - 20.00 WIB (Senin - Minggu)</p>
                            <p class="text-sm text-slate-700">Pickup & Delivery tersedia.</p>
                            <p class="text-sm text-rose-600 font-semibold">Hubungi: 08xx-xxxx-xxxx</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 reveal">
            <div class="max-w-5xl mx-auto bg-white/90 rounded-3xl shadow-lg p-6 border border-rose-50">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-rose-500 font-semibold">Galeri</p>
                        <h2 class="text-2xl font-bold text-slate-900">Pilihan tema</h2>
                    </div>
                    <a href="/catalog" class="text-sm font-semibold text-rose-600 hover:text-rose-700">Lihat katalog →</a>
                </div>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1505250469679-203ad9ced0cb?auto=format&fit=crop&w=800&q=80" class="h-40 w-full object-cover" alt="Minimalist cake">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-3">
                            <p class="text-white text-sm font-semibold">Minimalist</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1509440159596-0249088772ff?auto=format&fit=crop&w=800&q=80" class="h-40 w-full object-cover" alt="Floral cake">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-3">
                            <p class="text-white text-sm font-semibold">Floral</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?auto=format&fit=crop&w=800&q=80" class="h-40 w-full object-cover" alt="Kids theme">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-3">
                            <p class="text-white text-sm font-semibold">Kids / Character</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1520639888713-7851133b1ed0?auto=format&fit=crop&w=800&q=80" class="h-40 w-full object-cover" alt="Wedding">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-3">
                            <p class="text-white text-sm font-semibold">Wedding</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1607290817808-94d055c778f2?auto=format&fit=crop&w=800&q=80" class="h-40 w-full object-cover" alt="Hampers">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-3">
                            <p class="text-white text-sm font-semibold">Hampers</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden rounded-2xl shadow">
                        <img src="https://images.unsplash.com/photo-1486427944299-d1955d23e34d?auto=format&fit=crop&w=800&q=80" class="h-40 w-full object-cover" alt="Dessert table">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-3">
                            <p class="text-white text-sm font-semibold">Dessert Table</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-12 reveal">
            <div class="max-w-5xl mx-auto bg-white/90 rounded-3xl shadow-lg p-6 border border-rose-50">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-rose-500 font-semibold">FAQ</p>
                        <h2 class="text-2xl font-bold text-slate-900">Pertanyaan umum</h2>
                    </div>
                </div>
                <div class="space-y-3">
                    <details class="group border border-rose-100 rounded-2xl p-4 bg-white">
                        <summary class="flex items-center justify-between cursor-pointer text-slate-900 font-semibold">
                            Berapa lama pemesanan custom cake?
                            <span class="text-rose-500 group-open:rotate-45 transition-transform">+</span>
                        </summary>
                        <p class="mt-2 text-sm text-slate-700">Minimal H-2 untuk desain sederhana, H-5 untuk desain kompleks. Same-day hanya untuk stok ready.</p>
                    </details>
                    <details class="group border border-rose-100 rounded-2xl p-4 bg-white">
                        <summary class="flex items-center justify-between cursor-pointer text-slate-900 font-semibold">
                            Apakah bisa delivery?
                            <span class="text-rose-500 group-open:rotate-45 transition-transform">+</span>
                        </summary>
                        <p class="mt-2 text-sm text-slate-700">Bisa. Area tertentu tersedia same-day. Lainnya via kurir terjadwal dengan packing aman.</p>
                    </details>
                    <details class="group border border-rose-100 rounded-2xl p-4 bg-white">
                        <summary class="flex items-center justify-between cursor-pointer text-slate-900 font-semibold">
                            Bisakah bayar DP dulu?
                            <span class="text-rose-500 group-open:rotate-45 transition-transform">+</span>
                        </summary>
                        <p class="mt-2 text-sm text-slate-700">Bisa DP 50% untuk custom; pelunasan sebelum kirim/ambil.</p>
                    </details>
                </div>
            </div>
        </section>
    </main>

    <footer class="mt-8">
        <div class="max-w-6xl mx-auto px-4 py-10 bg-gradient-to-r from-rose-50 via-white to-pink-50 border border-rose-100 rounded-t-3xl shadow-inner">
            <div class="grid md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <span>© {{ date('Y') }} keiKueCake.</span>
                        <span class="text-rose-500 font-semibold">Maniskan harimu.</span>
                    </div>
                    <p class="text-sm text-slate-700">Toko kue dengan rasa premium, kustom desain, dan layanan cepat.</p>
                </div>
                <div class="space-y-2">
                    <p class="text-sm font-semibold text-slate-900">Kontak</p>
                    <p class="text-sm text-slate-700">IG: <span class="text-rose-500 font-semibold">@keiKueCake</span></p>
                    <p class="text-sm text-slate-700">WA: 08xx-xxxx-xxxx</p>
                    <p class="text-sm text-slate-700">Email: hello@keikuecake.com</p>
                </div>
                <div class="space-y-3">
                    <p class="text-sm font-semibold text-slate-900">Aksi cepat</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="/catalog" class="px-4 py-2 rounded-full bg-white text-rose-600 font-semibold shadow border border-rose-100 hover:bg-rose-50">Katalog</a>
                        <a href="/login" class="px-4 py-2 rounded-full bg-rose-500 text-white font-semibold shadow hover:bg-rose-600">Login</a>
                    </div>
                    <p class="text-xs text-slate-500">Jam buka: 09.00 - 20.00 WIB (Senin - Minggu).</p>
                </div>
            </div>
        </div>
    </footer>

    <div id="toast" class="fixed top-4 right-4 z-50 max-w-xs hidden"></div>

    <script>
        const bestGrid = document.getElementById('bestGrid');
        const bestError = document.getElementById('bestError');
        const quickOrderForm = document.getElementById('quickOrderForm');
        const quickOrderMessage = document.getElementById('quickOrderMessage');
        const navAuthBtn = document.getElementById('navAuthBtn');
        const productSelect = document.getElementById('productSelect');
        const productInfo = document.getElementById('productInfo');
        const orderQty = document.getElementById('orderQty');
        let orderProducts = [];
        const heroImageA = document.getElementById('heroImageA');
        const heroImageB = document.getElementById('heroImageB');
        let heroImages = [
            "{{ asset('images/hero-1.jpg') }}",
            "{{ asset('images/hero-2.jpg') }}",
        ];
        let heroIndex = 0;
        let heroActiveA = true;

        async function loadBest() {
            bestGrid.innerHTML = '<div class="text-slate-500">Memuat produk...</div>';
            try {
                const res = await fetch('/api/public/products');
                if (!res.ok) throw new Error();
                const data = await res.json();
                const items = data.data.slice(0, 6);
                bestGrid.innerHTML = '';
                if (items.length === 0) {
                    bestGrid.innerHTML = '<div class="text-slate-500">Belum ada produk.</div>';
                    return;
                }
                items.forEach(p => {
                    const card = document.createElement('div');
                    card.className = 'bg-white/90 rounded-2xl shadow-lg p-4 border border-pink-100 flex gap-4';
                    const img = p.image ? `<img src="${p.image}" alt="${p.name}" class="w-24 h-24 object-cover rounded-xl border border-rose-50">` : `<div class="w-24 h-24 rounded-xl bg-gradient-to-br from-rose-50 to-pink-100 border border-rose-100 flex items-center justify-center text-rose-400 text-xs">No Image</div>`;
                    card.innerHTML = `
                        ${img}
                        <div class="flex-1">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <p class="font-semibold text-slate-900">${p.name}</p>
                                    <p class="text-xs text-slate-500">Stok: ${p.stock}</p>
                                </div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-pink-100 text-rose-600">Sweet</span>
                            </div>
                            <p class="text-lg font-bold text-rose-500">Rp ${Number(p.price).toLocaleString('id-ID')}</p>
                            <p class="text-sm text-slate-600 mt-2">${p.description ?? ''}</p>
                        </div>
                    `;
                    bestGrid.appendChild(card);
                });
            } catch (e) {
                bestError.textContent = 'Gagal memuat produk favorit.';
            }
        }

        function setHeroImage() {
            if (!heroImageA || !heroImageB) return;
            const nextSrc = heroImages[heroIndex] || heroImages[0];
            if (heroActiveA) {
                heroImageB.src = nextSrc;
                heroImageB.classList.remove('hidden');
                heroImageA.classList.add('hidden');
            } else {
                heroImageA.src = nextSrc;
                heroImageA.classList.remove('hidden');
                heroImageB.classList.add('hidden');
            }
            heroActiveA = !heroActiveA;
        }

        // Tampilkan hero statis dari dua gambar lokal dengan transisi sederhana
        setHeroImage();
        if (heroImages.length > 1) {
            setInterval(() => {
                heroIndex = (heroIndex + 1) % heroImages.length;
                setHeroImage();
            }, 4000);
        }

        async function loadOrderProducts() {
            if (!productSelect) return;
            productSelect.innerHTML = '<option>Memuat produk...</option>';
            productSelect.disabled = true;
            productInfo.textContent = '';
            try {
                const res = await fetch('/api/public/products', { headers: { 'Accept': 'application/json' } });
                if (!res.ok) throw new Error();
                const data = await res.json();
                orderProducts = (data.data || []).filter(p => (p.stock ?? 0) > 0);
                if (!orderProducts.length) {
                    productSelect.innerHTML = '<option value=\"\">Stok kosong</option>';
                    productInfo.textContent = 'Tidak ada produk siap dipesan.';
                    return;
                }
                productSelect.innerHTML = orderProducts.map(p => `<option value=\"${p.uuid}\">${p.name} (stok: ${p.stock})</option>`).join('');
                productSelect.disabled = false;
                updateProductInfo();
            } catch (e) {
                productSelect.innerHTML = '<option value=\"\">Gagal memuat produk</option>';
                productInfo.textContent = 'Periksa koneksi atau login ulang.';
            }
        }

        function showToast(message, type = 'info') {
            const toast = document.getElementById('toast');
            if (!toast) return;
            const colors = {
                success: 'bg-emerald-500 text-white',
                error: 'bg-rose-500 text-white',
                info: 'bg-slate-800 text-white',
            };
            toast.className = `fixed top-4 right-4 z-50 max-w-xs px-4 py-3 rounded-xl shadow-lg text-sm ${colors[type] || colors.info}`;
            toast.textContent = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 2500);
        }

        function updateProductInfo() {
            if (!productSelect || !productInfo) return;
            const selected = orderProducts.find(p => p.uuid === productSelect.value);
            if (!selected) {
                productInfo.textContent = '';
                return;
            }
            productInfo.textContent = `Harga: Rp ${Number(selected.price).toLocaleString('id-ID')} | Stok: ${selected.stock}`;
            if (selected.stock <= 0) {
                quickOrderMessage.textContent = 'Barang tidak tersedia.';
            } else {
                quickOrderMessage.textContent = '';
            }
        }

        productSelect?.addEventListener('change', updateProductInfo);

        quickOrderForm?.addEventListener('submit', async (e) => {
            e.preventDefault();
            quickOrderMessage.textContent = '';
            const token = localStorage.getItem('token');
            if (!token) {
                quickOrderMessage.textContent = 'Login dulu untuk memesan.';
                setTimeout(() => (window.location.href = '/login'), 600);
                return;
            }
            const selected = orderProducts.find(p => p.uuid === productSelect.value);
            const qty = Number(orderQty?.value || 1);
            if (!selected) {
                quickOrderMessage.textContent = 'Pilih produk yang tersedia.';
                showToast('Pilih produk yang tersedia.', 'error');
                return;
            }
            if (qty <= 0) {
                quickOrderMessage.textContent = 'Qty minimal 1.';
                showToast('Qty minimal 1.', 'error');
                return;
            }
            if (selected.stock < qty) {
                quickOrderMessage.textContent = 'Barang tidak tersedia atau stok kurang.';
                showToast('Barang tidak tersedia atau stok kurang.', 'error');
                return;
            }
            try {
                const res = await fetch('/api/transactions/public', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${token}`,
                    },
                    body: JSON.stringify({
                        product_uuid: selected.uuid,
                        qty,
                    })
                });
                const data = await res.json();
                if (!res.ok) {
                    quickOrderMessage.textContent = data.message || 'Gagal membuat transaksi.';
                    showToast(quickOrderMessage.textContent, 'error');
                    return;
                }
                quickOrderMessage.textContent = 'Pesanan berhasil dibuat!';
                showToast('Pesanan berhasil dibuat!', 'success');
                // kurangi stok lokal dan refresh info
                selected.stock = Math.max(0, selected.stock - qty);
                updateProductInfo();
                loadBest(); // segarkan tampilan favorit
                if (selected.stock <= 0) {
                    loadOrderProducts();
                }
            } catch (err) {
                quickOrderMessage.textContent = 'Terjadi kesalahan. Coba lagi.';
                showToast('Terjadi kesalahan. Coba lagi.', 'error');
            }
        });

        (function syncNavAuth() {
            if (!navAuthBtn) return;
            const token = localStorage.getItem('token');
            const role = localStorage.getItem('role');
            if (!token) {
                navAuthBtn.textContent = 'Login';
                navAuthBtn.href = '/login';
                return;
            }
            if (role === 'admin') {
                navAuthBtn.textContent = 'Dashboard';
                navAuthBtn.href = '/dashboard';
            } else {
                navAuthBtn.remove(); // user tetap pakai link katalog di nav utama
            }
        })();

        loadBest();
        loadOrderProducts();
        // Reveal on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-visible');
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>
