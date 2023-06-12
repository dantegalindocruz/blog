<?php
require '../setup.php';

$title = 'Categories';
$description = 'A list of available categories';
$categories = $blog->getCategory()->get_all_categoriies();
?>
<?php include '../includes/header.php' ?>
<main>
    <section class="categories">
        <table>
            <tr>
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach($categories as $category) {?>
                <tr>
                    <td><?= $category['name'] ?></td>
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
