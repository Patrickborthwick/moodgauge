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

This will create the database tables and seed the mood options.

### 6. Create the storage link

```bash
php artisan storage:link
```

This makes uploaded mood icons publicly accessible.

### 7. Build frontend assets

```bash
npm run build
```

Or for development with hot reload:

```bash
npm run dev
```

### 9. Serve the application

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

## Notes

- Mood icon images are stored in `storage/app/public/moods/`
- The AI summary is generated using Anthropic's Claude API on mood submission
- An Anthropic API key is required for AI summaries to function — without it moods can still be logged but no summary will be generated