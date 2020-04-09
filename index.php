<?php
$title = '';
include_once 'resources/include.php';

$request = $_SERVER['REQUEST_URI'];

$route = new Router($request);

//Set different header if any of this url exist otherwise show regular header
if(strpos($request,  'login-admin') | strpos($request,  'home') | strpos($request,  'kunder') | strpos($request,  'skapa-admin') | strpos($request,  'skapa-produkt') | strpos($request,  'orders') !== false) {
    include_once 'admin/adminheader.php';
} else {
    include_once 'header.php';
}

// Shop pages 

$route->get('', '/start');

$route->get('products', '/shop/products');

$route->get('checkout', '/shop/checkout');

$route->get('orderconfirmation', '/shop/orderconfirmation');

$route->get('category' , '/shop/category-page');

$route->get('tillverknings-policy', '/shop/tillverknings-policy.php');

// Customer pages

$route->get('customerstart', '/customerpages/customerstart');

$route->get('yourorder', '/customerpages/customerorders');

$route->get('update', '/customerpages/customerupdate');

$route->get('login', '/customerpages/customerlogin');

$route->get('logout', '/customerpages/logout');

// Admin pages

$route->get('login-admin', '/admin/adminlogin');

$route->get('home', '/admin/adminpanel');

$route->get('kunder', '/admin/changecustomerinfo');

$route->get('skapa-admin', '/admin/createadmin');

$route->get('skapa-produkt', '/admin/createproduct');

$route->get('orders', '/admin/orders');


include_once 'footer.php';

?>
