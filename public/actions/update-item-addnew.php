<?php

session_start();
require_once(__DIR__ . "/../../private/database/connect.db.php");
require_once(__DIR__ . "/../../private/database/phone.class.php");

$dbh = get_database_connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = isset($_POST['category']) ? $_POST['category'] : null;
    $brand = isset($_POST['brand']) ? $_POST['brand'] : null;
    $model = isset($_POST['model']) ? $_POST['model'] : null;
    $camera = isset($_POST['camera']) ? (int)$_POST['camera'] : null;
    $cpu = isset($_POST['cpu']) ? $_POST['cpu'] : null;
    $size = isset($_POST['size']) ? $_POST['size'] : null;
    $memory = isset($_POST['memory']) ? (int)$_POST['memory'] : null;
    $battery = isset($_POST['battery']) ? (int)$_POST['battery'] : null;
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $color = isset($_POST['color']) ? $_POST['color'] : null;
    $price = isset($_POST['price']) ? (float)$_POST['price'] : null;
    $storage = isset($_POST['storage']) ? (int)$_POST['storage'] : null;
    $condition = isset($_POST['condition']) ? $_POST['condition'] : null;
    $years_used = isset($_POST['years_used']) ? (int)$_POST['years_used'] : null;

    $product_id = $_POST['product_id'];

    $variables = ['category', 'brand', 'model', 'camera', 'cpu', 'size', 'memory', 'battery', 'description', 'color', 'price', 'storage', 'condition', 'years_used'];
    
    foreach ($variables as $var) {
        if (isset($_POST[$var])) {
                $dbh->prepare('UPDATE phones SET ' . $var . ' = ? WHERE id = ?')->execute(array($_POST[$var], $product_id));
            exit();
        }
    }

    exit();
}