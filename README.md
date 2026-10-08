# LofiPlan

LofiPlan combines a shared music playlist and player with a personal weekly task planner. It is a Laravel application rendered with Blade, with Alpine.js and Tailwind CSS assets built by Vite.

## Stack

- PHP 8.2+
- Laravel 12
- Blade, Alpine.js, Tailwind CSS, and Vite
- PostgreSQL (database: `lofiplan`)

## Local setup

```sh
composer install
cp .env.example .env
php artisan key:generate
createdb lofiplan
php artisan migrate --seed
php artisan storage:link
npm install
npm run dev
```

Open <http://localhost:8000>. The `dev` script starts Laravel and Vite together. Use `npm run build` to create production frontend assets.

The local PostgreSQL defaults are `127.0.0.1:5432` with the `postgres` user and no password. Adjust the `DB_*` values in `.env` to match your PostgreSQL setup. Keep `.env` and production credentials out of version control.

Email uses Mailtrap Sandbox SMTP (`sandbox.smtp.mailtrap.io:2525`). Set `MAIL_USERNAME` and `MAIL_PASSWORD` in `.env` to the SMTP credentials from the Mailtrap sandbox Integration tab. Sandbox messages appear in the Mailtrap inbox and are not delivered to real recipients.

## Main features

- Registration, login, email verification, and profile management.
- Shared playlist: signed-in users can upload songs; each uploader can edit or remove their own uploads.
- Weekly task planner with per-user tasks and morning, afternoon, and evening shifts.

Database schema changes belong in `database/migrations`; use seeders for repeatable sample data. `music_db.sql` is a legacy database export and may not match the current migrations.
