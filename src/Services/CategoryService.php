<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Models\Category;

class CategoryService
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = new CategoryRepository();
    }

    public function createCategory($id, $name, $description)
    {

        $category = new Category($id, $name, $description);
        return $this->categoryRepository->save($category);
    }

    public function modifyCategory($id, $name, $description)
    {

        $category = $this->categoryRepository->find($id);
        if ($category) {
            $category->setName($name);
            $category->setDescription($description);
            return $this->categoryRepository->update($category);
        }
        return false;
    }

    public function removeCategory($id)
    {

        return $this->categoryRepository->delete($id);
    }

public function findCategories($criteria = [])
{
    return $this->categoryRepository->findAll();
}
}