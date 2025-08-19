# AJAK-Bestie
Sistem Analisis Jabatan, Analisis Beban Kerja, Standar Kompetensi dan Evaluasi Jabatan Pemerintah Provinsi Bengkulu ini dibangun dengan kerjasama oleh Prodi Informatika Fakultas Teknik Universitas Bengkulu tahun ajaran 2022/2023 melalui kegiatan Proyek Perangkat Lunak yang dimana salah satu studi bagi mahasiswa informatika UNIB dengan Dosen Pembimbing Arie Vatresia, S.T., M.T.I., Ph.D. dan Pembimbing Lapangan Majulo Bilkhair, S.E., M.A.P

## Requirement
| Library    | Version    |
|------------|------------|
| PHP | <code>^7.0</code> | 
| XAMPP | <code>^7.0</code> |
| Composser | <code>NEW</code> |

## Installation / Instalasi
Direkomendasikan menggunakan php > 7.0. Pastikan repo ini telah di clone

### Cara Clone Repository
Buka git Bash dan Jalankan perintah berikut untuk cloning
```
$ git clone https://github.com/azvadennys/ajak-bestie-laravel8.git
```
Setelah clone berhasil masuk ke folder repository
```
cd ajak-bestie-laravel8
```

### Setup
Jalankan perintah berikut untuk menginstal dependensi php
```
composer install
```
Jalankan perintah berikut untuk mengatur _environment variable_
```
cp .env.example .env
```
Pastikan Anda telah membuat database baru di MySQL dan silakan sesuaikan di file `.env` dengan nama database yang anda buat.
Jalankan perintah berikut untuk membuat _key_ untuk web app Anda
```
php artisan key:generate
```
Jalankan perintah berikut untuk membuat skema database dan seeder
```
php artisan migrate:fresh --seed
```
Terakhir, jalankan perintah berikut untuk menyalakan web server bawaan laravel 
```
php artisan serve
```
Setelah perintah di atas dijalankan, web app Anda bisa sudah bisa diakses

## Login
Untuk login aplikasi silakan masukkan email dan kata sandi berikut

| Email    | Password    |  Role |
|------------|------------|------------|
| azvadenis@gmail.com | superadmin1 | Super Administrator | 
| admin@gmail.com | 1234 | Administrator | 
| user@gmail.com | 1234 | User OPD | 
