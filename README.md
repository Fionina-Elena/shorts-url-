# shorts-url

Сервис коротких ссылок. REST API на Laravel 10.

Деплой: https://shorts-url.onrender.com

## Установка и запуск

```bash
composer install
cp .env.example .env   # настроить подключение к БД
php artisan key:generate
php artisan migrate
php artisan serve
```

## Docker

```bash
make docker-build
make docker-run
```

Или без Makefile:

```bash
docker build -t shorts-url .
docker run -p 8080:8080 --env-file .env shorts-url
```

## Makefile

```bash
make install       # composer install
make migrate       # php artisan migrate
make serve         # php artisan serve
make docker-build  # docker build
make docker-run    # docker run
```

## Методы API

### Создать короткую ссылку

```
POST /api/links
Content-Type: application/json

{"url": "https://example.com/very/long/path"}
```

Ответ:
```json
{
  "code": "abc123",
  "short_url": "https://shorts-url.onrender.com/abc123"
}
```

### Редирект по короткому коду

```
GET /abc123
```

302-редирект на оригинальный URL. 404 если код не найден.

### Статистика

```
GET /api/links/abc123/stats
```

Ответ:
```json
{
    "url": "https://example.com/very/long/path",
    "code": "abc123",
    "clicks": 42,
    "created_at": "2026-06-03T12:34:56Z"
}
```

## Тестирование через curl

```bash
# Создать ссылку
curl -X POST https://shorts-url.onrender.com/api/links \
  -H "Content-Type: application/json" \
  -d '{"url":"https://google.com"}'

# Статистика
curl https://shorts-url.onrender.com/api/links/КОРОТКИЙ-КОД/stats

# Редирект — открыть в браузере https://shorts-url.onrender.com/КОРОТКИЙ-КОД
```
