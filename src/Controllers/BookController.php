<?php

namespace App\Controllers;

require_once __DIR__ . '/../Services/BookService.php';
require_once __DIR__ . '/../Repositories/BookRepository.php'; 

use App\Services\BookService;
use App\Repositories\BookRepository;


class BookController
{
    private $bookService;

    public function index()
{
    $books = $this->searchBooks([]);
    echo "<h1>Books</h1><ul>";
    foreach ($books as $book) {
        echo "<li>" . htmlspecialchars(implode(", ", $book->getDetails())) . "</li>";
    }
    echo "</ul>";
}
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function addBook($data)
    {
        return $this->bookService->createBook($data);
    }

    public function editBook($id, $data)
    {
        return $this->bookService->modifyBook($id, $data);
    }

    public function deleteBook($id)
    {
        return $this->bookService->removeBook($id);
    }

public function searchBooks($criteria = [])
{
    return $this->bookService->findBooks($criteria);
}

public function loanBook($bookId): bool
{
    return $this->bookService->loanBook($bookId);
}
}