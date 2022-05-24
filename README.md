# Cài Đặt

Sau khi pull code từ git về
```bash
composer install
```
Tạo .env từ .env.example

Chạy
```bash
php artisan db:seed --class=InitAdminSeeder
```

Chạy
```bash
php artisan storage:link
```
Chạy phân quyền cho các thư mục bên trong storage
```bash
sudo chown TÊNUSER public/storage/course
sudo chown -R  TÊNUSER storage
```
Thêm 

```bash
Options +FollowSymlinks
```
Vào trong public/.htaccess

Tạo file .htaccess ở public_html

```bash
RewriteEngine on
RewriteCond %{REQUEST_URI} !^public
RewriteRule ^(.*)$ public/$1 [L]
```
