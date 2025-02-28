# EEC Task - Laravel 10 Project

## Overview
This project is a Laravel 10-based assessment designed to test knowledge of PHP and Laravel development principles, specifically focusing on Events & Listeners.

## Installation
Follow these steps to set up the project:

```bash
composer create-project "laravel/laravel:^10.0" EEC-Task
cd EEC-Task
```

## Database Setup
1. Create a `.env` file and configure your database settings:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=eec_task
   DB_USERNAME=root
   DB_PASSWORD=
   ```
2. Run migrations:
   ```bash
   php artisan migrate
   ```

## Features Implemented
- **User-Details Relationship:** One-to-Many relationship between `User` and `Detail` models.
- **Event Handling:** `UserSaved` event triggers upon user creation or update.
- **Listener Implementation:** `SaveUserBackgroundInformation` listener automatically saves additional user details.

## Testing
Run the test suite to validate functionality:
```bash
php artisan test
```

## Contribution
Feel free to fork and improve the project. Pull requests are welcome!

## License
This project is for assessment purposes only.

