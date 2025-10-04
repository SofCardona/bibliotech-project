<?php

namespace App\Services;

use App\Repositories\AuthorRepository;
use App\Models\Author;

class AuthorService
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function createAuthor($data)
    {
 
        return $this->authorRepository->save($data);
    }

    public function modifyAuthor($id, $data)
{

    $author = new Author($id, $data['name'], $data['biography']);
    return $this->authorRepository->update($author);
}

    public function removeAuthor($id)
    {

        return $this->authorRepository->delete($id);
    }

public function findAuthors($criteria = [])
{

    return $this->authorRepository->findAll();
}
}