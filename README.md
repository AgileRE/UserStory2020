# User Story GUI

User Story GUI adalah aplikasi yang bertujuan untuk membangun user interface atau antarmuka berdasarkan user story yang dibuat oleh user. User dapat membuat user story (dalam format gherkin) pada sistem ini dan sistem akan menghasilkan user interface dalam format html.

## Installation

Sebelum anda melakukan installasi program ini di komputer anda, download beberapa program prasyarat untuk menginstall program ini :
1. Php versi 7.2
2. Composer
3. Code Editor (Atom / VS Code / lainnya)
4. XAMPP

Berikut adalah petunjuk instalasi program dalam komputer masing-masing:

1. Clone / Download project ini ke komputer anda ke direktori yang anda inginkan

2. Buka command prompt, arahkan direktori ke folder project yang telah di clone pada tahap 1, lalu arahkan ke folder "user-story-program"

---Langkah Alternatif
2. Buka folder yang telah di clone / download pada tahap 1, lalu klik kanan + shift pada folder "user-story-program", klik open powershell window here

3. Hidupkan XAMPP, start Apache dan MySQL. Kemudian jalankan perintah berikut pada command prompt / windows powershell

```
composer update

```
```
NOTE:
Apabila command prompt / windows powershell menampilkan error "google/cloud-firestore v1.11.1 requires ext-grpc * ->
the requested PHP extension grpc is missing from your system", maka matikan Apache pada XAMPP.
Kemudian install extension php yang bernama "php_grpc.dll" kedalam folder .../php/ext.
Tutorial dapat dilihat di https://stackoverflow.com/questions/50222772/installing-grpc-for-localhost/50222981
*letak file php.ini bisa diakses di XAMPP control panel, kemudian klik config di Apache, kemudian klik php.ini
Setelah selesai, hidupkan Apache pada XAMPP dan ulangi langkah 3.

```

4. Buka file ".env.example" pada folder "user-story-program" menggunakan code editor, lalu save as dengan nama ".env"

5. Jalankan perintah berikut pada command prompt / windows powershell

```
php artisan key:generate

php artisan serve

```

6. Buka http://127.0.0.1:8000/ pada browser anda

## Cara Kerja Aplikasi

1. Langkah pertama yang dilakukan yaitu membuat project. Dengan masuk ke tampilan pembuatan project yang akan dibuat kemudian memasukan nama project serta deskripsi project yang diinginkan. Setelah selesai  mengisi kolom nama dan deskripsi, pengguna dapat menekan tombol “simpan” agar data nama dan deskripsi project baru dapat tersimpan. Pengguna juga dapat menekan tombol “batal” bila ingin membatalkan pembuatan project baru.

2. Langkah selanjutnya yaitu pembuatan fitur dari project yang akan dibuat. Masuk ke tampilan pembuatan fitur dari project yang akan dibuat kemudian memasukan nama user story, peran dalam user story, dan deskripsi user story pada kolom yang tersedia. Setelah selesai  mengisi kolom - kolom tersebut, pengguna dapat menekan tombol “simpan” agar data yang baru dimasukkan dapat tersimpan. Pengguna juga dapat menekan tombol “batal” bila ingin membatalkan pembuatan fitur dari project.

3. Langkah terakhir yaitu penambahan skenario dari project yang akan dibuat. Masuk ke tampilan penambahan skenario dari project yang akan dibuat kemudian memasukan nama dari skenario project pada kolom yang tersedia. Setelah selesai  mengisi kolom nama tersebut, pengguna dapat menekan tombol “simpan” agar data yang baru dimasukkan dapat tersimpan. Pengguna juga dapat menekan tombol “batal” bila ingin membatalkan penambahan skenario dari project.
 
Setelah selesai memberi nama skenario project, pengguna kemudian menambahkan step atau langkah dari skenario project tersebut. Dengan mengisi kolom tipe step,command,parameter dan value pada kolom yang tersedia. Setelah selesai  mengisi kolom - kolom tersebut, pengguna dapat menekan tombol “simpan” agar data yang baru dimasukkan dapat tersimpan. Pengguna juga dapat menekan tombol “batal” bila ingin membatalkan penambahan step skenario dari project. Terdapat beberapa batasan pada sistem yang peneliti rancang. Salah satunya yaitu, tidak semua skenario pada cheat sheet behat tersedia dalam sistem yang peneliti rancang.

Terdapat fitur untuk mengedit skenario dari project yang akan dibuat. Misal bila pengguna ingin menentukan penambahan skenario project untuk output “gagal” atau “sukses”.

Setelah selesai memenuhi langkah - langkah yang harus dikerjakan pengguna maka, user interface dari project yang dibuat pengguna siap untuk di unduh dalam format .zip.



## Build With

* [Laravel](https://laravel.com/) - Web framework
* [Firebase](https://firebase.google.com/) - Database
* [Bootstrap](https://getbootstrap.com/) - CSS framework


## Authors

* 081711633001   **Nuril Maftuchah                  **
* 081711633010   **Febry Sukmawati Lubis            **
* 081711633013   **Ahmad Afan Affaidin              **
* 081711633016   **Fira Apriliana Juwari            **
* 081711633019   **Saberina Pinkhan Aulia           **
* 081711633023   **Ahmad Harish Syarifuddin         **
* 081711633025   **Hilmy Muktafi                    **
* 081711633029   **Muhammad Aulia Maulana           **
* 081711633036   **Bayu Ramadhan Shafiyuddin        **
* 081711633037   **Rivendrea Giftama C.             **
* 081711633043   **Almandriya Retno Khosyitradityas **
* 081711633050   **Nizam Irsananda                  **
* 081711633054   **Muhammad Akbar Fikri             **
