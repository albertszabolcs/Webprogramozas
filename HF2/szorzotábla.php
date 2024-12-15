<?php
$color = "lightblue";

$Generalas = function($n) use ($color) {
    echo "<table border='1' style='border-collapse: collapse;'>";

    for ($i = 1; $i <= $n; $i++) {
        echo "<tr>";

        for ($j = 1; $j <= $n; $j++) {
            $result = $i * $j;
            
            if ($i == $j) {
                echo "<td style='background-color: $color;'>$result</td>";
            } else {
                echo "<td>$result</td>";
            }
        }
        echo "</tr>";
    }

    echo "</table>";
};


$Generalas(10);
?>
