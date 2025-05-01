<?php

session_start();

require_once(__DIR__ . '/../../private/database/user.class.php');
require_once(__DIR__ . '/../../private/database/phone.class.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../templates/phones.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/op_dashboard.tpl.php');

$dbh = get_database_connection();

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone_id = $_POST['phone_id'];
    
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $_SESSION['not_authenticated'] = true;
        header('Location: /pages/index.php');
        exit;
    }

    if($_POST['action'] === 'remove_from_wishlist'){
        Wishlist::deletePhoneWishlist($dbh, $user_id, $phone_id);

        $response['success'] = true;
        $response['message'] = 'Item removed from wishlist';
    }else if($_POST['action'] === 'remove_from_cart'){
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }
        if (($key = array_search($phone_id, $cart)) !== false) {
            unset($cart[$key]);
        }
        $_SESSION['cart'] = $cart;
        $response['success'] = true;
        $response['message'] = 'Item removed from cart';
    }else if($_POST['action'] == 'remove_product'){
        Phone::deletePhoneById($dbh, $phone_id);

        header('Location: /pages/index.php');
    }

    echo json_encode($response);
    exit();
}