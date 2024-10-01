<?php
$masodpercek = 3660;


if (is_int($masodpercek)) {

    $orak = (int)($masodpercek / 3600);
    $maradekMasodpercek =$masodpercek % 3600;
    $percek =(int)($maradekMasodpercek / 60);
    $masodpercek = $maradekMasodpercek % 60;

    echo "<p>Az idő: <strong>$orak</strong> óra, <strong>$percek</strong> perc és <strong>$masodpercek</strong> másodperc.</p>";
} else {
    echo "<p><strong>Hiba:</strong> Kérjük, adjon meg egy egész számot másodpercként!</p>";
}
?>
