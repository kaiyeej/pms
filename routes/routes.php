<?php

$request = $_SERVER['REQUEST_URI'];

/** SET ROUTES HERE */
// insert routes alphabetically
$routes = array(
    "homepage" => array(
        'class_name' => 'Homepage',
        'has_detail' => 0
    ),
    "clients" => array(
        'class_name' => 'Clients',
        'has_detail' => 0
    ),
    "roles" => array(
        'class_name' => 'Roles',
        'has_detail' => 0
    ),
    "users" => array(
        'class_name' => 'Users',
        'has_detail' => 0
    ),
    "projects" => array(
        'class_name' => 'Projects',
        'has_detail' => 1
    ),
    "quotations" => array(
        'class_name' => 'Quotations',
        'has_detail' => 1
    ),
    "payment" => array(
        'class_name' => 'Payment',
        'has_detail' => 0
    ),
    "distributions" => array(
        'class_name' => 'Distributions',
        'has_detail' => 0
    ),
    "expense-category" => array(
        'class_name' => 'ExpenseCategory',
        'has_detail' => 0
    ),
    "expenses" => array(
        'class_name' => 'Expenses',
        'has_detail' => 0
    ),
    "project-materials" => array(
        'class_name' => 'ProjectMaterials',
        'has_detail' => 0
    ),
    "suppliers" => array(
        'class_name' => 'Suppliers',
        'has_detail' => 0
    ),
    "notes" => array(
        'class_name' => 'Notes',
        'has_detail' => 0
    ),
);
/** END SET ROUTES */


$base_folder = "pages/";
$page = str_replace("/pms/", "", $request);

// chec if has parameters
if (substr_count($page, "?") > 0) {
    $url_params = explode("?", $page);
    $dir = $base_folder . $url_params[0] . '/index.php';
    //$param = $url_params[1];
    $page = $url_params[0];
} else {

    if ($page == "" || $page == null) {
        $page = "homepage";
    }
    $dir = $base_folder . $page . '/index.php';
}

if (array_key_exists($page, $routes)) {
    require_once $dir;
    $route_settings = json_encode($routes[$page]);
} else {
    require_once '404.php';
    $route_settings = json_encode([]);
}
