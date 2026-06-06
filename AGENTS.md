# toko-baju — Laravel 12

## Stack

- **PHP 8.2** · Laravel 12 · SQLite (default)
- **Tailwind CSS 4 + PostCSS** (`@tailwindcss/postcss` via `postcss.config.js` + `laravel-vite-plugin`)
- **Alpine.js** via Vite (`resources/js/app.js`)
- Auth scaffolded via **Laravel Breeze** (Blade + Alpine)
- Testing: **PHPUnit 11** (Unit + Feature suites)
- Linting: **Laravel Pint**
- Custom CSS utilities in `resources/css/app.css`: `.glass-card`, `.btn-gradient`, `.bg-gradient-animated`, `.input-glow`, `.password-check`, and fade/slide/shake keyframe animations

## Commands

```bash
composer test              # config:clear → artisan test (PHPUnit)
composer dev               # concurrently: artisan serve + queue:listen + pail + vite
php artisan serve           # dev server at http://localhost:8000
npm run dev                 # Vite dev with HMR
npm run build               # Vite production build
```

`composer dev` runs 4 processes concurrently — its colors match server, queue, logs, vite respectively.

## Testing

- SQLite `:memory:` in `phpunit.xml` — no external DB needed
- Always run `composer test` (not raw `phpunit`) to clear config first
- `tests/Unit/` (plain PHPUnit) · `tests/Feature/` (Laravel `TestCase`)

## Project Structure

| Path | Contents |
|---|---|
| `routes/web.php` | Web routes (welcome, dashboard, profile, auth) |
| `routes/auth.php` | All auth routes (login, register, passwords, email verification) |
| `routes/console.php` | Artisan commands |
| `app/Models/` | Eloquent models |
| `app/Http/Controllers/` | Controllers (includes `Auth/` and `ProfileController`) |
| `resources/views/` | Blade templates (includes `auth/`, `profile/`, `layouts/`, `components/`) |
| `resources/css/` · `resources/js/` | Vite entrypoints (JS includes Alpine) |
| `database/migrations/` | Schema migrations (users, cache, jobs) |
| `config/` | All app config |

## Architecture Notes

- `bootstrap/app.php` wires routing, middleware, exceptions
- `bootstrap/providers.php` registers service providers
- Default `.env` uses **SQLite** + database-backed session/cache/queue
- Breeze auth scaffolding is installed — do not re-run `php artisan breeze:install` unless intentionally upgrading

## Setup (fresh checkout)

```bash
composer setup   # install, .env, key:generate, migrate, npm install & build
```
