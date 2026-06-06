# shorts-url

Сервис коротких ссылок. REST API на Laravel 10.

## Установка

```bash
composer install
cp .env.example .env   # настроить подключение к БД
php artisan key:generate
php artisan migrate
php artisan serve
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
  "short_url": "http://localhost:8000/abc123"
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
curl -X POST http://localhost:8000/api/links \
  -H "Content-Type: application/json" \
  -d '{"url":"https://google.com"}'

# Статистика
curl http://localhost:8000/api/links/КОРОТКИЙ-КОД/stats

# Редирект — открыть в браузере http://localhost:8000/КОРОТКИЙ-КОД
```

## Тестирование через Postman

### Создать ссылку
- **Method:** POST
- **URL:** `http://localhost:8000/api/links`
- **Body → raw → JSON:**
```json
{"url": "https://google.com"}
```

### Статистика
- **Method:** GET
- **URL:** `http://localhost:8000/api/links/КОРОТКИЙ-КОД/stats`

### Редирект
Открыть в браузере: `http://localhost:8000/КОРОТКИЙ-КОД`
```
