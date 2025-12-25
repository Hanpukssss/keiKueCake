@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-xl font-semibold">Transaksi</h2>
        <p class="text-slate-600 text-sm">Mencatat transaksi dan otomatis mengurangi stok produk.</p>
    </div>
    <button id="refreshTransactions" class="px-3 py-2 text-sm font-semibold bg-slate-900 text-white rounded-lg">Muat ulang</button>
</div>

<div class="grid md:grid-cols-3 gap-4 mb-6">
    <div class="md:col-span-2 bg-white shadow rounded-2xl p-4">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold">Daftar Transaksi</h3>
            <span id="transactionCount" class="text-sm text-slate-600"></span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-600">
                        <th class="py-2">Produk</th>
                        <th class="py-2">Qty</th>
                        <th class="py-2">Total</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="transactionTable" class="divide-y divide-slate-100"></tbody>
            </table>
        </div>
    </div>
    <div class="bg-white shadow rounded-2xl p-4">
        <h3 class="font-semibold mb-3">Buat Transaksi</h3>
        <form id="transactionForm" class="space-y-3">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Produk</label>
                <select name="product_uuid" id="productSelect" required class="w-full rounded-lg border border-slate-200 px-3 py-2"></select>
                <p id="productInfo" class="text-xs text-slate-500 mt-1"></p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Qty</label>
                <input name="qty" type="number" min="1" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <button class="w-full bg-rose-500 hover:bg-rose-600 text-white font-semibold py-2 rounded-lg">Simpan</button>
            <p id="transactionError" class="text-sm text-rose-600"></p>
        </form>
    </div>
</div>

<div id="statusModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
    <div class="relative max-w-md mx-auto mt-20 bg-white rounded-2xl shadow-2xl p-6 border border-rose-50">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Ubah Status Transaksi</h3>
            <button id="closeStatusModal" class="text-slate-500 hover:text-slate-800">✕</button>
        </div>
        <form id="statusForm" class="space-y-3">
            <input type="hidden" id="statusUuid">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                <select id="statusSelect" class="w-full rounded-lg border border-slate-200 px-3 py-2 focus:ring-2 focus:ring-rose-300">
                    <option value="paid">paid</option>
                    <option value="pending">pending</option>
                    <option value="cancelled">cancelled</option>
                </select>
            </div>
            <div class="flex items-center justify-end gap-2">
                <button type="button" id="cancelStatus" class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-rose-500 text-white font-semibold shadow hover:bg-rose-600">Simpan</button>
            </div>
            <p id="statusError" class="text-sm text-rose-600"></p>
        </form>
    </div>
</div>

