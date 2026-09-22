# BPS Provinsi Sulawesi Selatan - Laravel

Project ini melanjutkan project Laravel yang sudah ada dan mengintegrasikan fitur dari website BPS PHP Native lama.

## Fitur
- Home/dashboard BPS Sulawesi Selatan
- Login/logout berbasis Laravel session
- CRUD Publikasi
- Upload cover publikasi menggunakan Laravel Storage
- Link publikasi
- Pencarian publikasi
- Galeri
- BPS WebAPI
- Open-Meteo
- BMKG gempa terbaru
- Vite + Bootstrap/Sass

## Akun awal
- Username: `admin`
- Password: `admin123`

Password tersebut dibuat melalui `DatabaseSeeder`. Ganti setelah instalasi jika diperlukan.

## Menjalankan
```bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
npm run dev
```

Pada terminal lain:
```bash
php artisan serve
```

Buka `http://127.0.0.1:8000`.

## BPS WebAPI
Isi `BPS_API_KEY` atau `BPS_APP_ID` pada `.env`. Domain Sulawesi Selatan menggunakan `7300`. Jangan menaruh credential pada controller atau Blade.

## Database MySQL
`.env` bawaan project diarahkan ke:
- database: `webbps_laravel`
- host: `127.0.0.1`
- port: `3306`
- username: `root`
- password: kosong

Jika database belum ada, buat:
```sql
CREATE DATABASE IF NOT EXISTS webbps_laravel;
```
Lalu jalankan migration.

## Storage
Cover publikasi disimpan di `storage/app/public/publikasi` dan ditampilkan melalui `/storage/...` setelah `php artisan storage:link`.
