<?php

use Core\Services\Globals\Globals;

define('ROOT', dirname(__DIR__));

require ROOT . '/app/App.php';
App::load();
$globals = new Globals;

$page = ($globals->getGET('p')) ?? 'home.index';

$page = explode('.', $page);
if ($page[0] === 'admin') {
    $controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
    $action = $page[2];
    $id = (!empty($page[3]) && ($page[2] !== 'index' && $page[2] !== 'add')) ? $page[3] : null;
} else {
    $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
    $action = $page[1];
    $id = $page[2] ?? null;
    $paging = $page[3] ?? null;
}

if (!class_exists($controller)) {
    return \header('Location: index.php');
}

$controller = new $controller;

try {
    if (!empty($id) && !empty($paging)) {
        return $controller->$action($id, $paging);
    }
    return !empty($id) ? $controller->$action($id) : $controller->$action();
} catch (ArgumentCountError  $e) {
    return \header('Location: index.php');
}
