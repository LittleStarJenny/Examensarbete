<?php
$title = '';
include_once 'resources/include.php';


$request = $_SERVER['REQUEST_URI'];
// include_once 'header.php';

$route = new Router($request);

if(strpos($request,  'login-admin') | strpos($request,  'start') | strpos($request,  'kunder') | strpos($request,  'skapa-admin') | strpos($request,  'skapa-produkt') | strpos($request,  'orders') !== false) {
    include_once 'admin/adminheader.php';
} else {
    include_once 'header.php';
}

$route->get('', '/start');

$route->get('products', '/shop/products');

$route->get('checkout', '/shop/checkout');

$route->get('orderconfirmation', '/shop/orderconfirmation');

$route->get('category' , '/shop/category-page');

$route->get('tillverknings-policy', 'tillverknings-policy.php');

// Customer pages

$route->get('customerstart', '/customerpages/customerstart');

$route->get('yourorders', '/customerpages/customerorders');

$route->get('update', '/customerpages/customerupdate');

$route->get('login', '/customerpages/customerlogin');

$route->get('logout', '/logout');

// Admin pages

$route->get('login-admin', '/admin/adminlogin');

$route->get('start', '/admin/adminpanel');

$route->get('kunder', '/admin/changecustomerinfo');

$route->get('skapa-admin', '/admin/createadmin');

$route->get('skapa-produkt', '/admin/createproduct');

$route->get('orders', '/admin/orders');


include_once 'footer.php';

?>
