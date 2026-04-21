## Tech Stack

- **Laravel 13** — PHP framework
- **MySQL 8** — Database
- **Nginx** — Web server
- **Docker + Docker Compose** — Containerization
- **Tailwind CSS** — Styling
- **Laravel Breeze** — Authentication

For running locally:
- PHP 8.4+
- Composer
- MySQL 8
- Node.js 20+

## Local Setup (without Docker)

```bash
git clone https://github.com/yourname/blog-laravel
cd blog-laravel
cd blog-app
cp .env.example .env
composer install
npm install
npm run build
```

Update `.env` with your local MySQL credentials, then:

```bash
php artisan key:generate
php artisan migrate --seed
php -S 127.0.0.1:8000 -t public
```

Then open **http://127.0.0.1:8000**

## Docker Setup

```bash
git clone https://github.com/yourname/blog-laravel
cd blog-laravel
cd blog-app
cp .env.example .env
docker compose up -d --build
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
# or wipe and reseed
docker compose exec app php artisan migrate:fresh --seed

docker compose run --rm node npm install
docker compose run --rm node npm run build
```

Then open **http://localhost:8000**

## Test Accounts

After seeding, these accounts are available:

| Name | Email | Password | Role |
|---|---|---|---|
| Admin User | admin@example.com | password | Admin |
| Regular User | user@example.com | password | User |

## Running Tests

```bash
# With Docker
docker compose exec app php artisan test

# Locally
php artisan test
```
