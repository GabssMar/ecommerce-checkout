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

            $this->addToSubTotal($product, $quantity);
            $this->updateStock($product, $quantity);
        } else {
            echo "Estoque insuficiente para o produto {$product->getName()}";
        }
    }

    public function addToSubTotal($product, $quantity): float
    {
        $this->subtotal += $product->getPrice() * $quantity;
        return $this->subtotal;
    }

    public function removeFromSubTotal($product, $quantity): float
    {
        $this->subtotal -= $product->getPrice() * $quantity;
        return $this->subtotal;
    }

    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    public function updateStock($product, $quantity): void
    {
        $product->setStock($product->getStock()-$quantity);
    }

    public function listProducts(): void
    {
        if (empty($this->products)) 
        {
            echo "O carrinho está vazio.";
            return;
        }

        foreach ($this->products as $item) 
        {
            $product = $item['product'];
            $quantity = $item['quantity'];
        }
    }

}
