# PHP Library System

## Overview
The PHP Library System is an object-oriented application designed to manage a library's book, author, and category information. It provides functionalities for adding, editing, deleting, and searching for books, authors, and categories.

## Project Structure
```
php-library-system
├── src
│   ├── Controllers
│   │   ├── BookController.php
│   │   ├── AuthorController.php
│   │   └── CategoryController.php
│   ├── Models
│   │   ├── Book.php
│   │   ├── Author.php
│   │   └── Category.php
│   ├── Services
│   │   ├── BookService.php
│   │   ├── AuthorService.php
│   │   └── CategoryService.php
│   ├── Repositories
│   │   ├── BookRepository.php
│   │   ├── AuthorRepository.php
│   │   └── CategoryRepository.php
│   ├── Database
│   │   └── Database.php
│   ├── Views
│   │   ├── books.php
│   │   ├── authors.php
│   │   └── categories.php
│   └── index.php
├── composer.json
└── README.md
```

## Features
- **Book Management**: Add, edit, delete, and search for books.
- **Author Management**: Add, edit, delete, and search for authors.
- **Category Management**: Add, edit, delete, and search for categories.

## Installation
1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd php-library-system
   ```
3. Install dependencies using Composer:
   ```
   composer install
   ```

## Usage
- Access the application by navigating to `src/index.php` in your web browser.
- Use the provided forms to manage books, authors, and categories.

## Contributing
Contributions are welcome! Please submit a pull request or open an issue for any enhancements or bug fixes.

## License
This project is licensed under the MIT License.