<?php   

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../templates/wishlist.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/wishlist.class.php');

$dbh = get_database_connection();


if(isset($_SESSION['user_id'])):
    $phones = Wishlist::getWishlistPhones($dbh, $_SESSION['user_id']);
    drawLogOutHeader('Wishlist');
    if(!empty($phones)){
        drawWishlist($phones);
    }else{
        drawEmptyWishlist();
    }
    drawFooter();
else:
    drawHeader('Wishlist');
    drawEmptyWishlist();
    drawFooter();
endif;
