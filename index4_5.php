<?php 
$navn = array(                   //Array med deltakere
    "Amalie"    => null, 
    "Bernt"     => null, 
    "Camilla"   => null, 
    "Daniel"    => null, 
    "Eivind"    => null, 
    "Fredrik"   => null, 
    "Geir"      => null,
    "Hilde"     => null,
    "Ingrid"    => null, 
    "Johan"     => null 
);


$runde = 0;

do{                               //kjører dersom deltakere gjennstår

    echo "<b>Runde " . ++$runde . " - Deltakerne er som folger:</b><br>";


    foreach($navn as $k => $v){   
        $navn[$k] = rand(1, 50);  //Deltakere får poengsum
        echo $k . "<br>";         //Deltakere annonseres 
    }

    $minsteScore = min($navn);    //Laveste score finnes

    $uavgjortTeller = 0;          //Teller antall med laveste score
    foreach($navn as $v){                                   
        if ($v == $minsteScore)
        $uavgjortTeller++;
    }
    
    if ($uavgjortTeller != count($navn)) {  //Kjører hvis ikke uavgjort

        echo "<br>Folgende deltaker(e) er ute av konkuransen: ";
        foreach($navn as $k => $v){
            if ($v == $minsteScore){
                echo "<br>" . $k;
                unset($navn[$k]);
            }
        }
    
        if (count($navn) > 1){
            echo "<br><br>";
        }
    }
    else{                                                                   
        echo "<br>Runden ble uavgjort, ingen rykket ut.<br><br>";
    }


}while(count($navn) > 1);       //Bryter når kun en gjennstår


$vinner;                        //Nøkkelen som gjennstår -> $vinner
foreach($navn as $k => $v){
    $vinner = $k;
}

echo "<br><br><b>Vinneren er: " . $vinner . "!</b>"
?>