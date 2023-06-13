<?php
require '../setup.php';

/* 
    if the page is editing an exiting category, the url will have a query string 
    with the name id, its value will be the id of the category to edit
*/
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Gets id and validate

// Initialize category array
$category = [
    'id' => $id,
    'name' => '',
    'description' => '',
    'navigation' => false,
];

// initiailize erros array
$errors = [
    'warning' => '',
    'name' => '',
    'description' => ''
];

// if there was an id, page is editing the category, so get current category

if($id){
    // get category data
    $category = $blog->getCategory()->get_single_category($id);

    /* 
        If there was an id in the query string, but the database did not find a matching
        category, the $category varialbe will hold false and the suswquent code block will run
    */
    // if no category is found
    if(!$category) {
        redirect('categories.php', ['failure' => 'Category not found']);
    }
}

// Get and validate data once form has been submitted
// checks to see if form has been submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $category['name'] = $_POST['name'];
    $category['description'] = $_POST['description'];
    $category['navigation'] = (isset($_POST['navigation']) and ($_POST['navigation'] == 1)) ? 1 : 0; // get navigation 

    // Check if data is valid and create error messages if it is invalid

    $errors['name'] = (is_text($category['name'], 1, 24)) ? '' : 'Name should be 1-24 characters';
    $errors['description'] = (is_text($category['description'], 1, 254)) ? '' : 'Description must be 1-254 charactters';

    // join error messages
    $invalid = implode($errors);

    // Check if data is valid, if so update database

    if($invalid) {
        $errors['warning'] = 'Please correct errors';
    } else {
        $arguments = $category;

        if($id) {
            $blog->getCategory()->update_category($category);
            redirect('categories.php', ['success' => 'Category Saved']);
        } else {
            unset($arguments['id']); // remove id from arguments array
            try {
                $blog->getCategory()->create_category($arguments);
                redirect('categories.php', ['success' => 'Category Saved']); 
            } catch (PDOException $e) {
                if($e->errorInfo[1] === 1062) {
                    $errors['warning'] = 'Category name already in use';
                } else {
                    throw $e;
                }
            }
            
        }
}
}


$title = $category['name'];
$description = $category['description'];


?>
<?php include '../includes/header.php' ?>

<form action="category.php?id=<?= $id ?>" method="post">
    <h2><?= ($id) ? 'Edit Category' : 'Add New Category'?></h2>
    <?php if($errors['warning']) { ?>
        <p><?= $errors['warning'] ?></p>
    <?php } ?>
    <p>
        Category Name: <input type="text" name="name" value="<?= html_escape($category['name'])?>" />
        <br />
        <span><?= $errors['name'] ?></span>
    </p>
    <p>
        Description: <textarea name="description"><?= html_escape($category['description'])?></textarea>
        <br />
        <span><?= $errors['description'] ?></span>
    </p>
    <p><input type="checkbox" name="navigation" value="1" <?= ($category['navigation'] === 1) ? 'checked' : '' ?>> Navigation</p>
    <p><input type="submit" value="submit"/></p>
</form>
<?php include '../includes/footer.php' ?>