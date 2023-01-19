<?php
require_once 'requests/database.php';
require_once('validator.php');

// if user submit the form
if (isset($_POST['submit'])) {

    // new class of Product validation
    // first parameter: form inputs data
    // second parameter: existing data in database for unique sku
    $validation = new ProductValidator($_POST, $products);
    
    // evaluate public validateForm function
    $errors = $validation->validateForm();

    // if errors array is empty then import create.php to execute code. After change location to index.php.
    if (empty($errors)) {
        require('requests/create.php');
        $statement->execute();  
        
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../scandiwebLogo.png">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Add Product</title>
</head>
<body>
    <!-- do not change the location after submition. action url PHP_SELF -->
    <form class='product_form' id='product_form' method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" >
        <header class='navigation'>
                <h1>Add product</h1>
                <div class='btns-wrapper'>
                    <button id='delete-product-btn' class='btn' name="submit">Save</button>
                    <a href='index.php' class='btn'>Cancel</a>
                </div>
        </header>
        <div class="box-border container form-container">
            <div class='item-container'>
                <label htmlFor='sku'>SKU</label>
                <!-- remain the sku after submition with php-->
                <input type='text' name="sku" id='sku' value="<?php echo $_POST['sku'] ?? "" ?>"/><br />
                <span class="alert-danger">
                    <!-- error for sku -->
                    <?php  echo $errors['sku'] ?? '' ?>
                </span>
            </div>
            <div class='item-container'>
                <label htmlFor='name'>Name</label>
                <!-- remain the name after submition with php-->
                <input type='text' name="name" id='name' value="<?php echo $_POST['name'] ?? "" ?>" /><br />
                <span class="alert-danger">
                    <!-- error for name -->
                    <?php  echo $errors['name'] ?? '' ?>
                </span>
            </div>
            <div class='item-container'>
                <label htmlFor='price'>Price ($)</label>
                <!-- remain the price after submition with php-->
                <input type='text' name="price" id='price' value="<?php echo $_POST['price'] ?? "" ?>" /><br />
                <span class="alert-danger">
                    <?php  echo $errors['price'] ?? '' ?>
                </span>
            </div>
            <div class='item-container'>
                <label htmlFor='type'>Type Switcher</label>
                <select name="type" id="productType">
                    <!-- remain the type after submition with php -->
                    <option value="null" class="option" <?php if(isset($_POST['type']) && $_POST['type'] == 'null') echo 'selected' ?> >Type Switcher</option>
                    <option value='DVD' class="option" name="DVD" <?php if(isset($_POST['type']) && $_POST['type'] == 'DVD') echo 'selected' ?>  >DVD</option>
                    <option value='book' class="option" name="book" <?php if(isset($_POST['type']) && $_POST['type'] == 'book') echo 'selected' ?>  >Book</option>
                    <option value='furniture' class="option" name="furniture" <?php if(isset($_POST['type']) && $_POST['type'] == 'furniture') echo 'selected' ?>  >Furniture</option>
                </select>
            </div>
            <div class='description'>
                <!-- js into html -->
            </div>
            <span class="alert-danger">
                <!-- error for type -->
                <?php  echo $errors['type'] ?? '' ?>
            </span>
        </div>
    </form>
</body>
     <script src="index.js"></script> 
</html>