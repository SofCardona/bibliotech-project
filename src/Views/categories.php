<?php


require_once __DIR__ . '/../Controllers/CategoryController.php';

use App\Controllers\CategoryController;

global $categoryController;
$categoryController = new CategoryController();
$categories = $categoryController->searchCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Categories</title>
</head>
<body>
    <h1>Manage Categories</h1>


    <h2>Existing Categories</h2>
<ul>
    <?php foreach ($categories as $category): ?>
        <li>
            ID: <?php echo htmlspecialchars($category->getId()); ?> -
            <?php echo htmlspecialchars($category->getDetails()); ?>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>