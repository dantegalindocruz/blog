<?php

require '../setup.php';
$data['name'] = '';
$data['description'] = '';
$message = '';
$category = $blog->getCategory();

if($_SERVER['REQUEST_METHOD'] == "POST") {


    $data = filter_input_array(INPUT_POST);
    $category->createCategory($data);
    
}

?>

<h1> This is the index page </h1>
<p><?= $message ?></p>
<?= var_dump($data) ?>
<form action="index.php" method="post">
    <p>Category <input type="text" name="name" value="<?= $data['name'] ?>" /></p>
    <p>Description <textarea name="description"><?= $data['description']?></textarea></p>
    <p><input type="submit" value="submit"/></p>
</form>