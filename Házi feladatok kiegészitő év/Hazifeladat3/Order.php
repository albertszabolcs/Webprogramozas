<?php

class Order
{
    private array $items = [];
    private string $orderNumber;
    private string $orderDate;

    public function __construct()
    {
        $this->orderNumber = uniqid("ORD-");
        $this->orderDate = date("Y-m-d H:i:s");
        $this->items = [];
    }

    public function addItem(MenuItem $item, int $quantity): void
    {
        $orderItem = new OrderItem($item, $quantity);
        $this->items[] = $orderItem;
    }
    public function removeItem(int $menuItemId): bool {

        foreach ($this->items as $index => $orderItem) {
            $menuItem = $orderItem->getMenuItem();

            if($menuItem->getId() === $menuItemId) {
                unset($this->items[$index]);
                $this->items = array_values($this->items);
                return true;
            }
        }
        return false;

    }
    public function getTotalPrice(): float {
        return array_reduce($this->items, function($sum,OrderItem  $orderItem) {
            return $sum + $orderItem->getItemTotal();
        },0);
    }
    public function getItemCount(): int {
        return count($this->items);
    }
    public function getItems(): array {
        return $this->items;
    }
    public function getOrderNumber(): string {

        return $this->orderNumber;
    }
    public function getOrderDate(): string {
        return $this->orderDate;
    }
}
?>
