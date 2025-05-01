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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $incoming_category_data = json_decode(file_get_contents('php://input'), true);
    if(isset($incoming_category_data)) {
        $new_categories = $incoming_category_data['category'];
        $new_colors = $incoming_category_data['color'];
        $new_storages = $incoming_category_data['storage'];
        $new_conditions = $incoming_category_data['condition'];
        $new_brands = $incoming_category_data['brand'];
        $new_models = $incoming_category_data['model'];
        $new_cameras = $incoming_category_data['camera'];
        $new_cpus = $incoming_category_data['cpu'];
        $new_memorys = $incoming_category_data['memory'];
        $new_batterys = $incoming_category_data['battery'];

    $fields = [
        'category' => Phone::getCategoriesPhone($dbh),
        'color' => Phone::getColorsPhone($dbh),
        'storage' => Phone::getStoragesPhone($dbh),
        'condition' => Phone::getConditionsPhone($dbh),
        'brand' => Phone::getBrandsPhone($dbh),
        'model' => Phone::getModelsPhone($dbh),
        'camera' => Phone::getCameraPhone($dbh),
        'cpu' => Phone::getCPUPhone($dbh),
        'memory' => Phone::getMemoryPhone($dbh),
        'battery' => Phone::getBatteryPhone($dbh),
    ];

    $new_fields = [
        'category' => $new_categories,
        'color' => $new_colors,
        'storage' => $new_storages,
        'condition' => $new_conditions,
        'brand' => $new_brands,
        'model' => $new_models,
        'camera' => $new_cameras,
        'cpu' => $new_cpus,
        'memory' => $new_memorys,
        'battery' => $new_batterys,
    ];

    foreach ($fields as $key => $old_values) {
        $new_values = $new_fields[$key];
        $updateMethod = 'update' . ucfirst($key);
    
        for ($i = 0; $i < count($new_values); $i++) {
            if ($old_values[$i] !== $new_values[$i]) {
                Phone::$updateMethod($dbh, $old_values[$i], $new_values[$i]);
            }
        }
    }
    }

    exit();
}