<?php
error_reporting(-1);
ini_set('display_errors', 'On');
require __DIR__ . '/vendor/autoload.php';

use App\Controllers\RedisController;
use Minicli\Route;

$route = new Route();
$route->run();


