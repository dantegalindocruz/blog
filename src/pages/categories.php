<?php
require '../setup.php';

// check for success message
$success = $_GET['success'] ?? null;

// check for failure message
$failure = $_GET['failure'] ?? null;

$title = 'Categories';
$description = 'A list of available categories';
$categories = $blog->getCategory()->get_all_categoriies();
?>
<?php include '../includes/header.php' ?>
<main>
    <section class="categories">
        <div class="header">
            <h1>Categories</h1>
            <?php if($success) {?>
                <p><?= $success ?></p>
            <?php } ?>
            <?php if($failure) {?>
                <p><?= $failure ?></p>
            <?php } ?>
            <!-- When there is no query string, a new category is created -->
            <p><a href="category.php">Add new category</a></p>
        </div>
        
        <!--  Displays categories in the database -->
        <table>
            <tr>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach($categories as $category) {?>
                <tr>
                    <td><?= html_escape($category['name']) ?></td>
                    <td>
                        <a class="edit" href="category.php?id=<?= $category['id'] ?>">Edit</a>
                    </td>
                    <td>
                        <a class="delete" href="category-delete.php?id=<?= $category['id'] ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>
</main>
<?php include '../includes/footer.php' ?>
