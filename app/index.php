<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once './class/Product.php';
require_once './class/Checkout.php';

$product1 = new Product(1, 'IPhone 15', 4599.99, 20);
$product2 = new Product(2, 'IPhone 16', 5599.99, 10);

$checkout = new Checkout([], 0, 0.0);

$checkout->addToCart($product1, 2); 
$checkout->addToCart($product2, 3); 

echo "Subtotal: R$ " . $checkout->getSubtotal();

echo "<br>";

$checkout->listProducts();


?>