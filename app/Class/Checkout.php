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

            $this->reduceStock($product, $quantity);
            $this->updateSubTotal();
        } else {
            echo "Estoque insuficiente para o produto {$product->getName()}";
        }
    }

    public function removeFromCart(Product $product, int $quantity): void
    {
        foreach ($this->products as $key => $item) {
            if ($item['product']->getId() === $product->getId()) {
                if ($quantity >= $item['quantity']) {
                    $quantityToReturn = $item['quantity'];
                    unset($this->products[$key]);
                } else {
                    $item['quantity'] -= $quantity;
                    $quantityToReturn = $quantity;
                }
                $this->increaseStock($item['product'], $quantityToReturn);
                $this->updateSubTotal();
                return;
            }
        }
        echo "Produto não encontrado no carrinho";
    }

    public function updateSubTotal(): void
    {
        $this->subtotal = 0;
        foreach ($this->products as $item) {
            $this->subtotal += $item['product']->getPrice() * $item['quantity'];
        }
    }

    public function reduceStock($product, $quantity): void
    {
        $product->setStock($product->getStock()-$quantity);
    }

    public function increaseStock($product, $quantity): void
    {
        $product->setStock($product->getStock()+$quantity);
    }

    public function listProducts(): array
    {
        if (empty($this->products)) 
        {
            return [];
        }

        $items = [];

        foreach ($this->products as $item)
        {
            $product = $item['product'];
            $quantity = $item['quantity'];

            $items[] = [
                "Nome" => $product->getName(),
                "Preço" => $product->getPrice(),
                "Quantidade" => $quantity,
                "Subtotal" => $product->getPrice() * $quantity
            ];
            
        }
        return $items;
    }

    public function getTotalCart() : float
    {
        $totalCart = 0;
        foreach($this->products as $item) {
            $totalCart += $item['product']->getPrice() * $item['quantity'];
        }
        return $totalCart;
    }

    public function addDiscount(string $cupon): float {
        $totalCart = $this->getTotalCart();
        if ($cupon === 'DESCONTO10') {
            $totalCart -= $totalCart * 0.1;
            $this->subtotal = $totalCart;
        }
        return $totalCart;
    }
}
