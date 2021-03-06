# EcomProject

An ecommerce webstore project for tech products. Features a webstore and back-office administration area.

[View Live Here](http://ecomproject.herokuapp.com)

Built with:
- PHP, Laravel 8,
- MySql 5.7
- Tailwind CSS
- Stripe checkout

## How to use

### 1 - Clone the repo

```
    git clone https://github.com/JimBowler82/ecomProject
```

### 2 - Install 
```php
cd ecomProject
```
```php
composer install
```
```php
npm install
```
### 3 - Populate your `.env` File
- Copy over the `.env.example` file to your  `.env` file.
  
```php
cp .env.example .env
```
  <br>
- Add your database credentials and Stripe API keys to the `.env` file

### 4 - Generate your encryption key
```php
php artisan key:generate
```

### 5 - Finally, run database migrations & seeder
```php
php artisan migrate:fresh --seed
```

---

## Back-Office
- The back-office can be accessed via `/backoffice`.

- Back-office is auth protected, so log in or register first.
