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
    drawLogOutHeader('Add Product');
    drawAddProduct($categories, $conditions);
    drawFooter();
endif;