<?php 

// connection to sql database
$pdo = new PDO('mysql:host=localhost;port=3306; dbname=test', 'root', "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// if delete-multiple-products and deleteId exist after submition then execute code
if (isset($_POST['delete-multiple-products']) && isset($_POST['deleteId']))
{
    // all checkboxes ids array
    $all_id = $_POST['deleteId'];

    // loop the checkbox ids array and delete items in database one by one
    foreach ($all_id as $i => $all_id) {
        $statement = $pdo->prepare('DELETE FROM product WHERE id = :id');
        $statement->bindValue(':id', $all_id);
        $statement->execute();
    }
    // change location to index.php
    header("Location: ../index.php");
} else {
    // change location to index.php
    header("Location: ../index.php");
};

?>