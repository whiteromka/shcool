Склонировать через git:
git clone git@github.com:whiteromka/shcool.git

Для windows проект разворачивать внутри WSL например: ~/dev/<папка_с_проектом>

В папке с проектом выполнить команды:

// Сгенерировать .env для докера командой ниже
printf "UID=%s\nGID=%s\n" "$(id -u)" "$(id -g)" > .env

// Прописать в .env
# ========= Docker =========
UID=1000
GID=1000
# ========= App =========
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:ZQ/re0PAL++HOgecVtZkJKZqtBWS6Fu+xKSyf9T3TFU=
APP_DEBUG=true
APP_URL=http://localhost:8080
# ========= Database =========
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db
DB_USERNAME=rom123
DB_PASSWORD=rom123
MYSQL_ROOT_PASSWORD=rom123
#====
CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database

// Собираем окружение
docker compose build --no-cache

// Запускаем окружение
docker compose up -d

// Провалиться в контейнер с Ларкой и накатить миграции, и выйти
docker compose exec app bash
composer install
php artisan migrate // если будет ошибка подождать 20 сек и повторить
                  проверка подключения:  mysql -h db -u rom123 -p --ssl=0

// В контейнере с приложением устанавливаем бутстрап
npm install

// Запуск режима разработки фронта: Vite с hot reload
npm run dev
// Должна открываться страница http://localhost:5173/

// Открыть в браузере проект: http://localhost:8080/

// Если нужно провалиться в контейнер с приложением: docker compose exec -it app bash
