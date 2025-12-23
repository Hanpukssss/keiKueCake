@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-4">
    <div>
        <h2 class="text-xl font-semibold">Produk</h2>
        <p class="text-slate-600 text-sm">CRUD produk dengan identitas UUID, terlindungi JWT.</p>
    </div>
    <button id="refreshProducts" class="px-3 py-2 text-sm font-semibold bg-slate-900 text-white rounded-lg cursor-pointer hover:-translate-y-0.5 transition">Muat ulang</button>
    </div>

<div class="grid md:grid-cols-3 gap-4 mb-6">
    <div class="md:col-span-2 bg-white shadow rounded-2xl p-4">
        <div class="flex items-center justify-between mb-3">
            <h3 class="font-semibold">Daftar Produk</h3>
            <span id="productCount" class="text-sm text-slate-600"></span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-slate-600">
                        <th class="py-2">Nama</th>
                        <th class="py-2">Harga</th>
                        <th class="py-2">Stok</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody id="productTable" class="divide-y divide-slate-100"></tbody>
            </table>
        </div>
    </div>
        <div class="bg-white shadow rounded-2xl p-4">
        <h3 class="font-semibold mb-3">Tambah Produk</h3>
        <form id="productForm" class="space-y-3" enctype="multipart/form-data">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                <input name="name" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Harga</label>
                <input name="price" type="number" min="0" step="0.01" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Stok</label>
                <input name="stock" type="number" min="0" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full rounded-lg border border-slate-200 px-3 py-2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Gambar</label>
                <input name="image" type="file" accept="image/*" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <p class="text-xs text-slate-500 mt-1">Opsional, unggah gambar produk.</p>
            </div>
            <button class="w-full bg-rose-500 hover:bg-rose-600 text-white font-semibold py-2 rounded-lg">Simpan</button>
            <p id="productError" class="text-sm text-rose-600"></p>
        </form>
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
    <div class="relative max-w-lg mx-auto mt-16 bg-white rounded-2xl shadow-2xl p-6 border border-rose-50">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Edit Produk</h3>
            <button id="closeEditModal" class="text-slate-500 hover:text-slate-800">✕</button>
        </div>
        <form id="editForm" class="space-y-3" enctype="multipart/form-data">
            <input type="hidden" name="uuid" id="editUuid">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                <input id="editName" name="name" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Harga</label>
                    <input id="editPrice" name="price" type="number" min="0" step="0.01" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Stok</label>
                    <input id="editStock" name="stock" type="number" min="0" required class="w-full rounded-lg border border-slate-200 px-3 py-2">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
                <textarea id="editDescription" name="description" rows="3" class="w-full rounded-lg border border-slate-200 px-3 py-2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Gambar baru (opsional)</label>
                <input id="editImage" name="image" type="file" accept="image/*" class="w-full rounded-lg border border-slate-200 px-3 py-2">
                <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak mengubah gambar.</p>
            </div>
            <div class="flex items-center justify-end gap-2 pt-2">
                <button type="button" id="cancelEdit" class="px-4 py-2 rounded-lg border border-slate-200 text-slate-600">Batal</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-rose-500 text-white font-semibold shadow hover:bg-rose-600">Simpan</button>
            </div>
            <p id="editError" class="text-sm text-rose-600"></p>
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
    const productTable = document.getElementById('productTable');
    const productForm = document.getElementById('productForm');
    const productError = document.getElementById('productError');
    const productCount = document.getElementById('productCount');
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editForm');
    const editError = document.getElementById('editError');

    async function loadProducts() {
        productTable.innerHTML = '<tr><td class="py-3 text-slate-500" colspan="4">Memuat...</td></tr>';
        try {
            const res = await fetch('/api/products', { headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' } });
            if (!res.ok) {
                productTable.innerHTML = '<tr><td class="py-3 text-rose-600" colspan="4">Gagal memuat data (cek login/token)</td></tr>';
                if (res.status === 401 || res.status === 403) {
                    showToast('Token tidak valid, silakan login ulang.', 'error');
                    localStorage.removeItem('token');
                    localStorage.removeItem('role');
                    setTimeout(() => window.location.href = '/login', 800);
                }
                return;
            }
            const data = await res.json();
            productCount.textContent = `${data.total} produk`;
            productTable.innerHTML = '';
            data.data.forEach(item => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td class="py-2 flex items-center gap-2">
                    ${item.image ? `<img src="${item.image}" alt="${item.name}" class="h-10 w-10 object-cover rounded">` : `<div class="h-10 w-10 rounded bg-gradient-to-br from-rose-50 to-pink-100 border border-rose-100 flex items-center justify-center text-[10px] text-rose-500">No Img</div>`}
                    <span>${item.name}</span>
                </td>
                <td class="py-2">Rp ${Number(item.price).toLocaleString('id-ID')}</td>
                <td class="py-2">${item.stock}</td>
                <td class="py-2 flex gap-2">
                    <button class="text-rose-600 font-semibold cursor-pointer hover:text-rose-700" data-action="edit">Edit</button>
                    <button class="text-slate-500 cursor-pointer hover:text-slate-700" data-action="delete">Hapus</button>
                </td>
            `;
                tr.dataset.uuid = item.uuid;
                productTable.appendChild(tr);
            });
        } catch (err) {
            productTable.innerHTML = '<tr><td class="py-3 text-rose-600" colspan="4">Gagal memuat data (jaringan/server)</td></tr>';
            showToast('Gagal memuat data produk', 'error');
        }
    }

    productForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        productError.textContent = '';
        const formData = new FormData(productForm);
        const res = await fetch('/api/products', {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
            },
            body: formData
        });
        const data = await res.json();
        if (!res.ok) {
            productError.textContent = data.message || 'Gagal menyimpan produk';
            showToast(data.message || 'Gagal menyimpan produk', 'error');
            return;
        }
        productForm.reset();
        showToast('Produk berhasil ditambahkan', 'success');
        await loadProducts();
    });

    productTable.addEventListener('click', async (e) => {
        const btn = e.target;
        const action = btn.dataset.action;
        if (!action) return;
        const uuid = btn.closest('tr').dataset.uuid;
        if (action === 'delete') {
            if (!confirm('Hapus produk ini?')) return;
            const res = await fetch(`/api/products/${uuid}`, {
                method: 'DELETE',
                headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
            });
            if (res.ok) {
                showToast('Produk dihapus', 'success');
                await loadProducts();
            }
        }
        if (action === 'edit') {
            editError.textContent = '';
            const res = await fetch(`/api/products/${uuid}`, {
                headers: { 'Authorization': `Bearer ${token}`, 'Accept': 'application/json' }
            });
            if (!res.ok) {
                showToast('Gagal memuat produk', 'error');
                return;
            }
            const data = await res.json();
            document.getElementById('editUuid').value = data.uuid;
            document.getElementById('editName').value = data.name ?? '';
            document.getElementById('editPrice').value = data.price ?? '';
            document.getElementById('editStock').value = data.stock ?? '';
            document.getElementById('editDescription').value = data.description ?? '';
            document.getElementById('editImage').value = '';
            editModal.classList.remove('hidden');
        }
    });

    document.getElementById('closeEditModal')?.addEventListener('click', () => editModal.classList.add('hidden'));
    document.getElementById('cancelEdit')?.addEventListener('click', () => editModal.classList.add('hidden'));

    editForm?.addEventListener('submit', async (e) => {
        e.preventDefault();
        editError.textContent = '';
        const uuid = document.getElementById('editUuid').value;
        const formData = new FormData(editForm);
        formData.append('_method', 'PUT');
        const res = await fetch(`/api/products/${uuid}`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
            },
            body: formData,
        });
        const data = await res.json();
        if (!res.ok) {
            editError.textContent = data.message || 'Gagal memperbarui produk';
            showToast(data.message || 'Gagal memperbarui produk', 'error');
            return;
        }
        showToast('Produk diperbarui', 'success');
        editModal.classList.add('hidden');
        await loadProducts();
    });

    document.getElementById('refreshProducts')?.addEventListener('click', loadProducts);
    loadProducts();
</script>
@endsection
