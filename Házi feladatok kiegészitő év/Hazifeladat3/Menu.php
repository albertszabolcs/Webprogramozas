<?php

class Menu {
    private array $items = [];

    public function addItem(MenuItem $item): void {
        $this->items[] = $item;
    }
    public function getItemById(int $id): ?MenuItem {

        foreach ($this->items as $item) {
            if($item->getId() === $id) {
                return $item;
            }
        }
        return null;
    }
    public function getItemsByCategory(string $category): array {

        $filtered = [];

        foreach($this->items as $item) {
            if($item instanceof Food && $item->getCategory() === $category) {
                $filtered[] = $item;
            }
        }
        return $filtered;
    }
    public function getBeverages(): array {
        $beverages = [];
        foreach($this->items as $item) {
            if($item instanceof Beverage) {
                $beverages[] = $item;
            }
        }
        return $beverages;
    }
    public function searchItems(string $keyword): array {
        $results = [];

        foreach($this->items as $item) {
            if(stripos($item->getName(),$keyword)!== false || stripos($item->getDescription(), $keyword)!==false) {
                $results[] = $item;
            }
        }
        return $results;
    }
    public function sortByPrice(string $order = 'asc'): array {
        $sortedItems = $this->items;

        usort($sortedItems, function (MenuItem $a, MenuItem $b) use ($order) {
            if($a->getPrice() == $b->getPrice()){
                return 0;
                }
            if ($order === 'asc') {
                return ($a->getPrice() < $b->getPrice()) ? -1 : 1;
            } else {
                return ($a->getPrice() > $b->getPrice()) ? -1 : 1;
            }
        });
        return $sortedItems;
    }
    public function getItems(): array {
        return $this->items;
    }
}
?>
