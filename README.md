# MoodGauge

A mood tracking web application that allows users to log their daily mood and completed tasks, receiving AI-generated reflections to help them understand patterns in their emotional wellbeing over time.

## Requirements

- PHP 8.4+
- Composer
- Node.js & NPM
- MySQL
- Laravel 12

## Setup Instructions

### 1. Clone or extract the project

Extract the zip file and navigate to the project folder.

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install Node dependencies

```bash
npm install
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Run migrations and seeders

```bash
php artisan migrate --seed
```

This will create the database tables and seed the moods.

### 6. Create the storage link

```bash
php artisan storage:link
```

This makes uploaded mood icons publicly accessible.

### 7. Build frontend 

```bash
npm run dev
```