# Panduan Instalasi Sistem Manajemen Perpustakaan USK

## Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js dan npm
- Database MySQL/MariaDB
- Git

## Langkah-Langkah Instalasi

### 1. Clone Repository atau Extract Project
```bash
cd d:\final-usk\perpusUSK
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Install Dependensi JavaScript
```bash
npm install
```

### 4. Setup Environment
```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi:
- Database name
- Database username
- Database password
- App URL
- Mail configuration (jika diperlukan)

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Jalankan Database Migration
```bash
php artisan migrate
```

### 7. (Optional) Jalankan Database Seeder
```bash
php artisan db:seed
```

### 8. Build Assets
```bash
npm run build
```

Atau untuk mode development dengan auto-reload:
```bash
npm run dev
```

### 9. Jalankan Server Lokal

Terminal 1 - Laravel Server:
```bash
php artisan serve
```

Terminal 2 - Vite Development Server (jika menggunakan npm run dev):
```bash
npm run dev
```

Server akan berjalan di: `http://localhost:8000`

## Verifikasi Instalasi

1. Buka browser dan akses `http://localhost:8000`
2. Jika halaman welcome muncul, instalasi berhasil
3. Lakukan migrasi database jika belum
4. Buat akun petugas pertama untuk memulai

## Troubleshooting

### Jika migration gagal:
```bash
php artisan migrate:reset
php artisan migrate
```

### Jika asset tidak dimuat:
```bash
npm run build
php artisan cache:clear
```

### Jika mendapat error permission:
Pastikan folder `storage` dan `bootstrap/cache` memiliki write permission:
```bash
chmod -R 755 storage bootstrap/cache
```

## Struktur Folder Penting

- `app/` - Kode aplikasi (Models, Controllers, Middleware)
- `routes/` - Definisi routes
- `resources/views/` - Template Blade
- `database/migrations/` - Migrasi database
- `database/seeders/` - Data seeder
- `public/` - File publik
- `storage/` - File upload dan logs

## Selesai

Sistem manajemen perpustakaan sudah siap digunakan!

# Panduan Penggunaan Sistem Manajemen Perpustakaan USK

