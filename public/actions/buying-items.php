<?php

session_start();

require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/wishlist.class.php');
require_once(__DIR__ . '/../../private/database/phone.class.php');
require_once(__DIR__ . '/../../private/database/cart.class.php');

$dbh = get_database_connection();

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone_id = (int)$_POST['phone_id'];
    
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }else{
        $_SESSION['not_authenticated'] = true;
        header('Location: /pages/model.php?id=' . $phone_id);
        exit;
    }

    if($_POST['action'] === 'add_to_wishlist'){
        $wishlist = Wishlist::getWishlistPhones($dbh, $user_id);
        foreach($wishlist as $phone){
            if($phone->id === $phone_id){
                $_SESSION['already_existing'] = true;
                header('Location: /pages/model.php?id=' . $phone_id);
                exit;
            }
        }
        foreach($_SESSION['cart'] as $key => $value){
            if($value === $phone_id){
                $_SESSION['already_existing'] = true;
                header('Location: /pages/model.php?id=' . $phone_id);
                exit;
            }
        }
        Wishlist::addPhoneWishlist($dbh, $user_id, $phone_id);
        header('Location: /pages/wishlist.php');
    }else if($_POST['action'] === 'add_to_cart'){
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }else{
            $cart = [];
        }
        $wishlist = Wishlist::getWishlistPhones($dbh, $user_id);
        foreach($wishlist as $phone){
            if($phone->id === $phone_id){
                $_SESSION['already_existing'] = true;
                header('Location: /pages/model.php?id=' . $phone_id);
                exit;
            }
        }
        foreach($_SESSION['cart'] as $key => $value){
            if($value === $phone_id){
                $_SESSION['already_existing'] = true;
                header('Location: /pages/model.php?id=' . $phone_id);
                exit;
            }
        }
        $cart[] = $phone_id;
        $_SESSION['cart'] = $cart;
        header('Location: /pages/cart.php');
    }else if($_POST['action'] === 'add_to_cart_from_wishlist'){
        if(isset($_SESSION['cart'])){
            $cart = $_SESSION['cart'];
        }else{
            $cart = [];
        }

        $phones = Wishlist::getWishlistPhones($dbh, $user_id);

        foreach($phones as $phone){
            $cart[] = $phone->id;
        }

        $_SESSION['cart'] = $cart;
        
        foreach($phones as $phone){
            Wishlist::deletePhoneWishlist($dbh, $user_id, $phone->id);
        }

        header('Location: /pages/cart.php');
    }else if($_POST['action'] === "complete_purchase"){
        if(!preg_match('/^[a-zA-Z]+$/', $_POST['name'])) {
            $_SESSION['buy_error'] = 'Name should contain only letters';
            $_SESSION['show_payment_form'] = true;
            header('Location: /pages/cart.php');
            exit();
        }if(!preg_match('/^[0-9]+$/', $_POST['number'])) {
            $_SESSION['buy_error'] = 'Credit Card Number should contain only numbers';
            $_SESSION['show_payment_form'] = true;
            header('Location: /pages/cart.php');
            exit();
        }if(sizeof(explode('/', $_POST['validity'])) != 2 || !preg_match('/^[0-9]+$/', explode('/', $_POST['validity'])[0]) || strlen(explode('/', $_POST['validity'])[0]) != 2 || !preg_match('/^[0-9]+$/', explode('/', $_POST['validity'])[1]) || strlen(explode('/', $_POST['validity'])[1]) != 2 ) {
            $_SESSION['buy_error'] = 'Validity not in the correct format';
            $_SESSION['show_payment_form'] = true;
            header('Location: /pages/cart.php');
            exit();
        }else if(!preg_match('/^[0-9]+$/', $_POST['cvv']) || strlen($_POST['cvv']) != 3) {
            $_SESSION['buy_error'] = 'CVV should contain only numbers and be 3 characters long';
            $_SESSION['show_payment_form'] = true;
            header('Location: /pages/cart.php');
            exit();
        }
        
        $cart = $_SESSION['cart'];
        $products = "";
        $prices = "";
        foreach($cart as $key => $value){
            $tele = Phone::get_phone_by_id($dbh, $value);
            $products = $products . Phone::getCorrectName($dbh, $tele) . ',';
            $prices = $prices . Phone::getPricePhone($dbh, $tele) . ',';
            Phone::deletePhoneById($dbh, $value);
        }
        $products = rtrim($products, ",");
        $prices = rtrim($prices, ",");

        Cart::addPurchaseCart($dbh, $user_id, $tele->seller, $products, $prices);

        $_SESSION['cart'] = []
;

        header('Location: /pages/index.php');

    }

    exit;
}