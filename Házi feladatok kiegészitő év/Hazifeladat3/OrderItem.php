<?php

class OrderItem {
    private MenuItem $menuItem;
    private int $quantity;

    public function __construct(MenuItem $menuItem, int $quantity)
    {
        if ($quantity <= 0) {
            throw new Exception("Quantity must be positive");
        }

        $this->menuItem = $menuItem;
        $this->quantity = $quantity;
    }
    public function getItemTotal():float {
        return $this->menuItem->getPrice() * $this->quantity;
    }
    public function getMenuItem(): MenuItem {
        return $this->menuItem;
    }
    public function getQuantity():int {
        return $this->quantity;
    }
}
?>
