<?php

session_start();

require_once(__DIR__ . '/../../private/database/user.class.php');
require_once(__DIR__ . '/../../private/database/msgs.class.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/inbox.tpl.php');

$dbh = get_database_connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $sender = $_SESSION['user_id'];
    $receiver = $_POST['receiver'];

    if (empty($content)) {
        echo "Please enter a message.";
        exit;
    }

    Msg::sendMsg($dbh, $sender, $receiver, $content);

    header('Location: ../pages/inbox.php?receiver=' . $receiver);

    exit();
}


?>