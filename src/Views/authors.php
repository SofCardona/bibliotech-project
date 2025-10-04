<?php

namespace App\Controllers;

require_once __DIR__ . '/../Repositories/AuthorRepository.php';
require_once __DIR__ . '/../Services/AuthorService.php';
require_once __DIR__ . '/../Controllers/AuthorController.php';

use App\Repositories\AuthorRepository;
use App\Services\AuthorService;
use App\Controllers\AuthorController;


$authorRepository = new AuthorRepository();
$authorService = new AuthorService($authorRepository);
$authorController = new AuthorController($authorService);

$authors = $authorController->searchAuthors(); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>
</head>
<body>
    <h1>Authors</h1>

    <h2>Existing Authors</h2>
    <ul>
        <?php foreach ($authors as $author): ?>
            <li>
                ID: <?php echo htmlspecialchars($author->getId()); ?> -
                <?php echo htmlspecialchars($author->getName()); ?>
               
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>