<?php

$num1 = 10;
$num2 = 5;

$osszeg = $num1 + $num2;
echo "$num1 + $num2 = $osszeg<br>";
$kulonbseg = $num1 - $num2;
echo "$num1 - $num2 = $kulonbseg<br>";
$szorzat = $num1 * $num2;
echo "$num1 * $num2 = $szorzat<br>";
$hanyados = $num2 != 0 ? $num1 / $num2 : "Nem osztható nullával";
echo "$num1 / $num2 = $hanyados<br>";


$html = <<<HTML
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kis számológép</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h2>Kis számológép eredményei</h2>

<table>
    <tr>
        <th>Összeg</th>
        <th>Különbség</th>
        <th>Szorzat</th>
        <th>Hányados</th>
    </tr>
    <tr>
        <td>$osszeg</td>
        <td>$kulonbseg</td>
        <td>$szorzat</td>
        <td>$hanyados</td>
    </tr>
</table>

</body>
</html>
HTML;

echo $html;
?>



