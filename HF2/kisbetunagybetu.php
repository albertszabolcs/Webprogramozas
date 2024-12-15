<?php
function atalakit($tomb, $formaz){
    foreach($tomb as $kulcs => $ertek) {
        if ($formaz === "kisbetus") {
            $tomb[$kulcs] = strtolower($ertek);
        } elseif ($formaz === "nagybetus") {
            $tomb[$kulcs] = strtoupper($ertek);
        }
    }
    return $tomb;
}

$szinek = array('A' => 'Kek', 'B' => 'Zold', 'c' => 'Piros');

$szinek_kisbetus = atalakit($szinek, "kisbetus");
$szinek_nagybetus = atalakit($szinek, "nagybetus");

print_r($szinek_kisbetus);
print_r($szinek_nagybetus);
?>
