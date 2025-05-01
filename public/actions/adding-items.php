<?php

session_start();
require_once(__DIR__ . "/../../private/database/connect.db.php");
require_once(__DIR__ . "/../../private/database/phone.class.php");

$dbh = get_database_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $camera = (int)$_POST['camera'];
    $cpu = $_POST['cpu'];
    $size = $_POST['size'];
    $memory = (int)$_POST['memory'];
    $battery = (int)$_POST['battery'];
    $description = $_POST['description'];
    $color = $_POST['color'];
    $price = (float)$_POST['price'];
    $storage = (int)$_POST['storage'];
    $condition = $_POST['condition'];
    $years_used = (int)$_POST['years_used'];
    $image = $_FILES['image-upload']['name'];

    $variables = ['category', 'brand', 'model', 'camera', 'cpu', 'size', 'memory', 'battery', 'description', 'color', 'price', 'storage', 'condition', 'years_used'];

    foreach ($variables as $var) {
        if (empty($_POST[$var])) {
            $_SESSION['add_error'] = "Error: $var is empty.";
            header('Location: /pages/add-product.php');
            exit;
    }

    if (empty($image)) {
        $_SESSION['add_error'] = "Error: Image is empty.";
        header('Location: /pages/add-product.php');
        exit;
    }

    $new_phone = new Phone(
        -2,
        $category,
        $color,
        $price,
        $storage,
        $condition,
        $years_used,
        $_SESSION['user_id'],
        $image,
        $brand,
        $model,
        $camera,
        $cpu,
        $size,
        $memory,
        $battery,
        $description
    );

    $id = Phone::addPhoneDatabase($dbh, $new_phone);
    $target_file = "../images/" . $image;
    move_uploaded_file($_FILES['image-upload']['tmp_name'], $target_file);
    header('Location: /pages/index.php');
    exit();

}

    
}