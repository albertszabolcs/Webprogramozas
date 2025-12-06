<?php

$orszagok = array(
    "Magyarország" => "Budapest",
    "Románia" => "Bukarest",
    "Belgium" => "Brussels",
    "Ausztria" => "Vienna",
    "Poland" => "Warsaw"
);

function formatCountries($orszagok) {
    $html = "<ul>";
    foreach ($orszagok as $orszag => $fovaros) {
        $html .= "<li>$orszag fővárosa <span style='color: red;'>$fovaros</span></li>";
    }

    $html .= "</ul>";
    return $html;
}
echo formatCountries($orszagok);

?>
