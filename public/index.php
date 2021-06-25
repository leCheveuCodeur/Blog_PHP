<?php

use Core\Services\Globals\Globals;

define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';
App::load();
$globals = new Globals;

if (!empty($globals->getGET('p'))) {
    $page = $globals->getGET('p');
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

if (!class_exists($controller)) {
    return \header('Location: index.php');
}

$controller = new $controller;

if (isset($id) && isset($paging)) {
    return $controller->$action($id, $paging);
}
return isset($id) ? $controller->$action($id) : $controller->$action();
