<p align="center">
    <a href="https://sipkan.go.id" target="_blank">
        <img src="" width="400" alt="SIPKAN Logo">
    </a>
</p>

## SIPKAN
Sistem Informasi Pengawasan Kelautan dan Perikanan Pemerintah Daerah Provinsi Jawa Barat (SIPKAN)

## Requirements
* **MySQL 8**
* **PHP 8**
* **Composer 2.7.8**

## Setup Project
1. Jalankan database MySQL
2. Install Dependencies
   ```bash
    composer install
   ```
3. Buat file .env dari file .env.example
    * Salin file `.env.example` kemudian ganti namanya menjadi `.env`
   
4. Konfigurasi database pada file .env
   * Buka file `.env` kemudian isi variable-variable berikut sesuai dengan environment yang di pakai
     * `DB_DATABASE=`
     * `DB_USERNAME=` 
     * `DB_PASSWORD=`

5. Generate key aplikasi
   ```bash
   php artisan key:generate
    ```
6. Jalankan migrasi database
   ```bash 
   php artisan migrate
   ```
7. Menjalankan aplikasi
   ```bash
   php artisan serve
   ```

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
