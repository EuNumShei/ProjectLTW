<?php
declare(strict_types=1);
session_start();

$is_invalid = false;

require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/user.class.php');

$dbh = get_database_connection();

if(!$dbh) {
    die('Failed to establish database connection');
}

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = $dbh->prepare($sql);

$stmt->execute([$_POST['email']]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user) {
    if(password_verify($_POST['password'], $user['password_hash'])){
        $_SESSION['user_id'] = $user['id'];
        session_regenerate_id();
        header("Location: /pages/index.php");
        exit();
    }
}

$is_invalid = true;
$_SESSION['is_invalid'] = $is_invalid;
header("Location: /pages/login.php");
exit();