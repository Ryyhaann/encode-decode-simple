# 🧩 Encode / Decode Tools (PHP Native)

Tools web sederhana untuk melakukan berbagai operasi encode dan decode teks atau file secara langsung di browser. Dibangun menggunakan PHP Native, HTML, dan CSS, serta sudah responsif untuk tampilan mobile 📱.

## ✨ Fitur Utama
- **Multi Operasi Encode/Decode**
  - Base64 Encode / Decode
  - URL Encode / Decode
  - HTML Entities Encode / Decode
  - ROT13
  - MD5 Hash (one-way)
  - SHA1 Hash (one-way)
  - Hex Encode / Decode
  - *(Opsional)* AES Encrypt / Decrypt (dengan password)
- **Input Fleksibel**
  - Masukkan teks langsung di textarea, atau upload file yang ingin di-encode/decode.
- **Output Lengkap**
  - Hasil bisa langsung disalin ke clipboard atau diunduh sebagai file `.txt`.
  - Semua file hasil tersimpan otomatis di folder `/uploads`.
- **UI Modern & Responsif**
  - Tampilan gelap elegan 🖤
  - Dropdown operasi dengan warna kontras agar mudah dibaca.
  - Desain responsif untuk desktop dan mobile.

## 📂 Struktur Folder
EncodeDecodeTools/
│
├── index.php # Halaman utama (form encode/decode)
├── process.php # File pemrosesan hasil encode/decode
├── uploads/ # Folder penyimpanan file hasil & upload
└── README.md # Dokumentasi proyek

Pastikan folder `uploads/` sudah ada dan writable. Jika belum ada, buat manual:
**bash**
mkdir uploads
chmod 777 uploads
⚙️ Cara Instalasi & Penggunaan
1.Clone atau download repository ini:
git clone https://github.com/Ryyhaann/encode-decode-simple.git
2.Pindahkan ke folder server lokal (XAMPP, Laragon, dll):
cd encode-decode-simple
3.Pastikan PHP sudah aktif, lalu akses di browser:
http://localhost/web-encode-decode
4.Gunakan Tools:
Masukkan teks atau upload file.
Pilih operasi encode/decode.
Klik tombol Proses.
5.Hasil:
Bisa langsung disalin ke clipboard, atau
Diunduh dalam bentuk file hasil encode/decode.

🧰 Teknologi yang Digunakan
PHP 7+ (Native) — tanpa framework, ringan, dan cepat.
HTML5 / CSS3 — tampilan bersih dan modern.
JavaScript (Clipboard API) — untuk menyalin hasil ke clipboard.
