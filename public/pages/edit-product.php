<?php
declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/product.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/phone.class.php');

$dbh = get_database_connection();
$categories = Phone::getCategoriesPhone($dbh);
$conditions = Phone::getConditionsPhone($dbh);

if(isset($_SESSION['user_id'])):
    
    $phone_id = isset($_POST['phone_id']) ? (int)$_POST['phone_id'] : null;
    
    if ($phone_id) {
        $product = Phone::get_phone_by_id($dbh, $phone_id);
        
        if ($product && $product->seller == $_SESSION['user_id']) {

            drawLogOutHeader('Update Product');
            drawUpdateProduct($categories, $conditions, $product);
            drawFooter();
        } else {
            echo "Product not found or you're not authorized to edit this product.";
        }

    } else {
        echo "No product ID provided.";
    }
endif;