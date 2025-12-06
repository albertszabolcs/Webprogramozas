<?php

 $grades = [85, 92, 78, 88, 95];
 $total = 0;

 echo "<table border='1' cellpadding='5' cellspacing='0'>";
 echo "<tr><th>Tantárgy</th><th>Pontszám</th><th>Jegy</th></tr>";

 foreach ($grades as $index => $score) {
     //echo "Tantárgy " . ($index + 1) . ": Pontszám = $score, Jegy = ";

     if ($score < 60) {
         $grade = 1;
     } else {
         switch (true) {
             case ($score >= 90):
                 $grade = 5;
                 break;
             case ($score >= 80):
                 $grade = 4;
                 break;
             case ($score >= 70):
                 $grade = 3;
                 break;
             case ($score >= 60):
                 $grade = 2;
                 break;
         }
     }

     echo "<tr><td>" . ($index + 1) . "</td><td>$score</td><td>$grade</td></tr>";
     //echo $grade . "<br>";

     $total += $score;
 }
     $average = $total / count($grades);

     if ($average < 60) {
         $finalGrade = 1;
     } else {
         switch (true) {
             case ($average >= 90):
                 $finalGrade = 5;
                 break;
             case ($average >= 80):
                 $finalGrade = 4;
                 break;
             case ($average >= 70):
                 $finalGrade = 3;
                 break;
             case ($average >= 60):
                 $finalGrade = 2;
                 break;
         }
     }
     echo "</table>";
     echo "<br>Átlagpontszám: " . round($average, 2);
     echo "<br>Végső osztályzat: $finalGrade";
?>


