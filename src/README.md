Fashionablylate


環境構築
Dockerビルド
1. git clone https://github.com/chicat0222-hub/FashionablyLate.git
cd FashionablyLate
2. docker-compose up -d --build


laravel環境構築

1. docker-compose exec php bash
2.composer install
3.env.example .envから.envを作成し、環境変数を変更
4.php artisan key:generate
5.php artisan migrate --seed
6.php artisan serve



使用技術

Laravel Framework 8.83.8
PHP 8.1.33 (cli)
MYSQL:8.0.26

Docker version 28.3.2, build 578ccf6
Docker Compose version v2.39.1-desktop.1


ER図
![ER図](../er/FashionablyLate.drawio.svg)



URL
開発環境: http://localhost/
phpMyAdmin: http://localhost:8080/

