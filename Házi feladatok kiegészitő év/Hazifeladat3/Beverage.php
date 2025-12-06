<?php

class Beverage extends MenuItem implements Orderable {
    private string $size;
    private bool $isAlcoholic;

    public function __construct(int $id,string $name, string $description,float $basePrice,string $size,bool $isAlcoholic) {
        parent::__construct($id,$name,$description,$basePrice);
        $this->size = $size;
        $this->isAlcoholic = $isAlcoholic;
    }

    public function getPrice(): float
    {
        $price = $this->basePrice;

        switch($this->size) {
            case "medium":
                $price *= 1.3;
                break;
            case "large":
                $price *= 1.5;
                break;
        }
        return $price;

    }

    public function getOrderInfo(): string
    {
        return "{$this->name} ({$this->size}) - {$this->description} ({$this->getPrice()} Ft)";
    }
    public function getSize(): string {
        return $this->size;

    }
    public function isAlcoholic(): bool {
        return $this->isAlcoholic;

    }
}
?>
