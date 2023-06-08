<?php
require '../setup.php';

$title = 'Categories';
$description = 'A list of available categories';
$categories = $blog->getCategory()->get_all_categoriies();
?>
<?php require '../includes/header.php' ?>
<main>
    <section class="categories">
        <h1><?= $title ?></h1>
    </section>
</main>
<?php require '../includes/footer.php' ?>
