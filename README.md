# Blog
### Описание
Веб-сайт с возможностью публиковать записи. Разработан на фреймворке Laravel. Возможен запуск с помощью docker-compose.
### Технологии
PHP 8.2.1,
Laravel 9.48.0.
### Запуск проекта в dev-режиме
- Скачайте и установите Docker.
- С помощью консоли перейдите в папку с проектом (директория, в которой находится файл artisan).
- Выполните команду:

```
./vendor/bin/sail up
``` 
- Создайте файл .env в корне проекта и добавьте в него необходимые константы.
  Имена констант указаны в файле .env.example.
- Выполните миграции командой:
```
php artisan migrate
```

### Автор
Дмитрий Ковалев.
Telegram: https://t.me/i76700
