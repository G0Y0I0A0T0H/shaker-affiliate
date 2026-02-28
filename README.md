# Shaker Affiliate (Laravel 11)

Professional affiliate + e-commerce + order management system scaffold.

## Features
- **Roles**: admin / affiliate with role middleware and status checks.
- **Affiliate auth**: login by `whatsapp_phone + password`.
- **Products**: products (models), variants (colors), multiple images per variant, sizes with `stock_qty` + `reserved_qty`.
- **Orders**: affiliate creates customer orders with customer data + multi-item lines.
- **Statuses**: `new`, `contacted`, `sold`, `not_sold`, `returned`, `exchange`.
- **Stock automation**:
  - reserve on create
  - decrease stock on sold
  - release reserved stock on not_sold/returned/exchange
- **Affiliate dashboard**: order statistics + commissions + referral code.
- **Admin panel**: affiliates, products, variants, sizes/stock, orders status updates.
- **Security**: form request validation, role-based middleware, secure image upload rules.
- **UI**: Bootstrap 5 + Amazon-style product gallery (main image + thumbnails + zoom).

## Tech
- Laravel 11 structure
- PHP 8.2+
- MySQL or SQLite

## Quick Start
```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

## Default Seed Credentials
- **Admin**
  - WhatsApp: `201000000001`
  - Password: `password123`
- **Affiliate**
  - WhatsApp: `201000000777`
  - Password: `password123`

## Windows Setup (XAMPP/Laragon)
1. Install **PHP 8.2+**, **Composer**, **MySQL**.
2. Open terminal in project folder.
3. Run:
   ```bat
   copy .env.example .env
   composer install
   php artisan key:generate
   php artisan migrate --seed
   php artisan storage:link
   php artisan serve
   ```
4. If using MySQL, edit `.env`:
   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=shaker_affiliate
   DB_USERNAME=root
   DB_PASSWORD=
   ```
5. Open `http://127.0.0.1:8000`.

## Project Structure (important files)
- `app/Models/*` domain models.
- `app/Services/StockService.php` stock reservation & status transitions.
- `app/Http/Middleware/RoleMiddleware.php` role-based access.
- `app/Http/Controllers/Admin/*` admin panel handlers.
- `app/Http/Controllers/Affiliate/*` affiliate dashboard/orders.
- `database/migrations/*` schema.
- `database/seeders/*` initial data.
- `resources/views/*` Bootstrap 5 views + product gallery.

## Notes
- This repository is designed as a complete Laravel 11 application source scaffold. Run `composer install` to fetch framework dependencies.
