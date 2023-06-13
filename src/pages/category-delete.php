<?php
include '../setup.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$category = $blog->getCategory()->get_single_category($id);

?>

<?php include '../includes/header.php' ?>

<?php include '../includes/footer.php' ?>