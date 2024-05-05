<?php

use DI\ContainerBuilder;
use LesoWarehouseSystem\Controller\FrontendController;
use LesoWarehouseSystem\Model\Brand;
use LesoWarehouseSystem\Model\Warehouse;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

//$centralWareHouse = new Warehouse(
//    'Central warehouse',
//    'Budapest',
//    100
//);
//
//$centralWareHouse->


$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();
$frontendController = $container->get(FrontendController::class);

$frontendController->index();

print 'test';