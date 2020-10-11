# DreamHouse

Best maison search service to get employed!

## Requirements

- PHP 7.3+
- PHP PDO extension
- PHP SQLite3 extention
- NodeJS/npm

## Install & run

Clone this repo. Then run:

```
composer install --no-dev
npm install
```

#### Setup environment
```
cp .env.run .env
```

#### Create database

We use SQLite engine for easier deployment. Create blank database:
```
touch database/database.sqlite
```
**IMPORTANT!** Do NOT provide DB_DATABASE env-var. It's kinda Laravel's bug.

Create required tables and seed with data:
```
php artisan migrate:fresh --seed
```

#### Build App
```
npm run production
```

#### Start PHP web-server
```
php artisan serve
```
Now navigate http://localhost:8000 in your favorite browser.

[Known issues](ISSUES.md)
