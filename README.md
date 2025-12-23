# keiKueCake – UAP Pemrograman Web

Stack: Laravel 12 + JWT + Tailwind (Blade). Fitur utama: autentikasi JWT, CRUD Produk (UUID), CRUD Transaksi yang otomatis mengurangi stok, dashboard terlindungi token.

## Setup
1. `composer install`
2. `npm install`
3. Salin `.env` (atau pakai yang sudah ada) dan set DB.
4. `php artisan key:generate`
5. `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"` (sekali saja)
6. `php artisan jwt:secret`
7. `php artisan migrate`
8. `php artisan db:seed`
9. Jalankan dev: `npm run dev` dan `php artisan serve`

Halaman web:
- `/login` (masuk), `/register` (daftar)
- `/dashboard`, `/products`, `/transactions` (khusus admin)
- `/catalog` katalog publik (tanpa login)

## API Ringkas
- Auth: `POST /api/auth/register|login|refresh|logout`, `GET /api/auth/me`
- Produk admin (JWT + admin): `GET/POST /api/products`, `GET/PUT/DELETE /api/products/{uuid}`
- Transaksi admin (JWT + admin): `GET/POST /api/transactions`, `GET/PUT/DELETE /api/transactions/{uuid}`
- Publik (tanpa login): `GET /api/public/products`, `GET /api/public/products/{uuid}`

Payload contoh:
```json
// login
{ "email": "test@example.com", "password": "password" }
// buat produk
{ "name": "Kue Brownies", "price": 25000, "stock": 10, "description": "Brownies lumer" }
// buat transaksi
{ "product_uuid": "<uuid-produk>", "qty": 2 }
```

## Testing
`php artisan test` menjalankan skenario:
- register/login JWT
- CRUD produk dengan token
- transaksi mengurangi stok produk

## Catatan
- Token disimpan di `localStorage` pada front-end sederhana Blade + fetch.
- Stok dikurangi lewat transaksi DB atomik, transaksi delete akan mengembalikan stok.
- Role: admin (akses CRUD), user (view katalog saja). Seeder membuat `admin@gmail.com` / `admin123`.
