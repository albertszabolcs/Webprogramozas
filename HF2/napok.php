<?php
$napok = array(
    "HU" => array("H", "K", "Sze", "Cs", "P", "Szo", "V"),
    "EN" => array("M", "Tu", "W", "Th", "F", "Sa", "Su"),
    "DE" => array("Mo", "Di", "Mi", "Do", "F", "Sa", "So"),
);

foreach ($napok as $nyelv => $napokListaja) {
    echo "$nyelv: ";
    foreach ($napokListaja as $nap) {
        if ($nap == "K" || $nap == "Th" || $nap == "Szo") {
            echo "<b>$nap</b>, ";
        } else {
            echo "$nap, ";
        }
    }
    echo rtrim(", ") . "<br>";
}
?>