<script>
    function ensureToken() {
        const token = localStorage.getItem('token');
        if (!token) {
            showToast('Silakan login dulu', 'error');
            window.location.href = '/login';
        }
        if (localStorage.getItem('role') !== 'admin') {
            showToast('Hanya admin yang bisa akses', 'error');
            window.location.href = '/login';
        }
        return token;
    }

    const token = ensureToken();
    const transactionTable = document.getElementById('transactionTable');
    const transactionForm = document.getElementById('transactionForm');
    const transactionError = document.getElementById('transactionError');
    const transactionCount = document.getElementById('transactionCount');
    const productSelect = document.getElementById('productSelect');
    const productInfo = document.getElementById('productInfo');
    const statusModal = document.getElementById('statusModal');
    const statusForm = document.getElementById('statusForm');
    const statusSelect = document.getElementById('statusSelect');
    const statusUuid = document.getElementById('statusUuid');
    const statusError = document.getElementById('statusError');
    let productsCache = [];

    async function loadProductsForSelect() {
        const res = await fetch('/api/products', { headers: { 'Authorization': `Bearer ${token}` } });
        if (!res.ok) return;
        const data = await res.json();
        productsCache = data.data;
        productSelect.innerHTML = data.data.map(p => `<option value="${p.uuid}">${p.name} (stok: ${p.stock})</option>`).join('');
        updateProductInfo();
    }

    function updateProductInfo() {
        const selected = productsCache.find(p => p.uuid === productSelect.value);
        if (!selected) return;
        productInfo.textContent = `Harga: Rp ${Number(selected.price).toLocaleString('id-ID')} | Stok: ${selected.stock}`;
    }

    async function loadTransactions() {
        transactionTable.innerHTML = '<tr><td class="py-3 text-slate-500" colspan="5">Memuat...</td></tr>';
        const res = await fetch('/api/transactions', { headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' } });
        if (!res.ok) {
            transactionTable.innerHTML = '<tr><td class="py-3 text-rose-600" colspan="5">Gagal memuat data</td></tr>';
            if (res.status === 401 || res.status === 403) {
                showToast('Token tidak valid, silakan login ulang.', 'error');
                localStorage.removeItem('token');
                localStorage.removeItem('role');
                setTimeout(() => window.location.href = '/login', 800);
            }
            return;
        }
        const data = await res.json();
        transactionCount.textContent = `${data.total} transaksi`;
        transactionTable.innerHTML = '';
        data.data.forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="py-2">${item.product?.name ?? '-'}</td>
                <td class="py-2">${item.qty}</td>
                <td class="py-2">Rp ${Number(item.total_price).toLocaleString('id-ID')}</td>
                <td class="py-2">
                    <span class="px-2 py-1 rounded-full text-xs bg-slate-100">${item.status}</span>
                </td>
                <td class="py-2 flex gap-2">
                    <button class="text-rose-600 font-semibold cursor-pointer hover:text-rose-700" data-action="status">Ubah Status</button>
                    <button class="text-slate-500 cursor-pointer hover:text-slate-700" data-action="delete">Hapus</button>
                </td>
            `;
            tr.dataset.uuid = item.uuid;
            tr.dataset.status = item.status;
            transactionTable.appendChild(tr);
        });
    }

    transactionForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        transactionError.textContent = '';
        const formData = new FormData(transactionForm);
        const payload = {
            product_uuid: formData.get('product_uuid'),
            qty: Number(formData.get('qty')),
        };
        const res = await fetch('/api/transactions', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (!res.ok) {
            transactionError.textContent = data.message || 'Gagal membuat transaksi';
            showToast(data.message || 'Gagal membuat transaksi', 'error');
            return;
        }
        transactionForm.reset();
        showToast('Transaksi dibuat', 'success');
        await loadProductsForSelect();
        await loadTransactions();
    });

    transactionTable.addEventListener('click', async (e) => {
        const btn = e.target;
        const action = btn.dataset.action;
        if (!action) return;
        const uuid = btn.closest('tr').dataset.uuid;
        if (action === 'delete') {
            if (!confirm('Hapus transaksi ini? (stok akan dikembalikan)')) return;
            const res = await fetch(`/api/transactions/${uuid}`, {
                method: 'DELETE',
                headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
            });
            if (res.ok) {
                showToast('Transaksi dihapus', 'success');
                await loadProductsForSelect();
                await loadTransactions();
            } else {
                showToast('Gagal menghapus transaksi', 'error');
            }
        }
        if (action === 'status') {
            statusError.textContent = '';
            statusUuid.value = uuid;
            const currentStatus = btn.closest('tr').dataset.status || 'pending';
            statusSelect.value = currentStatus;
            statusModal.classList.remove('hidden');
        }
    });

    document.getElementById('closeStatusModal')?.addEventListener('click', () => statusModal.classList.add('hidden'));
    document.getElementById('cancelStatus')?.addEventListener('click', () => statusModal.classList.add('hidden'));

    statusForm?.addEventListener('submit', async (e) => {
        e.preventDefault();
        statusError.textContent = '';
        const uuid = statusUuid.value;
        const status = statusSelect.value;
        const res = await fetch(`/api/transactions/${uuid}`, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status })
        });
        const data = await res.json();
        if (!res.ok) {
            statusError.textContent = data.message || 'Gagal mengubah status';
            showToast(data.message || 'Gagal mengubah status', 'error');
            return;
        }
        showToast('Status transaksi diubah', 'success');
        statusModal.classList.add('hidden');
        await loadTransactions();
    });

    productSelect.addEventListener('change', updateProductInfo);
    document.getElementById('refreshTransactions')?.addEventListener('click', () => {
        loadProductsForSelect();
        loadTransactions();
    });

    loadProductsForSelect();
    loadTransactions();
</script>
@endsection
