<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/profile.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../../private/database/user.class.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/phone.class.php');
require_once(__DIR__ . '/../../private/database/cart.class.php');

$dbh = get_database_connection();

if(isset($_SESSION['user_id'])):
    $user = User::getUserById($dbh, $_SESSION['user_id']);

    $phones = Phone::getPhonesBySeller($dbh, $_SESSION['user_id']);
    $phones = array_slice($phones, 0, 5);

    $purchases = Cart::getCartByBuyer($dbh, $_SESSION['user_id']);
    $purchases = array_slice($purchases, 0, 5);

    $sales = Cart::getCartBySeller($dbh, $_SESSION['user_id']);
    $sales = array_slice($sales, 0, 5);

    $purchases_prices = [];
    $sales_prices = [];

    foreach($purchases as $purchase){
        $products = Cart::getCartPhones($dbh, $purchase['id']);
        $prices = Cart::getCartPrices($dbh, $purchase['id']);
        $products_prices = [$products, $prices];
        $purchases_prices[] = $products_prices;
    }

    foreach($sales as $sale){
        $products = Cart::getCartPhones($dbh, $sale['id']);
        $prices = Cart::getCartPrices($dbh, $sale['id']);
        $sellers = Cart::getCartSellers($dbh, $sale['id']);
        $products_prices = [$products, $prices, $sellers];
        $sales_prices[] = $products_prices;
    }

    drawLogOutHeader('My Profile');

    if(isset($_GET['edit'])){
        if(isset($_GET['username'])){
            drawUsernameChanges();
        }else if(isset($_GET['email'])){
            drawEmailChanges();
        }else if(isset($_GET['password'])){
            drawPasswordChanges();
        }else{
            drawProfileChanges();
        }
    }else{
        if ($user->op() == 1) {
            drawProfileOperator($user, $purchases_prices, $sales_prices, $phones);
        } else {
            drawProfile($user, $purchases_prices, $sales_prices, $phones);
        }
    }
else:
    drawHeader('Second Hand Smartphones');
    drawProfileNoUser();
drawFooter();
endif;