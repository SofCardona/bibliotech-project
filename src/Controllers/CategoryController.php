<?php

namespace App\Controllers;

require_once __DIR__ . '/../Services/CategoryService.php'; 
require_once __DIR__ . '/../Repositories/CategoryRepository.php';

use App\Services\CategoryService;
use App\Repositories\CategoryRepository;
class CategoryController
{
    private $categoryService;

    public function index()
{
    $categories = $this->searchCategories([]);
    echo "<h1>Categories</h1><ul>";
    foreach ($categories as $category) {
        echo "<li>" . htmlspecialchars($category->getName()) . "</li>";
    }
    echo "</ul>";
}
    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function addCategory($data)
    {
        return $this->categoryService->createCategory($data['id'], $data['name'], $data['description']);
    }

    public function editCategory($id, $data)
    {
        return $this->categoryService->modifyCategory($id, $data['name'], $data['description']);
    }

    public function deleteCategory($id)
    {
        return $this->categoryService->removeCategory($id);
    }

    public function searchCategories($criteria = [])
{
    return $this->categoryService->findCategories($criteria);
}
}