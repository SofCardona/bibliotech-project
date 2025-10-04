<?php

namespace App\Models;

class Book {
    private $id;
    private $title;
    private $author;
    private $category;
    private $status;

    public function __construct($id, $title, $author, $category, $status = 'available') {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->category = $category;
        $this->status = $status;
    }

 public function getId()
{
    return $this->id;
}

    public function getTitle() {
    return $this->title;
}

public function getAuthor() {
    return $this->author;
}

public function getCategory() {
    return $this->category;
}

public function getStatus() {
    return $this->status;
}

public function getAuthorId() {

    return is_object($this->author) ? $this->author->getId() : $this->author;
}

public function getCategoryId() {
 
    return is_object($this->category) ? $this->category->getId() : $this->category;
}

public function isAvailable() {
    return $this->status === 'available';
}

    public function getDetails() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'category' => $this->category,
            'status' => $this->status,
        ];
    }

    public function setAvailable($available)
{
    $this->status = $available ? 'available' : 'loaned';
}

    public function updateStatus($status) {
        $this->status = $status;
    }
}