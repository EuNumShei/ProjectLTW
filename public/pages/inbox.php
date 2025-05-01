<?php

declare(strict_types=1);

session_start();
require_once(__DIR__ . '/../../private/database/user.class.php');
require_once(__DIR__ . '/../../private/database/msgs.class.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/inbox.tpl.php');

$dbh = get_database_connection();

if(isset($_SESSION['user_id'])) {
    $user = User::getUserById($dbh, $_SESSION['user_id']);

    $contacted_users = Msg::getContactedUsers($dbh, $user->id);
    foreach ($contacted_users as $key => $contacted_user) {
        $contacted_users[$key] = User::getUserById($dbh, $contacted_user);
    }

    drawLogOutHeader('Inbox');
    drawContacts($contacted_users);

    if (isset($_GET['receiver'])); {
        $receiver = User::getUserById($dbh, (int)$_GET['receiver']);

        if ($receiver->id === null) {
            echo '<section class="chat"><p>No messages found.</p></section>';
        } else {
            $chat = Msg::getChat($dbh, $user->id, $receiver->id);

            if (!empty($chat)) {
                drawChat($chat, $user, $receiver);
            } else {
                echo '<section class="chat"><p>No messages found.</p></section>';
            }
        }
    }
}
else {
        header('Location: login.php');
        exit();
}

drawFooter();

?>