<?php
declare(strict_types=1);
session_start();

$error = true;

if(empty($_POST['username'])) {
    $_SESSION['error'] = 'Username is required';
    $error = false;
}

if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    if($error) {
        $_SESSION['error'] = 'Invalid email';
        $error = false;
    }
}

if(strlen($_POST['password']) < 8) {
    if($error) {
        $_SESSION['error'] = 'Password must be at least 8 characters long';
        $error = false;
    };
}

if(!preg_match('/[a-z]/', $_POST['password'])) {
    if($error) {
        $_SESSION['error'] = 'Password must contain at least one lowercase letter';
        $error = false;
    }
}

if(!preg_match('/[A-Z]/', $_POST['password'])) {
    if($error) {
        $_SESSION['error'] = 'Password must contain at least one uppercase letter';
        $error = false;
    }
}

if(!preg_match('/[0-9]/', $_POST['password'])) {
    if($error) {
        $_SESSION['error'] = 'Password must contain at least one number';
        $error = false;
    }
}

if($_POST['password'] !== $_POST['confirm_password']) {
    if($error) {
        $_SESSION['error'] = 'Passwords do not match';
        $error = false;
    }
}

$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/user.class.php');

$dbh = get_database_connection();

if(!$dbh) {
    die('Failed to establish database connection');
}

$user = new User(null, $_POST['username'], $_POST['email'], $password_hash);

if(!$error) {
    header("Location: /pages/signup.php");
    exit();
}else{
    $user->saveInsert($dbh);
}