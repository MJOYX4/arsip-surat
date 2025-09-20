Deskripsi Program

Judul
- Aplikasi Arsip Surat Berbasis Web dengan Laravel (Bootstrap)

Tujuan
- Aplikasi ini dibuat untuk membantu pengelolaan surat masuk/keluar di organisasi atau instansi agar lebih teratur, mudah dicari, dan aman tersimpan dalam bentuk digital (PDF). Dengan aplikasi ini, pengguna dapat menyimpan, mencari, mengedit, dan mengunduh arsip surat melalui antarmuka web yang sederhana.

Fitur Utama
1. Manajemen Kategori Surat
   * Tambah kategori baru.
   * Edit dan hapus kategori.
   * Pencarian kategori berdasarkan nama.

2. Pengarsipan Surat
   * Unggah surat dalam bentuk **PDF**.
   * Metadata surat: nomor surat, judul, kategori, deskripsi.
   * File disimpan otomatis ke folder `storage/app/public/archives`.

3. Pratinjau & Unduh Surat
   * Lihat pratinjau file PDF langsung di browser.
   * Unduh file arsip kembali dengan nama file yang sesuai judul.

4. Edit Arsip
   * Ubah data metadata surat.
   * Ganti file PDF (file lama otomatis terhapus).

5. Hapus Arsip
   * Konfirmasi hapus melalui modal Bootstrap sebelum data benar-benar dihapus.
   * Hapus data di database sekaligus file fisik di storage.

6. Pencarian Arsip
   * Cari berdasarkan judul atau nomor surat.
   * Hasil ditampilkan dengan pagination.

7. Antarmuka User-Friendly
   * Desain sederhana dengan **Bootstrap** (tanpa Tailwind).
   * Notifikasi sukses/error menggunakan alert Bootstrap.

Cara Menjalankan Aplikasi
Berikut langkah-langkah mulai dari clone repository sampai aplikasi siap digunakan:

1. Clone repository
git clone https://github.com/[username]/nama-repo.git

2. Install dependency PHP
composer install


3. Buat file `.env`
pada cmd : copy .env.example .env


Kemudian buka file `.env` dan atur konfigurasi database, contoh:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= arsip_db
DB_USERNAME=root
DB_PASSWORD=

4. Generate key aplikasi
php artisan key:generate

5. Buat database
Buat database kosong bernama `arsip_db` (atau sesuai `.env`) di MySQL/phpMyAdmin:


6. Jalankan migrasi tabel
php artisan migrate

7. Buat symbolic link ke storage
php artisan storage:link

8. Jalankan server
php artisan serve -> `http://127.0.0.1:8000`


**Alur Penggunaan Aplikasi Arsip Surat:**
1. **Buka Aplikasi**
   * Setelah Pengguna mengakses aplikasi melalui browser dengan alamat `http://127.0.0.1:8000/`.
   * Halaman utama langsung menampilkan daftar arsip yang sudah tersimpan.

2. **Tambah Arsip Baru**
   * Pengguna klik tombol **Tambah Arsip**.
   * Isi form dengan:
     * Nomor Surat
     * Judul Surat
     * Pilih Kategori (misalnya: Undangan, Laporan, Pengumuman)
     * Upload file surat dalam format **PDF**
   * Setelah disimpan:
     * Sistem memvalidasi input.
     * File PDF disimpan di folder `storage/app/public/archives`.
     * Metadata surat (nomor, judul, kategori, nama file, tanggal unggah) disimpan ke tabel `archives`.

3. **Lihat Detail Arsip**
   * Dari daftar arsip, pengguna bisa klik salah satu arsip.
   * Halaman detail menampilkan informasi lengkap (nomor surat, judul, kategori, tanggal unggah) + preview file PDF.

4. **Unduh Arsip**
   * Klik tombol **Unduh**, sistem mengambil file dari storage dan mengirimkannya ke browser.
   * File PDF bisa langsung dibuka atau disimpan di perangkat pengguna.

5. **Edit Arsip**
   * Pengguna pilih arsip → klik tombol **Edit**.
   * Metadata surat bisa diperbarui (nomor, judul, kategori).
   * Jika file PDF diganti:
     * File lama otomatis dihapus dari storage.
     * File baru disimpan di `storage/app/public/archives`.
       
6. **Hapus Arsip**
   * Klik tombol **Hapus** pada arsip yang dituju.
   * Sistem memunculkan **modal konfirmasi (Bootstrap)** agar pengguna tidak salah hapus.
   * Jika konfirmasi:
     * Data arsip dihapus dari tabel **`archives`**.
     * File fisik PDF ikut terhapus dari storage.

7. **Cari Arsip**
   * Pengguna bisa menggunakan fitur pencarian berdasarkan **judul** atau **nomor surat**.
   * Hasil pencarian ditampilkan dalam bentuk daftar dengan **pagination** agar lebih rapi.

8. **Kelola Kategori Arsip**
   * Pengguna juga dapat mengelola kategori melalui menu kategori:
     * **Tambah kategori** → isi nama kategori baru (contoh: “Surat Masuk”, “Surat Keluar”).
     * **Edit kategori** → ubah nama kategori yang sudah ada.
     * **Hapus kategori** → kategori yang tidak digunakan lagi bisa dihapus.

**Berikut adalah screenshot tampilan halaman web aplikasi saya**
<img width="1919" height="963" alt="image" src="https://github.com/user-attachments/assets/8cbe72f4-6f6d-43d3-8b70-5b243f4f82e6" />
<img width="1918" height="981" alt="image" src="https://github.com/user-attachments/assets/0b2af169-e8ff-4f64-94e4-0507067049d9" />
<img width="1919" height="962" alt="image" src="https://github.com/user-attachments/assets/bd7799a2-6ed3-445f-8cb2-31c8aa940fc5" />
<img width="1919" height="974" alt="image" src="https://github.com/user-attachments/assets/3a133a51-8728-4e6b-b498-a2b4f2908034" />
<img width="1919" height="912" alt="image" src="https://github.com/user-attachments/assets/01287ab5-c10f-46e6-a9b9-9f4db41c877f" />
<img width="1919" height="966" alt="image" src="https://github.com/user-attachments/assets/fe42acb0-ca62-4e73-b104-669f013b0a1c" />
<img width="1912" height="961" alt="image" src="https://github.com/user-attachments/assets/1f836d2c-4bed-4c35-8c71-ed3337d8373b" />
<img width="1917" height="963" alt="image" src="https://github.com/user-attachments/assets/c2481b58-9d88-4dce-9e2e-e101adc043ba" />
<img width="1919" height="986" alt="image" src="https://github.com/user-attachments/assets/10a64616-ba7f-457d-8a04-5efc69085dfc" />

Terimakasih..

