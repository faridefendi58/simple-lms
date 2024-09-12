## Simple Library Management System

This Laravel-based web application serves as a frontend interface for a simple Library Management System (LMS) API. The primary focus is on demonstrating how to interact with the LMS API using HTTP requests, including login and token authentication. The application will provide functionality to:

- Login: Authenticate users using their credentials to obtain a JWT token.
- Books API:
    - List all books.
    - Retrieve a specific book by ID.
    - Create a new book.
    - Update an existing book.
    - Delete a book.
- Authors API:
    - List all authors.
    - Retrieve a specific author by ID.
    - Create a new author.
    - Update an existing author.
    - Delete an author.

## Getting Started

This section will guide you through setting up and running the Laravel application for the simple LMS API.

Prerequisites

- PHP (version 8 or above)
- Composer (package manager)
- MySQL database server

Installation:
1. Clone the Repository
    
    `> git clone https://github.com/faridefendi58/simple-lms.git
    `
2. Install Dependencies

    Navigate to your project directory and run the following command to install all the required dependencies listed in your composer.json file:

    `> composer update`
3. Configure Environment

    Copy the .env.example file to .env in your project root directory. This file stores your application environment variables.
    
    Open the .env file and update the following details with your specific database credentials:
    ```
    DB_CONNECTION=mysql
    DB_HOST=your_database_host
    DB_PORT=3306  # Or your database port
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password 1 
    ```
4. Database Migration
    
    Run the following command to migrate your database schema based on your models:

    `> php artisan migrate`
5. Seeding Data
    
    The application includes a seeder to generate dummy data for books, authors, and a user. You can run the following command to populate your database with sample data:

    `> php artisan db:seed`

    This will create several dummy books, authors, and one user with the email test@example.com and password `12345678`.
6. Running the Application

    Once you've completed the setup steps, you can start the Laravel development server using:

    `> php artisan serve`

    This will start the server on your local machine, typically accessible at http://localhost:8000 (default port).

    You can adjust the default development server port by specifying a port number after the serve command (e.g., php artisan serve --port=8080).

## Interacting with the LMS API

This section provides a comprehensive guide on how to use the Laravel-based frontend application to interact with the LMS API

