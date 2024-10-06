<?php
$honap = (int)readline("Kérlek, add meg a hónap számát (1-12): ");

switch ($honap) {
    case 1:
    case 2:
    case 12:
        echo "A hónap télre esik.\n";
        break;
    case 3:
    case 4:
    case 5:
        echo "A hónap tavaszra esik.\n";
        break;
    case 6:
    case 7:
    case 8:
        echo "A hónap nyárra esik.\n";
        break;
    case 9:
    case 10:
    case 11:
        echo "A hónap őszre esik.\n";
        break;
    default:
        echo "Kérlek, érvényes hónap számot adj meg (1-12).\n";
    }
?>
