<?php

$tall1 = (float) 13.3;                      //PHP_INT_MAX * 1.25;        
$tall2 = (int) 15;                          //(int) floor($tall1 / 4);




for($i = 0 ; $i < 10 ; $i++){               //Løkke som kjøres 10 ganger
    
    $sum = $tall1 + $tall2;                 //Sum

    $diff = $tall1 - $tall2;                //Differanse   //abs(tall1, tall2)
    if ($diff < 0) {   $diff = $diff * -1;}
    
    $snitt = $sum / 2;                      //Snitt



                                            //Svarene skrives ut som en setning
    echo "Summen av tallene $tall1 og $tall2 er $sum," .
         " differansen er $diff, og gjennsomsnittet er $snitt <br>";
    
    $tall1++;                               //tall1 økes for hver iterasjon 

}


?>

<html>
    <p>
        Tallene kan være av forskjellige datatyper. 
        Variabelen de settes inn i omgjøres automatisk til riktig type.
    </p>
</html>