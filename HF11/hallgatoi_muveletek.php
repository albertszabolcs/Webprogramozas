<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Nincs jogosultsága hozzáférni ehhez az oldalhoz. Kérem, jelentkezzen be!";
    exit;
}

echo "Üdvözöljük, " . $_SESSION['username'] . "! Itt végezhetők el a hallgatói műveletek.";
?>

<a href="hallgato_muvelet1.php">Hallgatói művelet 1</a><br>
<a href="hallgato_muvelet2.php">Hallgatói művelet 2</a><br>
<a href="logout.php">Kijelentkezés</a>
