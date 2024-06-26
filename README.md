<p align="center">
    <a href="https://sipkan.go.id" target="_blank">
        <img src="" width="400" alt="SIPKAN Logo">
    </a>
</p>

## SIPKAN
Sistem Informasi Pengawasan Kelautan dan Perikanan Pemerintah Daerah Provinsi Jawa Barat (SIPKAN)

## Requirements
* **MySQL 8.4**
* **PHP 8.2**
* **Composer 2.7.8**

## Setup Project
1. Jalankan database MySQL
    * Jika menggunakan docker bisa menjalanakan perintah berikut:
      * Menjalankan docker compose
        ```bash
        docker-compose up -d
        ```
      * Memberhentikan docker compose
        ```bash
        docker-compose down -v --remove-orphans
        ```
        
2. Install Dependencies
   ```bash
    composer install
   ```
3. Buat file .env dari file .env.example
    * Salin file `.env.dev` kemudian ganti namanya menjadi `.env`
   
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
7. Load composer files
   ```bash
   composer dump-autoload
   ```
8. Menjalankan aplikasi
   ```bash
   php artisan serve
   ```

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
