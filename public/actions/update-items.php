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
    $product_id = $_POST['product_id'];
    if(empty($_FILES['image-upload']['name'])){
        $image = Phone::getImageById($dbh, $product_id);
    } else {
        $image = $_FILES['image-upload']['name'];
    }

    $variables = ['category', 'brand', 'model', 'camera', 'cpu', 'size', 'memory', 'battery', 'description', 'color', 'price', 'storage', 'condition', 'years_used'];
    
    foreach ($variables as $var) {
        if (empty($_POST[$var])) {
            $_SESSION['update_error'] = "Error: $var is empty.";
            header("Location: /pages/edit-product.php?phone_id=$product_id");
            exit;
        }
    }

    if (empty($image)) {
        $_SESSION['update_error'] = "Error: Image is empty.";
        header("Location: /pages/edit-product.php?phone_id=$product_id");
        exit;
    }

    $existing_phone = Phone::get_phone_by_id($dbh, $product_id);

    if (!$existing_phone) {
        $_SESSION['update_error'] = "Error: Product not found.";
        header('Location: /pages/edit-product.php=$product_id');
        exit;
    }

    $existing_phone->category = $category;
    $existing_phone->brand = $brand;
    $existing_phone->model = $model;
    $existing_phone->camera = $camera;
    $existing_phone->cpu = $cpu;
    $existing_phone->size = $size;
    $existing_phone->memory = $memory;
    $existing_phone->battery = $battery;
    $existing_phone->description = $description;
    $existing_phone->color = $color;
    $existing_phone->price = $price;
    $existing_phone->storage = $storage;
    $existing_phone->condition = $condition;
    $existing_phone->years_used = $years_used;
    $existing_phone->image = $image;

    Phone::updatePhoneDatabase($dbh, $existing_phone);

    $target_file = "../images/" . $image;
    move_uploaded_file($_FILES['image-upload']['tmp_name'], $target_file);

    if (!isset($_POST['operator_request'])) {
        header('Location: /pages/index.php');
    }

    exit();
}