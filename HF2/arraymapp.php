<?php
function atalakit_array_map($tomb, $formaz){
    $callback = $formaz === "kisbetus" ? 'strtolower' : 'strtoupper';
    return array_map($callback, $tomb);
}

$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');

$szinek_array_map = atalakit_array_map($szinek, "kisbetus");
print_r($szinek_array_map);
?>
