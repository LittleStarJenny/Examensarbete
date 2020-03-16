<?php
$title = '';
// include 'router.php';

$request = $_SERVER['REQUEST_URI'];
include_once 'header.php';

$route = new Router($request);

// var_dump($route);

$route->get('', '/start');

$route->get('products', '/shop/products');

// $route->get('cart', '/cart');

$route->get('checkout', '/shop/checkout');

$route->get('orderconfirmation', '/shop/orderconfirmation');

$route->get('category' , '/shop/category-page');

$route->get('update/', '/customerpages/customerupdate');

$route->get('login', '/customerpages/customerlogin');

$route->get('logout', '/logout');

$route->get('customerstart', '/customerpages/customerstart');

$route->get('yourorders', '/customerpages/customerorders');

$route->get('tillverknings-policy', 'tillverknings-policy.php');


include_once 'footer.php';

?>
