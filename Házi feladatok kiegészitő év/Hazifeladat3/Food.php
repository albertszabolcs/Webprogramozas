<?php

include "Discountable.php";
include "Orderable.php";

class Food extends MenuItem implements Orderable,Discountable {
    private string $category;
    private float $discount = 0;

    public function __construct(int $id, string $name, string $description, float $basePrice, string $category) {
        parent::__construct($id, $name, $description, $basePrice);
        $this->category = $category;

    }


    public function applyDiscount(float $percentage): void
    {
        if ($percentage < 0 || $percentage > 100) {
            throw new Exception ("A kedvezmény mértéke 0 és 100 közötti szám lehet!");

        }
        $this->discount = $percentage;
    }

    public function getDiscountedPrice(): float
    {
       return  $this->basePrice * (1 - $this->discount / 100);
    }

    public function getPrice(): float
    {
       if ($this->discount > 0) {
           return $this->getDiscountedPrice();
       }
       return $this->basePrice;
    }

    public function getOrderInfo(): string
    {
        return "{$this->name} - {$this->description} ({$this->getPrice()} Ft)";
    }
    public function getCategory() : string {
        return $this->category;
    }
}
?>
