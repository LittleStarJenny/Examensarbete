<?php
include_once 'header.php';
include 'router.php';

$request = $_SERVER['REQUEST_URI'];

$route = new Router($request);

$route->get('', 'start');

$route->get('products', 'products');

$route->get('cart', 'cart');

$route->get('checkout', 'checkout');


include_once 'footer.php';
 ini_set('display_errors', 1); error_reporting(E_ALL); 

 ?>
