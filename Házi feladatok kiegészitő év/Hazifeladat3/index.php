<?php

include "MenuItem.php";
include "Menu.php";
include "Food.php";
include "Beverage.php";
include "Order.php";
include "OrderItem.php";

$menu = new Menu();
$menu->addItem(new Food(1, "Margherita Pizza", "Hagyományos pizza sajttal", 2000, "Pizza"));
$menu->addItem(new Food(2, "Pepperoni Pizza", "Csípős pepperonis pizza", 2500, "Pizza"));
$menu->addItem(new Food(3, "Sajtos Hamburger", "Szaftos marhahúsos hamburger sajttal", 1500, "Burger"));
$menu->addItem(new Food(4, "Spagetti Carbonara", "Krémes tészta baconnel", 1800, "Pasta"));
$menu->addItem(new Food(5, "Caesar Saláta", "Friss saláta csirkével és krutonokkal", 1200, "Salad"));

$menu->addItem(new Beverage(101,"Coca-cola","Frissitő üditőital",500,"kicsi",false));
$menu->addItem(new Beverage(102,"Pepsi","Szénsavas üditőital",600,"közepes",false));
$menu->addItem(new Beverage(103,"Sör","Helyi kézműves sör",800,"nagy",true));
$menu->addItem(new Beverage(104,"Bor","Vörösbor",1200,"közepes",true));

$margherita = $menu->getItemById(1);
if ($margherita instanceof Discountable) {
    $margherita->applyDiscount(20);

    echo $margherita->getName() . "eredeti ára: " . $margherita->getDiscountedPrice() / (1 - 0.2) . " Ft\n";
    echo $margherita->getName() . "kedvezményes ára: " . $margherita->getPrice() . " Ft\n";

    $order = new Order();
    $order->addItem($menu->getItemById(1), 2);
    $order->addItem($menu->getItemById(3), 1);
    $order->addItem($menu->getItemById(101), 3);

    foreach ($order->getItems() as $orderItem) {
        $menuItem = $orderItem->getMenuItem();
        echo $menuItem->getOrderInfo() . " x " . $orderItem->getQuantity() . "\n";
    }
    echo "Összes ár: " . $order->getTotalPrice() . " Ft\n";

    try {
        $order->addItem($menu->getItemById(2), -1);
    } catch (Exception $e) {
        echo "Hiba történt: " . $e->getMessage() . "\n";
    }
    $pizzas = $menu->getItemsByCategory("Pizza");

    echo "Pizzák a menüben \n";
    foreach ($pizzas as $pizza) {
        echo $pizza->getOrderInfo(). "\n";
    }
    $beverages = $menu->getBeverages();

    echo "Italok a menüben \n";
    foreach($beverages as $beverage) {
        echo $beverage->getOrderInfo(). "\n";
    }

    $keyword = "pizza";
    $results = $menu->searchItems($keyword);
    echo "Keresés a menüben: '$keyword' \n";
    if(empty($results)) {
        foreach($results as $item) {
            echo $item->getOrderInfo(). "\n";
        }

    } else {
        echo "Nincs találat a '$keyword' kulcsszóra. \n";
    }

    // Rendezés ár szerint növekvő sorrendben
    $sorted = $menu->sortByPrice('asc');
    echo "Ételek ár szerint növekvő sorrendben \n";
    foreach($sorted as $item) {
        echo $item->getOrderInfo() . "\n";
    }

    // Rendezés ár szerint csökkenő sorrendben
    $sorted = $menu->sortByPrice('desc');
    echo "Ételek ár szerint csökkenő sorrendben \n";
    foreach($sorted as $item) {
        echo $item->getOrderInfo(). "\n";
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Ételrendelő </title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h2>Teljes Menü</h2>
<table>
    <tr>
        <th>Név</th>
        <th>Leírás</th>
        <th>Kategória / Méret</th>
        <th>Ár (Ft)</th>
    </tr>
    <?php foreach ($menu->getItems() as $item): ?>
        <tr>
            <td><?= $item->getName() ?></td>
            <td><?= $item->getDescription() ?></td>
            <td>
                <?php
                if ($item instanceof Food) {
                    echo $item->getCategory();
                } elseif ($item instanceof Beverage) {
                    echo ucfirst($item->getSize()) . ($item->isAlcoholic() ? " (Alkoholos)" : " (Alkoholmentes)");
                }
                ?>
            </td>
            <td><?= $item->getPrice() ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Rendelés tételek</h2>
<table>
    <tr>
        <th>Név</th>
        <th>Leírás</th>
        <th>Mennyiség</th>
        <th>Ár / db (Ft)</th>
        <th>Összesen (Ft)</th>
    </tr>
    <?php foreach ($order->getItems() as $orderItem): ?>
        <tr>
            <td><?= $orderItem->getMenuItem()->getName() ?></td>
            <td><?= $orderItem->getMenuItem()->getDescription() ?></td>
            <td><?= $orderItem->getQuantity() ?></td>
            <td><?= $orderItem->getMenuItem()->getPrice() ?></td>
            <td><?= $orderItem->getItemTotal() ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<p><strong>Összes rendelési ár: <?= $order->getTotalPrice() ?> Ft</strong></p>
</body>
</html>





