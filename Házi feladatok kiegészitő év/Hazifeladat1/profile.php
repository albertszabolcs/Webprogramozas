<?php

//Személyes adatok változókban
$nev = "Albert Szabolcs"; // Név
$kor = 25;                // Kor
$varos = "Csikszereda";   // Város
$kedvenc_szin = "kék";    // Kedvenc szin
$hobbi = "Futás";         // Hobbi

?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Személyes Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .profil {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 18px;
        }
        .kedvenc-szin {
            color: <?php echo $kedvenc_szin; ?>;
            font-weight: bold;
        }
    </style>
</head>
<body>
<!-- Profil Tartalom -->
    <div class="profil">
        <h1>Személyes Profil</h1>
        <h2><?php echo "Üdvözöllek a profilomon!"; ?></h2>

        <p><strong>Név:</strong> <?php echo $nev; ?></p>
        <p><strong>Kor:</strong> <?php echo $kor; ?> éves</p>
        <p><strong>Város:</strong> <?php echo $varos; ?></p>
        <p><strong>Kedvenc szin:</strong> <em class="kedvenc-szin"><?php print $kedvenc_szin; ?></em></p>
        <p><strong>Hobbi:</strong> <?php echo $hobbi; ?></p>
    </div>
    </body>
    </html>


