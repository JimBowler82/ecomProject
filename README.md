# EcomProject

An ecommerce webstore project for tech products. Features a webstore and back-office administration area.

Built with:
- PHP, Laravel 8,
- MySql
- Tailwind CSS
## How to use

### 1 Clone the repo

```php
    git clone
```

### 2 Install 
```php
cd ecomProject
```
```php
composer install
```
```php
npm install
```
### 3 `.env` File
- Copy over the `.env.example` file to your  `.env` file.
  - `cp .env.example .env`
  <br>
- Add your database credentials to the `.env` file

### 4 Generate your encryption key
`php artisan key:generate`

### Finally, run database migrations & seeder
`php artisan migrate:fresh --seed`