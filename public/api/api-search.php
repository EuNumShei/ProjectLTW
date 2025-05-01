<?php
  declare(strict_types = 1);

  session_start();

  require_once(__DIR__ . '/../../private/database/connect.db.php');
  require_once(__DIR__ . '/../../private/database/model.class.php');

  $dbh = get_database_connection();

  $searchvalue = $_GET['search'];

  echo json_encode($searchvalue);