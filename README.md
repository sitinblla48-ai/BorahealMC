# Sistem Registrasi Pasien RS - Boraheal Medical Center

Aplikasi Sistem Registrasi Pasien Rumah Sakit berbasis web ini dikembangkan menggunakan framework **CodeIgniter 3** dan **PHP 7.3** (kompatibel dengan XAMPP 7.3). Menggunakan **Bootstrap 5**, **DataTables**, **SweetAlert2**, serta **FPDF** manual untuk ekspor laporan pendaftaran ke PDF.

Aplikasi ini menggunakan konvensi penamaan entitas bahasa Indonesia (*Admin, Pasien, Dokter, Pendaftaran, Laporan*).

---

## Fitur Utama

1. **Autentikasi Terpisah (Session-Based)**:
   - Login Administrator (username & password dienkripsi).
   - Login Pasien (username & password dienkripsi).
   - Registrasi/pendaftaran akun pasien baru secara online.
2. **Dashboard Administrator**:
   - Menampilkan metrik klinis: Total Pasien, Total Pendaftaran, Pendaftaran Disetujui, Pendaftaran Ditolak, dan Pendaftaran Pending menggunakan Bootstrap Cards.
3. **Manajemen Pasien (CRUD Pasien oleh Admin)**:
   - Membuat, membaca, mengubah, dan menghapus akun pasien langsung dari portal admin.
4. **Verifikasi & Jadwal Pendaftaran (Admin)**:
   - Melihat antrean kunjungan pasien kronologis berdasarkan tanggal.
   - Menyetujui (Approve) atau Menolak (Reject) permintaan pendaftaran pasien.
5. **Formulir Pendaftaran Online (Pasien)**:
   - Pasien dapat memesan jadwal dokter berdasarkan pilihan klinik spesialis.
   - Validasi data masukan form (keluhan wajib diisi, nomor telepon numerik, tanggal kunjungan tidak boleh sebelum tanggal hari ini).
6. **Laporan & Ekspor**:
   - Halaman ringkasan statistik klinik.
   - Ekspor data laporan antrean pendaftaran ke **CSV**.
   - Ekspor laporan formal berformat **PDF** menggunakan library FPDF.

---

## Kredensial Uji Coba

- **Portal Administrator** (`/admin/login`):
  - **Username**: `admin_bora`
  - **Password**: `admin123`
- **Portal Pasien** (`/pasien/login`):
  - **Username**: `pasien_budi`
  - **Password**: `budi123`

---

## Petunjuk Penginstalan & Cara Menjalankan

Proyek ini dirancang agar siap dijalankan secara langsung tanpa perlu penginstalan library eksternal (Tanpa Composer, NPM, atau Docker).

### Langkah 1: Pindahkan Proyek
Salin atau pindahkan folder `BorahealMC` ini ke direktori `htdocs` XAMPP Anda.
Contoh jalur folder:
`C:\xampp\htdocs\BorahealMC`

### Langkah 2: Impor Database MySQL
1. Buka XAMPP Control Panel lalu aktifkan modul **Apache** dan **MySQL**.
2. Masuk ke panel phpMyAdmin di browser Anda: `http://localhost/phpmyadmin`
3. Buat database baru bernama: `db_boraheal_rs`
4. Pilih database tersebut, masuk ke tab **Import**, lalu pilih file SQL schema yang berada di dalam proyek:
   `BorahealMC/database/schema.sql`
5. Klik **Go** / **Kirim** untuk mengimpor tabel dan data awal (specialist seeders).

### Langkah 3: Akses Aplikasi
Buka browser Anda lalu jalankan URL berikut:
`http://localhost/BorahealMC`

Anda akan diarahkan ke halaman login pasien secara default.

---

## Struktur Folder Utama Proyek

```text
BorahealMC/
├── application/
│   ├── config/            # Konfigurasi rute (routes.php) & database (database.php)
│   ├── controllers/       # Controller utama (Admin.php, Auth.php, Pasien.php, Laporan.php)
│   ├── models/            # Model penanganan database (Admin_model, Pasien_model, dll)
│   ├── third_party/       # FPDF library untuk ekspor dokumen PDF
│   └── views/             # Template layout utama & folder modul halaman UI
├── assets/
│   ├── css/               # File kustom CSS (style.css)
│   └── js/                # File kustom JavaScript (main.js)
├── database/
│   └── schema.sql         # File migrasi database SQL
└── README.md              # File panduan dokumentasi
```
