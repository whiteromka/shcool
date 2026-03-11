# School Project - QWEN.md

## Project Overview

This is a **Laravel 12** web application built with **PHP 8.3**, serving as a platform for educational/course-related functionality. The project features user authentication (including OAuth providers), Telegram bot integration, vacancy management, and business request handling.

### Core Technologies

| Layer | Technology |
|-------|------------|
| **Backend** | Laravel 12, PHP 8.3 |
| **Frontend** | Vite 7, Bootstrap 5, Livewire 4 |
| **Database** | MySQL 8.1 |
| **Containerization** | Docker (nginx, PHP-FPM, MySQL) |
| **Testing** | PHPUnit 11, Faker |

### Key Features

- **Authentication**: Native login/registration + OAuth (Google, GitHub, Yandex)
- **Telegram Integration**: Bot webhook handling, Telegram Auth
- **User Management**: Profiles, roles, OAuth account linking
- **Business Features**: Vacancies, business requests, reviews
- **Tech Stack**: Technology information system with active modules

## Project Structure

```
school/
├── app/
│   ├── Console/          # Artisan commands
│   ├── DTOs/             # Data Transfer Objects
│   ├── Enums/            # Enumerations
│   ├── Helpers/          # Helper functions
│   ├── Http/             # Controllers, Middleware, Requests
│   ├── Livewire/         # Livewire components
│   ├── Models/           # Eloquent models (User, Profile, Vacancy, etc.)
│   ├── Providers/        # Service providers
│   ├── Repositories/     # Data repositories
│   ├── Services/         # Business logic services
│   └── Test/             # Test helpers
├── bootstrap/            # Application bootstrap files
├── config/               # Configuration files
├── database/             # Migrations, factories, seeders
├── docker/               # Docker configuration
│   ├── php/              # PHP-FPM Dockerfile
│   └── nginx/            # Nginx configuration
├── public/               # Public assets
├── resources/            # Views, CSS, JS
├── routes/               # Route definitions (web.php, console.php)
├── storage/              # Logs, cached files
└── tests/                # PHPUnit tests
```

### Key Models

- `User` - Authentication and user data
- `Profile` - Extended user profile
- `OauthAccount` - OAuth provider accounts
- `Vacancy` - Job vacancies
- `BusinessRequest` - Business service requests
- `Review` - User reviews
- `TechStack` / `Technology` - Technology catalog
- `ActiveModule` - User enrollment in modules

### Services Layer

Located in `app/Services/`:
- `UserService`, `ProfileService` - User management
- `OauthAccountService` - OAuth handling
- `TelegramService` - Telegram bot integration
- `VacancyService` - Vacancy operations
- `ModuleService`, `ActiveModuleService` - Course modules
- `HH/` - HeadHunter API integration
- `OAuth/` - OAuth provider implementations

## Building and Running

### Prerequisites

- Docker & Docker Compose
- WSL (for Windows users)
- Git

### Initial Setup

1. **Clone the repository:**
   ```bash
   git clone git@github.com:whiteromka/shcool.git
   cd shcool
   ```

2. **Create `.env` file:**
   ```bash
   cp .env.example .env
   ```

3. **Configure environment variables:**
   - Set `UID` and `GID` (run `id -u` and `id -g` to get values)
   - Configure database credentials (`DB_USERNAME`, `DB_PASSWORD`, `MYSQL_ROOT_PASSWORD`)
   - Update OAuth credentials if needed (Yandex, GitHub, Google)
   - Add Telegram bot token if using Telegram features

4. **Build and start containers:**
   ```bash
   docker compose build --no-cache
   docker compose up -d
   ```

5. **Install dependencies and run migrations:**
   ```bash
   docker compose exec app bash
   composer install
   php artisan migrate
   exit
   ```

6. **Install npm packages:**
   ```bash
   docker compose exec app npm install
   ```

7. **Start development server:**
   ```bash
   docker compose exec app npm run dev
   ```

8. **Access the application:**
   - Main app: http://localhost:8080
   - Vite dev server: http://localhost:5173

### Common Commands

| Command | Description |
|---------|-------------|
| `docker compose up -d` | Start containers |
| `docker compose down` | Stop containers |
| `docker compose build --no-cache` | Rebuild containers |
| `docker compose exec app bash` | Enter PHP container |
| `docker compose exec app php artisan migrate` | Run migrations |
| `docker compose exec app php artisan migrate:rollback --step=1` | Rollback migrations |
| `docker compose exec app php artisan optimize:clear` | Clear all caches |
| `docker compose exec app php artisan key:generate` | Generate app key |
| `docker compose exec app php artisan test` | Run tests |
| `npm run dev` | Start Vite hot-reload |
| `npm run build` | Build production assets |

### Composer Scripts

```bash
composer run setup   # Full setup (install, migrate, build)
composer run dev     # Development mode with hot-reload
composer run test    # Run test suite
```

### Artisan Generators

```bash
php artisan make:controller ControllerName --resource
php artisan make:migration create_table_name
php artisan make:model ModelName -m  # with migration
php artisan make:livewire ComponentName
```

## Development Conventions

### Code Style

- **Indentation**: 4 spaces (see `.editorconfig`)
- **Charset**: UTF-8
- **Line endings**: LF
- **Trailing whitespace**: Trimmed automatically
- **PHP**: PSR-4 autoloading, Laravel conventions

### Testing Practices

- **Unit tests**: `tests/Unit/`
- **Feature tests**: `tests/Feature/`
- **Run tests**: `docker compose exec app php artisan test`
- Test environment uses SQLite in-memory database

### Database Migrations

- Create: `php artisan make:migration create_table_name`
- Run: `php artisan migrate`
- Rollback: `php artisan migrate:rollback --step=1`

### Environment Configuration

Key environment variables (see `.env.example`):

```env
APP_NAME=Laravel
APP_DEBUG=true
APP_URL=http://localhost:8080

DB_CONNECTION=mysql
DB_HOST=db
DB_DATABASE=db
DB_USERNAME=your_user
DB_PASSWORD=your_password

# OAuth providers
YANDEX_CLIENT_ID=?
GITHUB_CLIENT_ID=?
GOOGLE_CLIENT_ID=?

# Telegram
TELEGRAM_BOT_TOKEN=?
TELEGRAM_BOT_USERNAME=?
```

### Telegram Bot Development

For local Telegram webhook testing:

```bash
# In WSL terminal
ssh -R 80:localhost:8080 serveo.net

# In container
docker compose exec app bash
php artisan telegram:set-webhook
php artisan tinker
```

Then verify with:
```php
Http::get("https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/getWebhookInfo")->json();
```

## Architecture Notes

- **Repository Pattern**: Data access abstracted through repositories
- **Service Layer**: Business logic encapsulated in services
- **DTOs**: Data transfer objects for structured data passing
- **Livewire**: Reactive components for dynamic UI
- **OAuth**: Multi-provider authentication support via Laravel Socialite

## Troubleshooting

- **Database connection issues**: Wait 20 seconds after starting containers for MySQL to initialize
- **Port conflicts**: Check ports 8080, 5173, 3306 are available
- **Cache issues**: Run `php artisan optimize:clear`
- **Vite not reloading**: Run `pkill -f vite` and restart dev server
