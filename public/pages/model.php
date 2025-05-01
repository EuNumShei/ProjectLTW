<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/phone.class.php');
require_once(__DIR__ . '/../templates/phones.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');

$id = intval($_GET['id']);

$dbh = get_database_connection();
$phone = Phone::get_phone_by_id($dbh, $id);
$seller = User::getUserById($dbh, $phone->seller);

if(isset($_SESSION['user_id'])):
    drawLogOutHeader('Second Hand Smartphones');
    drawModel($phone, $seller);
    drawFooter();
else:
    drawHeader('Second Hand Smartphones');
    drawModel($phone, $seller);
    drawFooter();
endif;