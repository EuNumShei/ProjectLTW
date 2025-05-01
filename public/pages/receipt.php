<?php
declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../../private/database/connect.db.php');

$dbh = get_database_connection();

