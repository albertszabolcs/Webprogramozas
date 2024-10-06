<?php
$szam1 = 5;
$szam2 = 3;

$osszeg = $szam1 + $szam2;
$kivonas = $szam1  - $szam2;
$szorzat = $szam1 * $szam2;
$osztas = ($szam1 != 0 ) ? ($szam1 / $szam2) : "A nullával való osztás nem megengedett.";
$hatvanyozas = $szam1 ** $szam2;

echo "A müveletek eredményei: .<br>";
echo "$szam1 + $szam2 = $osszeg.<br>";
echo "$szam1 - $szam2 = $kivonas.<br>";
echo "$szam1 * $szam2 = $szorzat.<br>";
echo "$szam1 / $szam2 = $osztas.<br>";
echo "$szam1 ** $szam2 = $hatvanyozas.<br>";
?>
