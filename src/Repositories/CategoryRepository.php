<?php

namespace App\Repositories;

require_once __DIR__ . '/../Models/Category.php';

use App\Models\Category;
class CategoryRepository {
    private $categories = [];

public function __construct()
{
    $this->categories = [
        new \App\Models\Category(1, 'Novela', 'Narrativa extensa'),
        new \App\Models\Category(2, 'Romance', 'Historias de amor'),
    ];
}
    public function save(Category $category) {
        $this->categories[$category->getId()] = $category;
    }

    public function update(Category $category) {
        if (isset($this->categories[$category->getId()])) {
            $this->categories[$category->getId()] = $category;
        }
    }

    public function delete($id) {
        if (isset($this->categories[$id])) {
            unset($this->categories[$id]);
        }
    }

    public function find($id) {
        return $this->categories[$id] ?? null;
    }

    public function findAll()
{
    return $this->categories;
}
}