<?php 
require_once __DIR__.'/../vendor/autoload.php';

use app\Router;
use app\controllers\ProductController;

$router = new Router();

// $router->get('/', [ProductController::class, 'index']);
$router->get('/', [new ProductController(), 'index']); // to this

// $router->get('/products', [ProductController::class, 'index']);
$router->get('/products', [new productController(), 'index']); // to this

// $router->get('/products/index', [ProductController::class, 'index']);
$router->get('/products/index', [new ProductController(), 'index']); // to this

// $router->get('/products/create', [ProductController::class, 'create']);
$router->get('/products/create', [new ProductController(), 'create']); // to this

// $router->post('/products/create', [ProductController::class, 'create']);
$router->post('/products/create', [new ProductController(), 'create']); // to this

// $router->get('/products/update', [ProductController::class, 'update']);
$router->get('/products/update', [new ProductController(), 'update']); // to this

// $router->post('/products/update', [ProductController::class, 'update']);
$router->post('/products/update', [new ProductController(), 'update']);

// $router->post('/products/delete', [ProductController::class, 'delete']);
$router->post('/products/delete', [new ProductController(), 'delete']);


$router->resolve();
