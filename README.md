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

- PHP (version 8.2 or above)
- Composer (version 2.5.7 or above)
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

This section provides a comprehensive guide on how to use the Laravel-based frontend application to interact with the LMS API. It will cover the following topics:
1. Token Authentication
    
    Both books and authors API require a token in Headers. e.g. 
    `--header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5"`

    Example API call to get the token

    ```
    curl --header "Content-Type: application/json" \
    --request POST \
    --data '{"email":"test@example.com","password":"12345678"}' \
    http://127.0.0.1:8000/auth/login
    ```
2. Books API
    Books has 4 endpoints
    
    1. `GET /books` : to get the list of books record 
    2. `POST /books` : to create a new book
    3. `PUT /books/[id]` : to update the book record
    4. `GET /books/[id]` : to get the detail a book
    5. `DELETE /books/[id]` : to remove the book record

    Example curl request :

    ```
    # Login to generate the Token

    > curl --header "Content-Type: application/json" \
    --request POST \
    --data '{"email":"test@example.com","password":"12345678"}' \
    http://127.0.0.1:8000/auth/login
    
    # Create a new books

    > curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request POST \
    --data '{"title":"Book Title","description":"This book description","publish_date":"2000-01-01","author_id":1}' \
    http://127.0.0.1:8000/books
    
    # Get the books

    > curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request GET \
    http://127.0.0.1:8000/books
    
    # Edit the book information

    > curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request PATCH \
    --data '{"description":"no description"}' \
    http://127.0.0.1:8000/books/51

    #Get detail book

    curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request GET \
    http://127.0.0.1:8000/books/51
    
    # Delete the book

    curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request DELETE \
    http://127.0.0.1:8000/books/51
    ```
3. Authors API
    
    Authors API also has 4 endpoints

    1. `GET /authors` : to get the list of authors record 
    2. `POST /authors` : to create a new author
    3. `PUT /authors/[id]` : to update the author record
    4. `GET /authos/[id]` : to get the detail author
    5. `DELETE /authors/[id]` : to remove the author record

    Example curl request :

    ```
    # Create a new authors

    > curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request POST \
    --data '{"name":"John Doe","bio":"-","birth_date":"2000-01-01"}' \
    http://127.0.0.1:8000/authors
        
    # Get the authors

    > curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request GET \
    http://127.0.0.1:8000/authors
        
    # Edit the author data

    > curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request PATCH \
    --data '{"bio":"Author description"}' \
    http://127.0.0.1:8000/authors/11

    #Get detail author

    curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request GET \
    http://127.0.0.1:8000/authors/11
        
    # Delete the author

    curl --header "Content-Type: application/json" \
    --header "Authorization: Bearer 1|LFlGNYZR5pNL3eJPxM5KHK91PK18M2KWKh4nc0zLf47924a5" \
    --request DELETE \
    http://127.0.0.1:8000/authors/11
    ```
4. Unit Test

    In order to ensure the API endpoint can handle the request properly, this app also has 2 simple unit test. Run this command below :

    `> php artisan test`

    and we can see the test result
    ```
    user@computer-name:/var/www/html/lms$ php artisan test

    PASS  Tests\Unit\AuthorsApiTest
    ✓ create author 0.19s  
    ✓ get all authors 0.05s  
    ✓ update author 0.04s  
    ✓ delete author 0.03s  

    PASS  Tests\Unit\BooksApiTest
    ✓ create book 0.05s  
    ✓ get all books 0.05s  
    ✓ update book 0.04s  
    ✓ delete book 0.04s  

    Tests:    8 passed (30 assertions)
    Duration: 0.60s
    ```
5. Code Quality Check

    This is a process of testing the code quality of the Laravel-based LMS API application using PHP CodeSniffer (PHPCS) and PHPStan. These tools help ensure code consistency, maintainability, and adherence to coding standards.

    Run `> composer quality-check` in terminal to get the report, e.g

    ```
    user@computer-name:/var/www/html/lms$ composer quality-check

    > ./vendor/bin/phpcs && ./vendor/bin/phpstan analyse --memory-limit=-1

    Note: Using configuration file /var/www/html/lms/phpstan.neon.
    19/19 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%
                
    [OK] No errors
    ```                                                       

