<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## How to clone the project

## Requirements

- PHP >= 8.0
- Composer
- PostgreSQL
- Node.js & npm (for Laravel Mix)

## Installation

1. **Clone the repository:**

    ```sh
    git clone https://github.com/febriaricandra/laravel-unictive.git
    cd laaravel-unictive
    ```

2. **Install dependencies:**

    ```sh
    composer install
    npm install
    ```

3. **Copy the [.env.example](http://_vscodecontentref_/1) file to [.env](http://_vscodecontentref_/2) and configure your environment variables:**

    ```sh
    cp .env.example .env
    ```

    Update the [.env](http://_vscodecontentref_/3) file with your database credentials and other necessary configurations.

4. **Generate application key:**

    ```sh
    php artisan key:generate
    ```

5. **Run database migrations:**

    ```sh
    php artisan migrate
    ```

6. **Install Laravel Breeze:**

    ```sh
    php artisan breeze:install
    npm install && npm run dev
    php artisan migrate
    ```

7. **generate JWT Auth:**

    ```sh
    php artisan jwt:secret
    ```
    
## Usage

1. **Run the development server:**

    ```sh
    php artisan serve
    ```

2. **Run the frontend build tools:**

    ```sh
    npm run dev
    ```

3. **Access the application:**

    Open your browser and go to `http://localhost:8000`.

## API Documentation

To generate API documentation using Scribe, run:

```sh
php artisan scribe:generate
```