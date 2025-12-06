<?php

function convertClassic($tomb, $mode) {
    $eredmeny = [];
    foreach ($tomb as $kulcs => $ertek) {
        if ($mode === "kisbetűs") {
            $eredmeny[$kulcs] = strtolower($ertek);
        } elseif ($mode === "nagybetűs") {
            $eredmeny[$kulcs] = strtoupper($ertek);
        }
    }
    return $eredmeny;
}

function convertWithMap($tomb, $mode) {
        return array_map(function($ertek) use ($mode) {
            if ($mode === "kisbetűs") {
                return strtolower($ertek);
            } elseif ($mode === "nagybetűs") {
                return strtoupper($ertek);
            }
        },$tomb);

}
$szinek  = array('A' => 'Kek', 'B' => 'zold', 'C' => 'Piros');
print_r(convertClassic($szinek,"kisbetűs"));
print_r(convertWithMap($szinek, "nagybetűs"));

?>


