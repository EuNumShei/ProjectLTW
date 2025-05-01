<?php

declare(strict_types=1);

session_start();

require_once(__DIR__ . '/../../private/database/phone.class.php');
require_once(__DIR__ . '/../templates/phones.tpl.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../../private/database/user.class.php');

$dbh = get_database_connection();
$phones = Phone::get_all_phones($dbh);
$categories = Phone::getCategoriesPhone($dbh);
$brands = Phone::getBrandsPhone($dbh);
$cameras = Phone::getCameraPhone($dbh);
$sizes = Phone::getSizePhone($dbh);
$memory = Phone::getMemoryPhone($dbh);
$cpu = Phone::getCPUPhone($dbh);
$battery = Phone::getBatteryPhone($dbh);
$colors = Phone::getColorsPhone($dbh);
$conditions = Phone::getConditionsPhone($dbh);
$storages = Phone::getStoragesPhone($dbh);

if(isset($_SESSION['user_id'])):
    drawLogOutHeader('Second Hand Smartphones');
    drawSideBar($brands, $cameras, $sizes, $memory, $cpu, $battery, $colors, $storages, $conditions, $categories);
    drawModels($phones);
else:
    drawHeader('Second Hand Smartphones');
    drawSideBar($brands, $cameras, $sizes, $memory, $cpu, $battery, $colors, $storages, $conditions, $categories);
    drawModels($phones);
endif;
drawFooter();