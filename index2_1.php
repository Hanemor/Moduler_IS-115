<?php
$etternavn = "cAsTbErG";                //Deklarerer variabel og gir den verdi



$etternavn = strtolower($etternavn);    //Endrer først alle bokstaver til lowercase
$etternavn = ucfirst($etternavn);       //Endrer så kun den første bokstaven til uppercase

echo "Etternavn: " . $etternavn . " - Antall tegn: " . strlen($etternavn);

?>
