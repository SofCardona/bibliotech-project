<?php

namespace App\Repositories;

require_once __DIR__ . '/../Models/Author.php';

use App\Models\Author; 
class AuthorRepository {
    private $authors = [];

    public function __construct()
{
    $this->authors = [
        new Author(1, 'Gabriel García Márquez', 'Colombian novelist.'),
        new Author(2, 'Jane Austen', 'English novelist.'),
        new Author(3, 'Miguel de Cervantes', 'Spanish writer.'),
    ];
}
    
    public function save(Author $author) {
        $this->authors[$author->getId()] = $author;
    }

    public function update(Author $author) {
        if (isset($this->authors[$author->getId()])) {
            $this->authors[$author->getId()] = $author;
        }
    }

    public function delete($id) {
        if (isset($this->authors[$id])) {
            unset($this->authors[$id]);
        }
    }

    public function find($id) {
        return $this->authors[$id] ?? null;
    }

public function findAll()
{
    return $this->authors;
}
}