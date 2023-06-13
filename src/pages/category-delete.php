<?php
include '../setup.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$category = '';

if(!$id) {
    redirect('categories.php', ['failure' => 'Category not found']);
}

$category = $blog->getCategory()->get_category_name($id);

if(!$category) {
    redirect('categories.php', ['failure' => 'Category not found']);
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try{
        $blog->getCategory()->delete_category($id);
        redirect('categories.php', ['success' => 'Category deleted']);
    } catch(PDOException $e) {
        /* if integrity constriant, prevents the category from being deleted becauase this 
            category still contains articles
        */
        if($e->errorInfo[1] === 1451) {
            redirect('categories.php', ['failure' => 'Category contains articles that must be moved or deleted before you can delte it!']);
        } else {
            throw $e;
        }
    }
}

$tile = 'Delete ' . $category;
$description = 'Deleting a category.'
?>

<?php include '../includes/header.php' ?>
<main>
    <h2>Delete Category</h2>
    <form action="category-delete.php?id=<?= $id ?>" method="POST">
        <p>Click confirm to delete the category <?= html_escape($category) ?></p>
        <input type="submit" name="delete" value="confirm">
        <a href="categories.php">cancel</a>
    </form>
</main>

<?php include '../includes/footer.php' ?>