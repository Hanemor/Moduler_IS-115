<?php

//Variablenes verdi hardkodes da oppgaveteksten 
//ikke nevner noe annet
$tall1 = 25;
$tall2 = 10;

//Tallene summeres
$sum = $tall1 + $tall2;

//Diferansen finnes ved divisjon
$diff = $tall1 - $tall2;
if ($diff < 0) {   $diff = $diff * -1;}

//Snittet settes som (sum ÷ 2) da det er 2 tall
$snitt = $sum / 2;

//Svarene skrives ut som en setning
echo "Summen av tallene $tall1 og $tall2 er $sum, differansen er $diff, og gjennsomsnittet er $snitt";

?>