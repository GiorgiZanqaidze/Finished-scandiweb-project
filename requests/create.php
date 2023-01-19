<?php
// connection to sql database
$pdo = new PDO('mysql:host=localhost;port=3306; dbname=test', 'root', "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// require "../connection.php";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
  // assign values to variables from form inputs
  $sku = $_POST['sku'];
  $name = $_POST['name'];
  $price = $_POST['price'];
  $type = $_POST['type'];
  
  // if input type is furniture description must be in HxWxL format. Otherwise assign as for input value
  if ($type === 'furniture') {
      $description = $_POST['height']."x".$_POST['length']."x".$_POST['width'];
    } else {
        $description = $_POST['weight'] ?? $_POST['size'];
}

  // insert input values to database
  $statement = $pdo->prepare("INSERT INTO product (sku, name, price, type, description) 
  VALUES (:sku, :name, :price, :type, :description)");
  
  $statement->bindValue(':sku', $sku);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':price', $price);
  $statement->bindValue(':type', $type);
  $statement->bindValue(':description', $description);
  
}

?>