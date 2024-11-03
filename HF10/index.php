<?php

session_start();

$products = [
    "Product A" => 10.99,
    "Product B" => 14.99,
    "Product C" => 19.99
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    if (array_key_exists($product_name, $products)) {
        if (isset($_SESSION['cart'][$product_name])) {
            $_SESSION['cart'][$product_name]['quantity']++;
        } else {
            $_SESSION['cart'][$product_name] = ['price' => $products[$product_name], 'quantity' => 1];
        }
    }
}

echo "<h2>Product List</h2>";
foreach ($products as $name => $price) {
    echo "<form method='post' action='index.php'>
            $name - $" . number_format($price, 2) . "
            <input type='hidden' name='product_name' value='$name'>
            <button type='submit' name='add_to_cart'>Add to Cart</button>
          </form>";
}

echo "<form method='get' action='shopping.php'>
        <button type='submit' name='view_cart'>View Cart</button>
      </form>";
?>
