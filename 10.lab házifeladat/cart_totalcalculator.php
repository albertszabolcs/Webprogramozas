<?php

function fetchApiData($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

function calculateCartTotal($userId) {
    // Lekérjük a felhasználó kosarait
    $cartsUrl = "https://fakestoreapi.com/carts/user/$userId";
    $carts = fetchApiData($cartsUrl);

    // Lekérjük az összes terméket az árakhoz
    $productsUrl = "https://fakestoreapi.com/products";
    $products = fetchApiData($productsUrl);

    // Az árakat egy könnyen elérhető struktúrába helyezzük (productId -> price)
    $productPrices = [];
    foreach ($products as $product) {
        $productPrices[$product['id']] = $product['price'];
    }

    $total = 0;
    // Iterálunk a kosarakon és számolunk
    foreach ($carts as $cart) {
        foreach ($cart['products'] as $product) {
            $productId = $product['productId'];
            $quantity = $product['quantity'];

            if (isset($productPrices[$productId])) {
                $total += $productPrices[$productId] * $quantity;
            }
        }
    }

    return $total;
}

// Példa használat: számoljuk ki az 1-es user kosarainak összértékét
$userId = 1;
$total = calculateCartTotal($userId);
echo "Az $userId felhasználó kosarainak összértéke: $" . number_format($total, 2);
?>
