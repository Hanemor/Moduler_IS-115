<?php
//Definerer gyldige tegn og maksimalt antall.
$MAX = 8;
$tegn = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

 //Passordet deklareres utenfor løkke
$passord = "";             


//Kjører helt til et gyldig passord er generert
do{
    $uc_finnes = false;         //Separate boolske variabler som brukes 
    $tall_finnes = false;       //  til å sjekke om passord oppfyller krav
 
    for ($i = 0; $i < $MAX; $i++) {                             
        $passord[$i] = $tegn[rand(0, strlen($tegn) - 1)];   //Genererer passord
    }

    for ($i = 0; $i < $MAX; $i++) {                         //Sjekker om streng inneholder  
        if ( ctype_digit($passord[$i]) ) {                  //  tall og stor bokstav
            $tall_finnes = true;
        }
        if ( ctype_upper($passord[$i]) ) {
            $uc_finnes = true;
        }
    }
    
}while(!$uc_finnes || !$tall_finnes);                       //Bryter når krav er oppfyllt

echo $passord;                                              //Skriver ut passord

?>
