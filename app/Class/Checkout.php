<?php

require_once 'Product.php';

class Checkout
{
    private array $products;
    private int $quantity;
    private float $subtotal;

    public function __construct(array $products, int $quantity, float $subtotal)
    {
        $this->products = [];
        $this->quantity = $quantity;
        $this->subtotal = $subtotal;
    }

    public function addToCart(Product $product, int $quantity): void
    {
        if ($product->getStock() >= $quantity)
        {
            $this->products[] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
    }

    public function calculateSubTotal($product, $quantity): float
    {
        $this->subtotal += $product->getPrice() * $quantity;
    }

    public function updateStock($product, $quantity): void
    {
        $product->setStock($product->getStock()-$quantity);
    }
}
