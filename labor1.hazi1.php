<?php
$array = ([5, '5','05',12.3,'16.7','five','true',0xDECAFBAD,'10e200']);


foreach ($array as $index => $value) {
    echo "Index: " . $index . " Érték: ". $value . " Tipus : " . gettype($value) . "<br>" . "Numerikus: ";
    if (is_numeric($value)) {
        echo "Igen" . "<br>";
    }else {
        echo "Nem" . "<br>";
    }
}
?>