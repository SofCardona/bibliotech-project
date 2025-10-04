<?php
require_once 'Controllers/BookController.php';
require_once 'Controllers/AuthorController.php';
require_once 'Controllers/CategoryController.php';
require_once 'Database/Database.php';
require_once 'Repositories/AuthorRepository.php';
require_once 'Services/AuthorService.php';
require_once 'Repositories/BookRepository.php';
require_once 'Services/BookService.php';

use App\Controllers\BookController;
use App\Controllers\CategoryController;
use App\Controllers\AuthorController;
use App\Repositories\AuthorRepository;
use App\Services\AuthorService;
use App\Repositories\BookRepository;
use App\Services\BookService;


// Instancia las dependencias
$authorRepository = new AuthorRepository();
$authorService = new AuthorService($authorRepository);
$authorController = new AuthorController($authorService);

$bookRepository = new BookRepository();
$bookService = new BookService($bookRepository);
$bookController = new BookController($bookService);

$categoryController = new CategoryController();


$requestUri = $_SERVER['REQUEST_URI'];

switch (rtrim($requestUri, '/')) {
    case '':
    case '/':
        echo "<h1>Bienvenido a la Biblioteca</h1>";
        break;
case '/books':
    include __DIR__ . '/Views/books.php';
    break;
case '/authors':
    include __DIR__ . '/Views/authors.php';
    break;
case '/categories':
    include __DIR__ . '/Views/categories.php';
        break;
    default:
        echo "404 Not Found";
        break;
}
?>