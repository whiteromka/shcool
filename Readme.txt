Для windows проект разворачивать внутри WSL например: ~/dev/<папка_с_проектом>

В папке с проектом выполнить команды:

// Сгенерировать .env для докера
printf "UID=%s\nGID=%s\n" "$(id -u)" "$(id -g)" > .env

// Собираем окружение
docker compose build --no-cache

// Запускаем окружение
docker compose up -d

// Развертываем Laravel
docker compose run --rm app composer create-project laravel/laravel .
// Если спросит про SQLite ответить NO
// Возможно после установки чуть подждать пока проиндекиректся проект

// Заменить в /src/.env данными ниже
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laraveluser
DB_PASSWORD=laravelpass

// Провалиться в контейнер с Ларкой и накатить миграции, и выйти
docker compose exec app bash
php artisan migrate

// В контейнера с приложением устанавливаем бутстрап
npm install bootstrap

// Запуск режима разработки фронта: Vite с hot reload
npm run dev
// Должна окрываться страница http://localhost:5173/

// Открыть в браузере проект: http://localhost:8080/

// Если нужно провалиться в контейнер с приложением: docker compose exec -it app bash