<pre>
<?php
$biler = array(                                 //Lager array 
    "Audi", "BMW", "Citroen",                   //verdiene får index 0 - 9
    "Datsun", "Ford", "Honda", 
    "Jaguar", "Kia", "Mazda", "Nissan");    

foreach($biler as $k => $v){                    //Endrer alle verdier
    $biler[$k] = strrev($biler[$k]);
}

foreach($biler as $k => $v){                    //Øker index med 10
    $biler[$k+10] = $v; 
    unset($biler[$k]);
}

print_r($biler);                                //Utskrift
?>
</pre>