## 📋 Daftar Isi
- [Alur Petugas Perpustakaan](#alur-petugas-perpustakaan)
- [Alur Pengunjung/Member](#alur-pengunjungmember)

---

## 👨‍💼 Alur Petugas Perpustakaan

### 1. Manajemen Akun Petugas

#### Membuat Akun Petugas Baru
1. Login sebagai admin/petugas utama
2. Navigasi ke menu **Users Management** atau **Kelola Petugas**
3. Klik tombol **Tambah Petugas**
4. Isi form dengan data:
   - Username (unik)
   - Email
   - Password
   - Konfirmasi Password
5. Klik **Simpan** atau **Create**

#### Menghapus Akun Petugas
1. Masuk ke menu **Users Management**
2. Cari petugas yang ingin dihapus dari daftar
3. Klik tombol **Delete** atau **Hapus** pada baris petugas tersebut
4. Konfirmasi penghapusan
5. Akun petugas berhasil dihapus dari sistem

### 2. Login Petugas

1. Akses halaman login: `http://localhost:8000/login`
2. Masukkan **Username** dan **Password** yang telah dibuat
3. Klik tombol **Login**
4. Jika berhasil, Anda akan diarahkan ke **Dashboard Petugas**

### 3. Manajemen Buku

#### Melihat Daftar Buku (Books Index)
1. Dari dashboard, klik menu **Buku** atau **Books**
2. Halaman `books.index` akan menampilkan:
   - Tabel daftar semua buku
   - Judul, Kategori, Pengarang, Penerbit
   - Jumlah stok tersedia
3. Gunakan fitur pencarian untuk menemukan buku tertentu

#### Membuat Buku Baru
1. Di halaman daftar buku, klik tombol **Tambah Buku** atau **Add Book**
2. Isi form dengan:
   - **Judul Buku** (required)
   - **Pengarang** (required)
   - **Penerbit** (required)
   - **Kategori** (pilih dari dropdown)
   - **ISBN** (opsional)
   - **Stok/Jumlah Buku** (required)
   - **Deskripsi** (opsional)
3. Klik **Simpan** atau **Create**
4. Buku berhasil ditambahkan ke sistem

#### Edit Buku
1. Di halaman daftar buku, cari buku yang ingin diubah
2. Klik tombol **Edit** pada baris buku tersebut
3. Ubah data yang diperlukan:
   - Judul, Pengarang, Penerbit, Kategori, Stok, dll
4. Klik **Simpan** atau **Update**
5. Perubahan berhasil disimpan

#### Delete Buku
1. Di halaman daftar buku, cari buku yang ingin dihapus
2. Klik tombol **Delete** atau **Hapus**
3. Konfirmasi penghapusan
4. Buku berhasil dihapus dari sistem

### 4. Manajemen Kategori Buku

#### Melihat Daftar Kategori
1. Klik menu **Kategori** di sidebar
2. Tampilan tabel dengan daftar semua kategori buku

#### Membuat Kategori Baru
1. Di halaman kategori, klik **Tambah Kategori** atau **Add Category**
2. Isi form:
   - **Nama Kategori** (required)
   - **Deskripsi** (opsional)
3. Klik **Simpan** atau **Create**

#### Edit Kategori
1. Cari kategori yang ingin diubah
2. Klik tombol **Edit**
3. Ubah nama atau deskripsi kategori
4. Klik **Simpan** atau **Update**

#### Delete Kategori
1. Cari kategori yang ingin dihapus
2. Klik tombol **Delete** atau **Hapus**
3. Konfirmasi penghapusan
4. Kategori berhasil dihapus

### 5. Persetujuan Request Peminjaman

#### Melihat Daftar Request Peminjaman
1. Klik menu **Request Peminjaman** di sidebar
2. Tampilan tabel akan menampilkan:
   - Nama Pengunjung
   - Buku yang Diminta
   - Tanggal Request
   - Status (Pending/Menunggu, Approved/Disetujui, Rejected/Ditolak)

#### Menyetujui Request Peminjaman
1. Cari request yang status-nya **Pending** (Menunggu)
2. Klik tombol **Approve** atau **Setujui**
3. Opsional: Tambahkan catatan atau durasi peminjaman
4. Klik **Confirm** untuk mengonfirmasi persetujuan
5. Status berubah menjadi **Approved** dan transaksi peminjaman dibuat

#### Menolak Request Peminjaman
1. Cari request yang ingin ditolak
2. Klik tombol **Reject** atau **Tolak**
3. Opsional: Tambahkan alasan penolakan
4. Klik **Confirm** untuk mengonfirmasi penolakan
5. Status berubah menjadi **Rejected**

### 6. Melihat Riwayat Transaksi

#### Mengakses Riwayat Transaksi
1. Klik menu **Transaksi** atau **Riwayat Peminjaman** di sidebar
2. Halaman akan menampilkan tabel dengan:
   - Nama Pengunjung
   - Buku yang Dipinjam
   - Tanggal Peminjaman
   - Tanggal Pengembalian (target)
   - Status Transaksi (Sedang Dipinjam, Sudah Dikembalikan, Terlambat)
3. Gunakan filter untuk melihat transaksi berdasarkan:
   - Status
   - Tanggal
   - Nama pengunjung

#### Update Status Pengembalian
1. Ketika pengunjung mengembalikan buku, cari transaksi tersebut
2. Klik tombol **Mark as Returned** atau **Tandai Dikembalikan**
3. Konfirmasi tanggal pengembalian
4. Status transaksi berubah menjadi **Sudah Dikembalikan**

---

## 👥 Alur Pengunjung/Member

### 1. Login Pengunjung

#### Kondisi Awal
- Pengunjung sudah memiliki akun yang dibuat oleh petugas di dunia nyata
- Pengunjung telah diberikan **Username** dan **Password** oleh petugas

#### Proses Login
1. Akses halaman login: `http://localhost:8000/login`
2. Masukkan **Username** dan **Password** yang diberikan petugas
3. Klik tombol **Login**
4. Jika berhasil, Anda akan diarahkan ke **Halaman Daftar Buku**

### 2. Melihat Daftar Buku (Books List)

#### Mengakses Halaman Daftar Buku
1. Setelah login berhasil, Anda otomatis diarahkan ke halaman `books.list`
2. Halaman ini menampilkan:
   - Daftar semua buku yang tersedia
   - Informasi setiap buku:
     - Judul
     - Pengarang
     - Penerbit
     - Kategori
     - Stok tersedia
     - Deskripsi singkat (jika ada)

#### Mencari Buku
1. Gunakan fitur pencarian di halaman
2. Ketik **judul buku** atau **kategori** yang dicari
3. Hasil pencarian akan ditampilkan secara real-time

#### Filter Buku
1. Filter berdasarkan **Kategori** menggunakan dropdown
2. Tampilkan hanya buku dari kategori yang dipilih

### 3. Request Peminjaman Buku

#### Melakukan Request Peminjaman
1. Di halaman daftar buku, temukan buku yang ingin dipinjam
2. Klik tombol **Pinjam** atau **Request Peminjaman** pada buku tersebut
3. Popup atau form akan muncul dengan:
   - Nama Buku (otomatis terisi)
   - Nama Pengunjung (otomatis terisi dari akun login)
   - Durasi Peminjaman (pilihan atau input manual)
   - Catatan tambahan (opsional)
4. Klik **Submit** atau **Ajukan Request**
5. Request berhasil dikirim, status berubah menjadi **Pending** (Menunggu Persetujuan)

#### Memantau Status Request
1. Pengunjung dapat melihat status request peminjaman di halaman akun/dashboard mereka
2. Status yang mungkin:
   - **Pending** (Menunggu Persetujuan) - Petugas belum merespons
   - **Approved** (Disetujui) - Buku siap dipinjam, ambil di perpustakaan
   - **Rejected** (Ditolak) - Request ditolak, petugas mungkin memberikan alasan
3. Jika disetujui, pengunjung dapat datang ke perpustakaan untuk mengambil buku

#### Pengembalian Buku
1. Datang ke perpustakaan dengan buku yang dipinjam
2. Serahkan buku kepada petugas
3. Petugas akan memperbarui status transaksi menjadi **Sudah Dikembalikan**
4. Pengunjung dapat melihat riwayat peminjaman mereka di akun

---

## 📊 Ringkasan Menu Utama

### Menu Petugas
| Menu | Fungsi |
|------|--------|
| Dashboard | Melihat overview sistem |
| Buku | CRUD buku (Create, Read, Update, Delete) |
| Kategori | CRUD kategori buku |
| Request Peminjaman | Menyetujui/Menolak request dari pengunjung |
| Transaksi | Melihat riwayat peminjaman dan pengembalian |
| Kelola Petugas | Membuat/menghapus akun petugas |

### Menu Pengunjung
| Menu | Fungsi |
|------|--------|
| Dashboard | Melihat overview akun pengunjung |
| Daftar Buku | Melihat dan mencari buku |
| Request Saya | Melihat status request peminjaman |
| Riwayat | Melihat riwayat peminjaman |

---

## ⚠️ Catatan Penting

1. **Akun Pengunjung**: Hanya dapat dibuat oleh petugas, tidak ada fitur self-registration
2. **Password**: Pastikan petugas memberikan password yang aman kepada pengunjung
3. **Stok Buku**: Petugas harus memastikan stok buku selalu ter-update
4. **Request Peminjaman**: Pengunjung hanya dapat request buku yang stoknya tersedia
5. **Durasi Peminjaman**: Disesuaikan dengan kebijakan perpustakaan (dapat dikonfigurasi oleh petugas)

---

Selamat menggunakan Sistem Manajemen Perpustakaan USK!
