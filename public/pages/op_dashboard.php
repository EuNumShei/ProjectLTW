<?php

declare(strict_types=1);

session_start();
require_once(__DIR__ . '/../../private/database/user.class.php');
require_once(__DIR__ . '/../../private/database/connect.db.php');
require_once(__DIR__ . '/../../private/database/phone.class.php');
require_once(__DIR__ . '/../../private/database/cart.class.php');
require_once(__DIR__ . '/../templates/phones.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/op_dashboard.tpl.php');

$dbh = get_database_connection();

if(isset($_SESSION['user_id'])):
    $user = User::getUserById($dbh, $_SESSION['user_id']);

    if ($user->op() != 1) {
        displayErrorMessage();
        die("Access denied.");
    }

    $phones = Phone::get_all_phones($dbh);
    $users = User::get_all_users($dbh);

    $categories = Phone::getCategoriesPhone($dbh);
    $colors = Phone::getColorsPhone($dbh);  
    $storages = Phone::getStoragesPhone($dbh);
    $conditions = Phone::getConditionsPhone($dbh);
    $brands = Phone::getBrandsPhone($dbh);
    $models = Phone::getModelsPhone($dbh);
    $cameras = Phone::getCameraPhone($dbh);
    $cpus = Phone::getCPUPhone($dbh);
    $sizes = Phone::getSizePhone($dbh);
    $memories = Phone::getMemoryPhone($dbh);
    $batteries = Phone::getBatteryPhone($dbh);

    $fields = [
        'category' => $categories,
        'color' => $colors,
        'storage' => $storages,
        'condition' => $conditions,
        'brand' => $brands,
        'model' => $models,
        'camera' => $cameras,
        'cpu' => $cpus,
        'memory' => $memories,
        'battery' => $batteries,
    ];
    
    drawLogOutHeader('Operator Dashboard');
    drawIndex();

    if(isset($_GET['option'])):
        switch($_GET['option']):
            case 'inventory':
                if (isset($_GET['id'])) {
                    $phone = Phone::get_phone_by_id($dbh, (int)$_GET['id']);

                    drawEditItem($phone, $fields);
                }
                drawInventory($users, $phones);
                break;
            case 'users':
                drawUsers($users);
                break;
            case 'categories':
                drawCategories($fields);
                break;
            case 'orders':
                $orders = Cart::get_all_carts($dbh);
                drawOrdersHeader();
                foreach ($orders as $order) {
                    $cart_products = Cart::getCartPhones($dbh, $order['id']);
                    $cart_prices = Cart::getCartPrices($dbh, $order['id']);
                    $cart_timestamp = Cart::getCartTimestamp($dbh, $order['id']);
                    drawOrder($dbh, $order, $cart_products, $cart_prices, $cart_timestamp);
                }
                drawOrdersFooter();
                break;
            default:
                break;
        endswitch;
    else:
        drawInventory($users, $phones);
    endif;

    drawFooter();
else:
    die("Access denied.");
endif;