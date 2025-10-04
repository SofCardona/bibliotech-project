<?php

namespace App\Services;

require_once __DIR__ . '/../Repositories/BookRepository.php';

use App\Repositories\BookRepository;
use App\Models\Book;

class BookService
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

public function createBook($data)
{
    $book = new \App\Models\Book(
        $this->bookRepository->getNextId(),
        $data['title'],
        $data['authorId'],
        $data['categoryId'],
        true
    );
    $this->bookRepository->save($book);
    return $book;
}

    public function modifyBook($id, $data)
    {

        return $this->bookRepository->update($data);
    }

    public function removeBook($id)
    {

        return $this->bookRepository->delete($id);
    }

public function findBooks($criteria = [])
{
    $books = $this->bookRepository->findAll();
    $filtered = [];

    foreach ($books as $book) {
        $match = true;
    if (isset($criteria['title']) && stripos($book->getTitle(), $criteria['title']) === false) {
    $match = false;
    }
        if (isset($criteria['authorId']) && $book->getAuthorId() != $criteria['authorId']) {
            $match = false;
        }
        if (isset($criteria['categoryId']) && $book->getCategoryId() != $criteria['categoryId']) {
            $match = false;
        }
        if ($match) {
            $filtered[] = $book;
        }
    }
    return $filtered;
}

public function loanBook($bookId)
{
$book = $this->bookRepository->find($bookId);
if ($book && method_exists($book, 'isAvailable') && $book->isAvailable()) {
    $book->setAvailable(false);
    $this->bookRepository->update($book);

    return true;
}
return false;
}


}