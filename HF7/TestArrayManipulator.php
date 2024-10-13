<?php
include "ArrayManipulator.php";

$manipulator = new ArrayManipulator();
$manipulator->a = 10; 
$manipulator->b = 20;

echo "a: " . $manipulator->a . "\n"; 
echo "c: " . $manipulator->c . "\n"; 

if (isset($manipulator->a)) {
    echo "Az 'a' elem létezik.\n"; 
}

unset($manipulator->a); 
if (!isset($manipulator->a)) {
    echo "'a' elem törölve.\n"; 
}

echo "Tömb tartalma: $manipulator\n"; 

$manipulator2 = clone $manipulator;
$manipulator2->b = 30; 
echo "Tömb tartalma: $manipulator2\n"; 
?>
