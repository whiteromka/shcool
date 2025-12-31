
CACHE_STORE=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

docker compose exec app php artisan optimize:clear

docker compose exec app php artisan key:generate

docker compose exec app php artisan migrate

CACHE_STORE=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database

docker compose exec app php artisan optimize:clear
