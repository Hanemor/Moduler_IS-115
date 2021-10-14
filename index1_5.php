<?php

//Antallet sekunder
$var = 4400;

//Utfører "heltalsdivisjon" slik at sekundene deles opp i minutter og sekunder
$min = round(($var / 60), 0);   //Finner antallet minutter og fjerner desimaler
$sek = $var % 60;               //Bruker modulo for å finne sekundene som gjennstår

//Prosessen gjenntas
$time = round(($min / 60), 0);
$min = $min % 60;

//Skriver ut svar
echo "$var sekunder = $sek sekunder, $min minutter, og $time time(r)";

?>