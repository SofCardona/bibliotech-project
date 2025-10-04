<?php

namespace App\Repositories;

require_once __DIR__ . '/../Models/Book.php';

use App\Models\Book;

class BookRepository {
    private $books = [];

    public function __construct()
{
    $this->books = [
        new \App\Models\Book(1, 'Cien años de soledad', 1, 1, true),
        new \App\Models\Book(2, 'Orgullo y prejuicio', 2, 2, true),
        new \App\Models\Book(3, 'Don Quijote de la Mancha', 3, 1, true),
    ];
}
    public function save(Book $book) {
        $this->books[$book->getId()] = $book;
    }

    public function update(Book $book) {
        if (isset($this->books[$book->getId()])) {
            $this->books[$book->getId()] = $book;
        }
    }

    public function delete($id) {
        if (isset($this->books[$id])) {
            unset($this->books[$id]);
        }
    }

    public function find($id) {
        return $this->books[$id] ?? null;
    }

public function findAll()
{
    return $this->books;
}

public function getNextId()
{
    if (empty($this->books)) {
        return 1;
    }

    $ids = array_map(function($book) {
        return $book->getId();
    }, $this->books);
    return max($ids) + 1;
}
}

