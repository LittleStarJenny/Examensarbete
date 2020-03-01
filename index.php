<?php
 include_once 'header.php';
include 'router.php';

$request = $_SERVER['REQUEST_URI'];

$route = new Router($request);

var_dump($route);

$route->get('', '/start');

$route->get('products', '/products');

$route->get('cart', '/cart');

$route->get('checkout', '/checkout');

$route->get('orderconfirmation', '/orderconfirmation');

$route->get('category' , '/category-page');

// $route->get('product/', '/product-detail');

$route->get('login', '/customerlogin');

$route->get('logout', '/logout');

$route->get('customerstart', '/customerpages/customerstart');


include_once 'footer.php';
 ini_set('display_errors', 1); error_reporting(E_ALL); 

 ?>
