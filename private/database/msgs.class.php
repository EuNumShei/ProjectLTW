<?php

declare(strict_types=1);
require_once(__DIR__ . '/connect.db.php');
require_once(__DIR__ . '/users.db.php');

class Msg {
    public int $id;
    public int $sender;
    public int $receiver;
    public string $content;
    public string $send_time;

    public function __construct(int $id, int $sender, int $receiver, string $content, string $send_time) {
        $this->id = $id;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->content = $content;
        $this->send_time = $send_time;
    }

    static function getContactedUsers(PDO $dbh, int $sender): array {
        $stmt = $dbh->prepare('SELECT DISTINCT receiver FROM msgs WHERE sender = ?');
        $stmt->execute(array($sender));

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    static function getChat(PDO $dbh, int $sender, int $receiver): array {
        $stmt = $dbh->prepare('SELECT * FROM msgs WHERE (sender = ? AND receiver = ?) OR (sender = ? AND receiver = ?) ORDER BY send_time ASC');
        $stmt->execute(array($sender, $receiver, $receiver, $sender));

        return $stmt->fetchAll();
    }

    static function chatExists(Chat $chat) {
        return $chat->id !== null;
    }

    static function sendMsg(PDO $dbh, int $sender, int $receiver, string $content): void {
        $stmt = $dbh->prepare('INSERT INTO msgs (sender, receiver, content) VALUES (?, ?, ?)');
        $stmt->execute(array($sender, $receiver, $content));
    }
}