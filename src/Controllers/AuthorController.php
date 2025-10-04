<?php

namespace App\Controllers;

require_once __DIR__ . '/../Services/AuthorService.php'; 
require_once __DIR__ . '/../Repositories/AuthorRepository.php';

use App\Services\AuthorService;
use App\Repositories\AuthorRepository;


class AuthorController
{
    private $authorService;

    public function index()
{
    $authors = $this->searchAuthors([]);
    echo "<h1>Authors</h1><ul>";
    foreach ($authors as $author) {
        echo "<li>" . htmlspecialchars($author->getName()) . "</li>";
    }
    echo "</ul>";
}
public function __construct(AuthorService $authorService)
{
    $this->authorService = $authorService;
}

    public function addAuthor($data)
    {
        return $this->authorService->createAuthor($data);
    }

    public function editAuthor($id, $data)
    {
        return $this->authorService->modifyAuthor($id, $data);
    }

    public function deleteAuthor($id)
    {
        return $this->authorService->removeAuthor($id);
    }

public function searchAuthors($criteria = [])
{
    return $this->authorService->findAuthors($criteria);
}
}