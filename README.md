# Medicine Inventory Management System

Secure, storage-only inventory tracker for pharmacies and clinics. Built with PHP 8, PDO, Bootstrap 5, and MySQL to manage medicines, categories, stock levels, and expiry monitoring.

## Features
- **Authentication** using hashed passwords and server-side sessions.
- **Dashboard** with total, low-stock, and expiring summaries plus detail tables.
- **Categories CRUD** with validation and CSRF protection.
- **Medicines CRUD** with optional category, expiry tracking, search, filter, and pagination.
- **Low-stock & expiry alerts** based on reorder level and 30-day expiry window.
- **Secure forms** using prepared statements, CSRF tokens, and escaped output.

## Requirements
- PHP 8.0+
- MySQL 5.7+/MariaDB 10.3+
- Web server (Apache/Nginx) with PHP support
- Composer (optional, not required)

## Setup
1. Clone or download this repository into your webroot (e.g., `htdocs/medicine-inventory`).
2. Create a database and tables:
   ```bash
   mysql -u root -p < create_db.sql
   ```
3. Copy `.env.example` to `.env` and update database credentials and optional `APP_BASE_URL`.
4. (Optional) Seed sample data:
   ```bash
   mysql -u root -p < seed_sample_data.sql
   ```
5. Create an admin user:
   ```bash
   php create_admin.php
   ```
6. Place the project in your web server document root and visit `http://localhost/medicine-inventory/auth/login.php`.
7. After confirming the admin login works, **delete `create_admin.php`** for security.

## Security Notes
- Always serve over HTTPS in production.
- Rotate admin credentials regularly.
- Disable PHP error display (`display_errors=0`) in production and rely on server logs.
- Keep the `.env` file outside version control and restrict its permissions.

## Manual Test Checklist
- **DB & Connection**: Run `create_db.sql`; execute `php create_admin.php`; login succeeds.
- **Auth**: Invalid credentials show error without revealing details.
- **Categories**: Create, edit, and delete categories; duplicates show validation error.
- **Medicines**: Create/edit/delete medicines; validation blocks negative values and bad dates.
- **Search & Filter**: Query `?q=amox` returns Amoxicillin; category dropdown filters correctly.
- **Pagination**: With >10 medicines, pagination links yield correct pages.
- **Alerts**: Low stock (quantity < reorder_level) and expiring (within 30 days) appear on dashboard.
- **Security**: CSRF tokens required on all POST forms; prepared statements prevent SQL injection; output is escaped.

## Sample curl Commands
```bash
# Login (store cookie)
curl -i -c cookies.txt -X POST \
  -F "username=admin" -F "password=admin123" \
  http://localhost/medicine-inventory-management-system/auth/login.php

# Fetch medicines list with search & category filter
curl -b cookies.txt \
  "http://localhost/medicine-inventory/medicines/index.php?q=amox&category=1&page=1"
```

## PR Checklist
- Documentation updated (`README.md`, comments where applicable).
- Tests/manual checklist run.
- CSRF tokens present on all POST forms.
- Prepared statements used for every query.
- Session ID regenerated on login.
