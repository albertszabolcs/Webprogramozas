<?php
$values = [42, "42", 3.14, "3.14", true, "true", null, ""];

echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><th>Érték</th><th>Tipus</th><th>Numerikus</th><th>String</th></tr>';

foreach ($values as $value) {
    echo '<tr>';
    echo '<td>';
    print_r($value);
    echo '</td>';
    echo '<td>' . gettype($value)  . '</td>';
    echo '<td>' . is_numeric($value) . '</td>';
    echo '<td>' . strval($value) . '</td>';
    echo '</tr>';
}
echo '</table>';

?>

