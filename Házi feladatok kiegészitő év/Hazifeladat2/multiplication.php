<?php

$color = "lightgreen";

$generator = function ($n) use ($color) {
    $html = "<table border='1' cellpadding='5' cellspacing='0'>";

    for ($i=1; $i <= $n; $i++) {
        $html .= "<tr>";
        for ($j = 1; $j <= $n; $j++) {
            $html .="<td style='background-color: $color'>" . ($i * $j) . "</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
};

echo $generator(10);

?>
