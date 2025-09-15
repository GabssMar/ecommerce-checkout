<?php

require_once './class/Product.php';
require_once './class/Checkout.php';


echo "<h3>Caso 1 - Usuário adiciona um produto válido</h3>";
$product1 = new Product(1, 'iPhone 15', 4599.99, 20);
echo "Estoque do produto: " . $product1->getStock();
$checkout = new Checkout([], 0, 0.0);
$checkout->addToCart($product1, 2);
echo "<br>";
foreach($checkout->listProducts() as $item) {
    echo "Nome: " . $item['Nome'] . " - Preço: " . $item['Preço'] . "<br>";
}
echo "<br>";
echo "Total do Carrinho: R$ " . $checkout->getTotalCart();
echo "<br>";
echo "Estoque do produto: " . $product1->getStock();


echo "<h3>Caso 2 - Usuário adiciona um produto além do estoque</h3>";
$product2 = new Product(2, 'iPhone 16', 5599.99, 5);
echo "Estoque do produto: " . $product2->getStock();
$checkout2 = new Checkout([], 0, 0.0);
echo "<br>";
$checkout2->addToCart($product2, 10);


echo "<h3>Caso 3 - Usuário remove um produto do carrinho</h3>";
$checkout3 = new Checkout([], 0, 0.0);
$checkout3->addToCart($product1, 1);
$checkout3->addToCart($product2, 1);
echo "<br>";
echo "Antes de remover o produto do carrinho";
echo "<br>";
foreach($checkout3->listProducts() as $item) {
    echo "Nome: " . $item['Nome'] . " - Preço: " . $item['Preço'] . "<br>";
}
echo "Estoque do produto: " . $product2->getStock();
echo "<br>";
echo "Total do Carrinho: R$ " . $checkout3->getTotalCart();
echo "<br>";
$checkout3->removeFromCart($product2, 1);
echo "<br>";
echo "Depois de remover o produto do carrinho";
echo "<br>";
foreach($checkout3->listProducts() as $item) {
    echo "Nome: " . $item['Nome'] . " - Preço: " . $item['Preço'] . "<br>";
}
echo "Estoque do produto: " . $product2->getStock();
echo "<br>";
echo "Total do Carrinho: R$ " . $checkout3->getTotalCart();
echo "<br>";

echo "<h3>Caso 4 - Usuário adiciona um cupom de desconto</h3>";
$checkout4 = new Checkout([], 0, 0.0);
$checkout4->addToCart($product1, 1);
$checkout4->addToCart($product2, 1);
echo "<br>";
foreach($checkout4->listProducts() as $item) {
    echo "Nome: " . $item['Nome'] . " - Preço: " . $item['Preço'] . "<br>";
}
echo "<b>Total do Carrinho antes do desconto:</b> R$ " . $checkout4->getTotalCart();
echo "<br>";
echo "<b>Total do Carrinho com desconto:</b> R$ " . round($checkout4->addDiscount('DESCONTO10'), 2);
echo "<br>";
foreach($checkout4->listProducts() as $item) {
    echo "Nome: " . $item['Nome'] . " - Preço: " . $item['Preço'] . "<br>";
}

?>