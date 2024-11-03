<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['remove_from_cart'])) {
    $product_name = $_POST['product_name'];
    if (isset($_SESSION['cart'][$product_name])) {
        unset($_SESSION['cart'][$product_name]);
    }
}

if (isset($_POST['update_quantity'])) {
    $product_name = $_POST['product_name'];
    $new_quantity = intval($_POST['quantity']);
    if (isset($_SESSION['cart'][$product_name]) && $new_quantity > 0) {
        $_SESSION['cart'][$product_name]['quantity'] = $new_quantity;
    }
}

echo "<h2>Shopping Cart</h2>";
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $name => $details) {
        echo "$name - $" . number_format($details['price'], 2) . " (Quantity: " . $details['quantity'] . ")";

        echo '<form method="post" action="shopping.php" style="display:inline;">
                <input type="hidden" name="product_name" value="'.$name.'">
                <input type="number" name="quantity" value="'.$details['quantity'].'" min="1">
                <button type="submit" name="update_quantity">Update Quantity</button>
              </form>';


        echo '<form method="post" action="shopping.php" style="display:inline;">
                <input type="hidden" name="product_name" value="'.$name.'">
                <button type="submit" name="remove_from_cart">Remove from Cart</button>
              </form>';
        echo "<br>";
    }

    $total = 0;
    foreach ($_SESSION['cart'] as $details) {
        $total += $details['price'] * $details['quantity'];
    }
    echo "<br>";
    echo "<strong>Total Price: $" . number_format($total, 2) . "</strong>";
} else {
    echo "<h2>Your Cart is empty.</h2>";
}
?>
