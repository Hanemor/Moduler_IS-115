<?php
$etternavn = '<h1> castberg </h1>';                     //Etternavn med html

echo "Uten tags: " . strip_tags($etternavn) . "<br>";   //Fjerner tags og printer ut

echo "Med tags: " . htmlentities($etternavn);           //Bruker htmlentities for å skrive ut uten at tags tolkes
?>

