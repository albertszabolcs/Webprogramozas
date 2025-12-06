<?php

interface Discountable {
    public function applyDiscount(float $percentage): void;
    public function getDiscountedPrice():float;

}
