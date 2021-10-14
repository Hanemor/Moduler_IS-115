<?php
//Definerer variablene
$alder = 2;
$navn = "Daniel";

//Variabel som skrives ut før "myndig" defineres som en tom streng
$status = "";

//Variabelen $status endres til "ikke" dersom personen er under 18 år
if ($alder < 18) {$status = "ikke ";}

//Endelig utskrift av tekst
echo $navn . " er " . $alder . ", og dermed " . $status . " myndig";

?>