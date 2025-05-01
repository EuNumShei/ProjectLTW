<?php
declare(strict_types=1);
session_start();

require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/user.class.php');

$dbh = get_database_connection();

if(!$dbh) {
    die('Failed to establish database connection');
}

$userId = $_SESSION['user_id'];

$user = User::getUserById($dbh, $userId);

if(isset($_POST['username'])) {
    if($_POST['old_username'] !== $user->username()) die('Incorrect current username');

    if($_POST['username'] !== $_POST['confirm_username']) die('Usernames do not match');

    $new_user = new User($userId, $_POST['username'], $user->email(), $user->password_hash());

    $new_user->saveUpdate($dbh, "username");
}else if(isset($_POST['email'])) {
    if($_POST['old_email'] !== $user->email()) die('Incorrect current email');

    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die('Invalid email');

    if($_POST['email'] !== $_POST['confirm_email']) die('Emails do not match');

    $stmt = $dbh->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$_POST['email']]);
    if ($stmt->fetch()) {
        die('Email is already taken');
    }

    $new_user = new User($userId, $user->username(), $_POST['email'], $user->password_hash());

    $new_user->saveUpdate($dbh, "email");
}else if(isset($_POST['password'])) {
    if(password_verify($_POST['password'], $user->password_hash())) die('Incorrect current password');

    if(strlen($_POST['password']) < 8) die('Password must be at least 8 characters long');

    if(!preg_match('/[a-z]/', $_POST['password'])) die('Password must contain at least one lowercase letter');

    if(!preg_match('/[A-Z]/', $_POST['password'])) die('Password must contain at least one uppercase letter');

    if(!preg_match('/[0-9]/', $_POST['password'])) die('Password must contain at least one number');

    if($_POST['password'] !== $_POST['confirm_password']) die('Passwords do not match');

    $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $new_user = new User($userId, $user->username(), $user->email(), $password_hash);

    $new_user->saveUpdate($dbh, "password");
}else{
    die('Invalid request');
}

header("Location: /pages/profile.php");