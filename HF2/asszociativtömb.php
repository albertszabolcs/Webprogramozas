<?php
$orszagok = array(
    "Magyarország" => "Budapest", 
    "Románia" => "Bukarest", 
    "Belgium" => "Brüsszel", 
    "Ausztria" => "Bécs", 
    "Lengyelország" => "Varsó"
);

foreach ($orszagok as $orszag => $varos) {
    echo "$orszag fővárosa <span style='color: red;'>$varos</span><br>";
}
?>
