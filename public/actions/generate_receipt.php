<?php
require_once(__DIR__ . '/../templates/profile.tpl.php');

$buyer = $_POST['buyer'];
$seller = $_POST['seller'];
$phone = $_POST['phone'];
$price = intval($_POST['price']);

ob_start();
drawReceipt($buyer, $seller, $phone, $price);
$receipt = ob_get_clean();

echo $receipt;