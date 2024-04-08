<?php

declare(strict_types=1);

// Autoload classes
spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

// Set error and exception handler
set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");


// Load configuration
header('Content-Type: application/json; charset=utf-8');

// TODO: this should be including the correct origin of the fe on production
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");

// Load the API passed on uri path
$uri = $_SERVER['REQUEST_URI'];
$path = explode('/', $uri);

if($path[1] !== 'api') {
    echo json_encode(['error' => 'Invalid API path']);
    exit;
}

$resource = $path[2];
if(!in_array($resource, ['events', 'categories'])) {
    echo json_encode(['error' => 'Invalid API resource']);
    exit;
}

$id = $path[3] ?? null;

// TODO: load database secrets from environment variables
// Load the database
$database = new Database();

if($resource === 'events') {
    #load the models
    $eventRepo = new EventsRepository($database);

    #load the controllers
    $eventController = new EventsController($eventRepo);

    #load the routes
    $eventController->processRequest($_SERVER['REQUEST_METHOD'], $id);
    exit;
}

if($resource === 'categories') {
    #load the models
    $categoryRepo = new CategoriesRepository($database);

    #load the controllers
    $categoryController = new CategoriesController($categoryRepo);

    #load the routes
    $categoryController->processRequest($_SERVER['REQUEST_METHOD'], $id);
    exit;
}

