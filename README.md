# Yohak — Furniture Inventory Tracking System

A Laravel web application for tracking furniture inventory — built as a mini-project for
[course/internship context]. Employees log in to manage products, record stock movements,
and generate reports; admins additionally manage the employee roster.

## Tech Stack

- **Framework:** Laravel (PHP)
- **Database:** SQLite
- **Frontend:** Blade, Bootstrap 5.3, custom CSS design system (red/orange gradient theme)
- **Testing:** Pest

## Features

- **Authentication** — manual registration/login (Employee model is the auth guard), hashed passwords, remember-me
- **Role-based access control** — `admin` vs `staff` roles, enforced via middleware
- **CRUD** — Products, Employees (admin-only), Transaction Types, Inventory Transactions
- **Automatic stock adjustment** — Stock In/Out/Return transactions update `quantity_on_hand` automatically, wrapped in DB transactions
- **Validation** — Form Request classes on every write operation, including a custom rule preventing Stock Out from exceeding available quantity
- **Reports** — Stock Summary and Transaction History, both filterable and exportable to CSV
- **Soft deletes** — Products and Employees are soft-deleted, with a Trash/Restore view for Products
- **Custom error pages** — themed 403/404/419/500 pages matching the app design
- **Automated tests** — Pest feature tests covering auth and Product CRUD

## Database Structure

| Table | Purpose |
|---|---|
| `products` | Furniture items — SKU, category, price, stock levels |
| `employees` | Auth + staff records — name, email, role, position |
| `transaction_types` | Lookup table: Stock In, Stock Out, Adjustment, Transfer, Return |
| `inventory_transactions` | Every stock movement — links product, employee, and type |

## Setup

```bash
git clone <repo-url>
cd laravel-website
composer install
npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan db:seed --class=InventorySeeder
php artisan serve
```

Visit `http://127.0.0.1:8000`.

## Default Login

| Email | Password | Role |
|---|---|---|
| `admin@furniture.test` | `password` | Admin |

## Running Tests

```bash
php artisan test
```

## Notes

- `APP_DEBUG` should be `false` to see the custom error pages (403/404/419/500) instead of Laravel's debug view.
- Editing an Inventory Transaction is intentionally not supported — delete the incorrect entry (which reverts its stock effect) and create a new one instead.
