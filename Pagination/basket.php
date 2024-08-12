<?php
class Basket
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = [];
        }
    }

    public function addToBasket($product)
    {
        $basket = &$_SESSION['basket'];
        $productId = $product['id'];

        $existingItemIndex = array_search($productId, array_column($basket, 'id'));
        if ($existingItemIndex !== false) {
            $basket[$existingItemIndex]['quantity'] += 1;
        } else {
            $basket[] = [
                'id' => $productId,
                'name' => $product['title'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        }
    }

    public function getBasketContents()
    {
        return $_SESSION['basket'];
    }

    public function clearBasket()
    {
        $_SESSION['basket'] = [];
    }

    public function removeFromBasket($productId)
    {
        $basket = &$_SESSION['basket'];
        $basket = array_filter($basket, function ($item) use ($productId) {
            return $item['id'] !== $productId;
        });
        $_SESSION['basket'] = array_values($basket);
    }
}

$basket = new Basket();
$basketContents = $basket->getBasketContents();