<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/cart.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/phone.class.php');
require_once(__DIR__ . '/../../private/database/wishlist.class.php');

$dbh = get_database_connection();
$ids = $_SESSION['cart'];
$phones = [];

if(isset($_SESSION['user_id'])):
    drawLogOutHeader('Shopping Cart');
    if(!empty($ids)){
        foreach($ids as $id){
            $id = (int)$id;
            $phones[] = Phone::get_phone_by_id($dbh, $id);
        }
        drawCart($phones);
    }else{
        drawEmptyCart();
    }
    drawFooter();
else:
    drawHeader('Shopping Cart');
    drawEmptyCart();
    drawFooter();
endif;

