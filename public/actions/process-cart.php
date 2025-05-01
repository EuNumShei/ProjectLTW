<?php
declare(strict_types=1);
session_start();

require_once(__DIR__ . '/../../private/database/connect.db.php');

$dbh = get_database_connection();

if(!$dbh) {
    die('Failed to establish database connection');
}

$userId = $_SESSION['user_id'];
if (!isset($userId)) {
    die('User not logged in');
}

