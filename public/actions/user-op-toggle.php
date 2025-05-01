<?php

declare(strict_types=1);

session_start();
require_once(__DIR__ . '/../../private/database/user.class.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/phone.class.php');
require_once(__DIR__ . '/../../private/database/cart.class.php');
require_once(__DIR__ . '/../templates/phones.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/op_dashboard.tpl.php');

$dbh = get_database_connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user-id'])) {
        $user_id = $_POST['user-id'];
        User::toggleUserOp($dbh, (int)$user_id);
    } else {
        error_log('user-id not set in POST data');
    }

    exit();
}