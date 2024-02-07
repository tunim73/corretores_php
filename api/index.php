<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/2.0/');
$dotenv->load();

$route = new App\Core\Routes();

$route->add('GET', '/users', 'CorretorController::index', "00");
$route->add('GET', '/user/edit/[param]', 'CorretorController::edit', "00");

$route->add('POST', '/user', 'CorretorController::store', "00");
$route->add('POST', '/user/update', 'CorretorController::update', "00");
$route->add('GET', '/user/delete/[param]', 'CorretorController::destroy', "00");

$route->go();
