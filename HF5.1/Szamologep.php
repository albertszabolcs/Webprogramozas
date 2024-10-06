<?php
$szam1 = 10; 
$szam2 = 0;
$Muveletjel = '/';

$eredmeny = 0;
switch($Muveletjel) {
    case '+':
        $eredmeny = $szam1 + $szam2;
        break;
    case '-':
        $eredmeny = $szam1 - $szam2;
        break;
    case '*':
        $eredmeny = $szam1 * $szam2;
        break;
    case '/':
        if ($szam2 == 0) {
            echo "Hiba: 0-val való osztás nem megengedett.\n";
            exit; 
        } else {
            $eredmeny = $szam1 / $szam2;
        }
        break;
    default:
        echo "Hiba: Érvénytelen műveleti jel.\n";
        exit; 
}
echo "Az eredmény: $eredmeny\n";
?>