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
    $eventModel = new EventsModel($database);

    #load the controllers
    $eventController = new EventsController($eventModel);

    #load the routes
    $eventController->processRequest($_SERVER['REQUEST_METHOD'], $id);
    exit;
}

if($resource === 'categories') {
    #load the models
    $categoryModel = new CategoriesModel($database);

    #load the controllers
    $categoryController = new CategoriesController($categoryModel);

    #load the routes
    $categoryController->processRequest($_SERVER['REQUEST_METHOD'], $id);
    exit;
}

