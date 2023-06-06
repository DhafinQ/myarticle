# Aplikasi MyArticle
Aplikasi Artikel Sederhana Menggunakan Laravel Framework.

## Kalian Bisa :

- Login dan Logout
- Forgot Password (Harus mengubah .env)
- Ubah Profile
- Search Artikel
- CRUD User
- CRUD Permission
- CRUD Role
- CRUD Category
- CRUD Article

## Cara Setup

- Download / Clone Project Ini
- Buka terminal pada folder project
- Lakukan composer install
- Setelah composer install, ketik 'cp .env.example .env'
- Ketik 'php artisan key:generate'
- Pastikan sudah dibuat database bernama 'article_website'
- Ketik 'php artisan migrate:fresh --seed'
- Ketik 'php artisan serve'

## User dan Role

### Super Admin (Full Access)
- Email = superadmin@gmail.com
- Password = superadmin

### Admin (CRUD Artikel dan CRUD Kategori)
- Email = admin@gmail.com
- Password = admin

### Member (Read Artikel)
- Email = member@gmail.com
- Password = member



