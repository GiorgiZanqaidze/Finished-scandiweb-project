
<?php 

// import products from database
require_once "requests/database.php";

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
    <title>Product List</title>
</head>
<body>
    <form action="requests/delete.php" method="POST">
        <header class='navigation'>
            <h1>Product List</h1>
            <div class='btns-wrapper'>
                <a href='addProduct.php' class='btn'>ADD</a>
                <button type="submit" id='delete-product-btn' class='btn' name="delete-multiple-products">MASS DELETE</button>
            </div>
        </header>
        <ul class='box-border container'>
            <!-- loop through products array from database -->
            <?php foreach ($products as $i => $product) { ?>
                <?php
                    // different measure attribute for each list items
                    $measure = $productTypes[$product['type']]['measure'];
                    // different specialAttr attribute for each list items
                    $specialAttr = $productTypes[$product['type']]['specialAttr'];
                ?>
                <li>
                    <input name="deleteId[]" type="checkbox" class='delete-checkbox' value='<?php echo $product['id'] ?>'/>
                    <h3><?php echo $product["sku"] ?></h3>
                    <p><?php echo $product["name"] ?></p>
                    <!-- change the format of number -->
                    <p><?php echo number_format($product["price"], 2 ) ?> $</p>
                    <p><?php echo ucfirst($specialAttr). ": " . $product["description"] . " " . $measure ?></p>
                </li>
            <?php } ?>
        </ul>
    </form>
</body>
</html>
            