<?php

define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';
App::load();

if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'home.index';
}

$page = explode('.', $page);
if ($page[0] === 'admin') {
    $controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
    $action = $page[2];
    $id = isset($page[3]) ? $page[3] : null;
} else {
    $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
    $action = $page[1];
    $id = isset($page[2]) ? $page[2] : null;
    $paging = isset($page[3]) ? $page[3] : null;
}
$controller = new $controller;
if (isset($id) && isset($paging)) {
    return $controller->$action($id, $paging);
}
return isset($id) ? $controller->$action($id) : $controller->$action();
