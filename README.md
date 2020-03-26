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
Apabila command prompt / windows powershell menampilkan error "google/cloud-firestore v1.11.1 requires ext-grpc * -> the requested PHP extension grpc is missing from your system",
maka matikan Apache pada XAMPP. Kemudian download library grpc (php_grpc.dll) dan masukkan kedalam folder extension php.
Tutorial dapat dilihat di https://stackoverflow.com/questions/50222772/installing-grpc-for-localhost/50222981
Setelah selesai, hidupkan Apache pada XAMPP dan ulangi langkah 3.

```

4. Buka file ".env.example" pada folder "user-story-program" menggunakan code editor, lalu save as dengan nama ".env"

5. Jalankan perintah berikut pada command prompt / windows powershell

```
php artisan key:generate

php artisan serve

```

6. Buka http://127.0.0.1:8000/ pada browser anda


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
