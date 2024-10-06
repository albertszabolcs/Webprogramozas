<?php
$honap = (int)readline("Kérlek, add meg a hónap számát (1-12): ");

if ($honap >= 3 && $honap <= 5) {
    echo "Tavasz\n";
} elseif ($honap >= 6 && $honap <= 8) {
    echo "Nyar\n";
} elseif ($honap >= 9 && $honap <= 11) {
    echo "Ősz\n";
} elseif ($honap == 12 || $honap == 1 || $honap == 2) {
    echo "Tél\n";
} else {
    echo "Kérlek, érvényes hónap számot adj meg (1-12).\n";
}
?>
