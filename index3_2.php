<?php
$start = 0;         //Definerer variablene som den skal starte 
$slutt = 9;         // og avsluttte tellingen på

$sum = 0;           //Bruker $sum for å telle / lagre sum av addisjon

for ($i = $start; $i <= $slutt; $i++){  //Kjører 10 ganger (fra $start til $slutt)
    echo "teller: " . $i . "<br>";      //Gir bruker beskjed om at tallet er tellt
    $sum = $sum + $i;                   //Adderer nåværende sum med index $i
}

//Endelig utskrift
echo "Ferdig å telle! Summen av tallene ble " . $sum;
?>

