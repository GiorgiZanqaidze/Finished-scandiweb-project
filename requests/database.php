<?php 



// connection to sql database
$pdo = new PDO('mysql:host=localhost;port=3306; dbname=test', 'root', "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




// select all data from database
$statement = $pdo->prepare('SELECT * FROM product');
$statement->execute();
// fetch data as assosiate array
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

// product type assosiate array. Contains product types related to its type  
$productTypes = array(
    'DVD' => array(
        'description' => ["size"],
        'measure' => 'MB',
        'specialAttr' => 'size'
    ),
    'book' => array(
        'description' => ["weight"],
        'measure' => 'KG',
        'specialAttr' => 'weight'
    ),
    'furniture' => array(
        'description' => ["height", "length", "width"],
        'measure' => 'CM',
        'specialAttr' => 'dimmension'
    )
);


?>