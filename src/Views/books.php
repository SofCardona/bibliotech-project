<?php
require_once __DIR__ . '/../Repositories/BookRepository.php';
require_once __DIR__ . '/../Services/BookService.php';
require_once __DIR__ . '/../Controllers/BookController.php';

use App\Repositories\BookRepository;
use App\Services\BookService;
use App\Controllers\BookController;

// Instancia dependencias
$bookRepository = new BookRepository();
$bookService = new BookService($bookRepository);
$bookController = new BookController($bookService);

// AGREGAR LIBRO
$addMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addBook'])) {
    $data = [
        'title' => $_POST['title'] ?? '',
        'authorId' => $_POST['authorId'] ?? '',
        'categoryId' => $_POST['categoryId'] ?? '',
        'status' => true
    ];
    $result = $bookController->addBook($data);
    if ($result) {
        $addMessage = "<p>Libro agregado correctamente.</p>";
    } else {
        $addMessage = "<p>Error al agregar el libro.</p>";
    }
}

// ELIMINAR LIBRO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteBookId'])) {
    $bookController->deleteBook($_POST['deleteBookId']);
    header('Location: books.php');
    exit;
}

// EDITAR LIBRO (mostrar formulario)
$editBook = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editBookId'])) {
    $editBookId = $_POST['editBookId'];
    $booksAll = $bookController->searchBooks(); // sin filtros
    foreach ($booksAll as $book) {
        if ($book->getId() == $editBookId) {
            $editBook = $book;
            break;
        }
    }
}

// ACTUALIZAR LIBRO (procesar formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateBook'])) {
    $id = $_POST['updateBookId'];
    $data = [
        'title' => $_POST['title'] ?? '',
        'authorId' => $_POST['authorId'] ?? '',
        'categoryId' => $_POST['categoryId'] ?? ''
    ];
    $bookController->editBook($id, $data);
    header('Location: books.php');
    exit;
}

// BUSCAR LIBROS
$criteria = [];
if (isset($_GET['title'])) $criteria['title'] = $_GET['title'];
if (isset($_GET['authorId'])) $criteria['authorId'] = $_GET['authorId'];
if (isset($_GET['categoryId'])) $criteria['categoryId'] = $_GET['categoryId'];

$books = $bookController->searchBooks($criteria);
?>

// PRESTAR LIBRO
$success = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loanBookId'])) {
    $success = $bookController->loanBook($_POST['loanBookId']);
}
?>

<h1>Libros</h1>

<!-- Mensaje de resultado de agregar libro -->
<?= $addMessage ?>

<!-- Formulario para agregar libro -->
<form method="post">
    <input type="text" name="title" placeholder="Título" required>
    <input type="number" name="authorId" placeholder="ID Autor" required>
    <input type="number" name="categoryId" placeholder="ID Categoría" required>
    <button type="submit" name="addBook">Agregar Libro</button>
</form>

<!-- Formulario de búsqueda -->
<form method="get">
    <input type="text" name="title" placeholder="Título">
    <input type="number" name="authorId" placeholder="ID Autor">
    <input type="number" name="categoryId" placeholder="ID Categoría">
    <button type="submit">Buscar</button>
</form>

<!-- Listado de libros filtrados -->
<ul>
<?php foreach ($books as $book): ?>
    <li>
        <?= htmlspecialchars($book->getTitle()) ?> (ID: <?= $book->getId() ?>)

    </li>
<?php endforeach; ?>
</ul>

<!-- Mensaje de préstamo -->
<?php
if ($success !== null) {
    echo $success ? "<p>Préstamo realizado</p>" : "<p>No disponible</p>";
}
?>

<!-- Formulario de edición de libro -->
<?php if ($editBook): ?>
    <h2>Editar Libro</h2>
    <form method="post">
        <input type="hidden" name="updateBookId" value="<?= $editBook->getId() ?>">
        <input type="text" name="title" value="<?= htmlspecialchars($editBook->getTitle()) ?>" required>
        <input type="number" name="authorId" value="<?= htmlspecialchars($editBook->getAuthorId()) ?>" required>
        <input type="number" name="categoryId" value="<?= htmlspecialchars($editBook->getCategoryId()) ?>" required>
        <button type="submit" name="updateBook">Actualizar Libro</button>
    </form>
<?php endif; ?>

<!-- Listado de libros -->
<ul>
<?php foreach ($books as $book): ?>
    <li>
        <?= htmlspecialchars($book->getTitle()) ?> (ID: <?= $book->getId() ?>)
        <!-- Botón Prestar -->
        <?php if ($book->isAvailable()): ?>
            <form method="post" style="display:inline;">
                <input type="hidden" name="loanBookId" value="<?= $book->getId() ?>">
                <button type="submit">Prestar</button>
            </form>
        <?php else: ?>
            <span style="color:red;">Unavailable</span>
        <?php endif; ?>
        <!-- Botón Editar -->
        <form method="post" style="display:inline;">
            <input type="hidden" name="editBookId" value="<?= $book->getId() ?>">
            <button type="submit">Editar</button>
        </form>
        <!-- Botón Eliminar -->
        <form method="post" style="display:inline;">
            <input type="hidden" name="deleteBookId" value="<?= $book->getId() ?>">
            <button type="submit">Eliminar</button>
        </form>
    </li>
<?php endforeach; ?>
</ul>
</body>
</html>