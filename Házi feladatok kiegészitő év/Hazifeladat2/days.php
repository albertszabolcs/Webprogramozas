<?php

$napok = array(
    "HU" => array("H", "K", "Sze", "Cs", "P", "Szo", "V"),
    "EN" => array("M", "Tu", "W", "Th", "F", "Sa", "Su"),
    "DE" => array("Mo","Di","Mi","Do","F","Sa","So")
);

function formatDays($napok)
{
    $kiemel = array(
      "HU" => ["K", "Cs", "Szo"],
      "EN" => ["Tu","Th","Sa"],
      "DE" => ["Di", "Do","Sa"]
    );

    $output = "";

    foreach ($napok as $nyelv => $napTomb) {

        $output .= "<strong>$nyelv:</strong>";
        $napokKiemel = [];
        foreach ($napTomb as $nap) {
            if (in_array($nap, $kiemel[$nyelv])) {
                $napokKiemel[] ="<b>$nap</b>";
            } else {
               $napokKiemel[]=$nap;
            }
        }
        $output .= implode(", ", $napokKiemel) . "<br>";
    }

    return $output;
}
echo formatDays($napok);

?>


