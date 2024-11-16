# Meeting Room Booking System

## Description
This project is built using Laravel 11 and requires a minimum PHP version of 8.2 to run. The project aims to register employees by administrator and employees can book meeting rooms.

## Requirements
- PHP >= 8.2
- Composer
- Laravel 11

## Installation

To install this project, follow the steps below:

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Sagar158/Meeting-Room-Booking-System.git
   cd your_repository

2. **Install dependencies:**
   composer install

3. **Environment Configuration:**
   cp .env.example .env
   Update the .env file with your database and other configuration settings.

4. **Generate the application key:**
   php artisan key:generate

5. **Run migrations:**
   php artisan migrate

6. **Run seeders (optional): If you want to seed your database with sample data, run:**
   php artisan db:seed

# Versioning
   This project is built on Laravel 11.
   Minimum supported PHP version is 8.2.

# Usage
   To start the local development server, run:
   php artisan serve
   Access the application at http://localhost:8000.

