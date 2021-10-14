<?php
$start = 1;         //Definerer variablene som den skal starte 
$slutt = 64;        // og avsluttte tellingen på

$korn = 0;          //Variabler som holder styr på gjeldende og
$sum = 0;           //  totalt antall korn

///////////////////////////////////////////////////////////////////


function tekstTall($tall, $s){          //Bestemmer hvordan tall skrives ut. 
    
    if($tall > pow(10, 9)){             //Kjører dersom tallet er større enn en milliard
        $str = "";                      //Starter med tom streng

        $overflow = false;              //Sjekker om overflow
        if ($tall > PHP_INT_MAX){$overflow = true;}       


        $tri = floor($tall / pow(10,18));                   //Flytter siffere til separate variabler
        if ($tri) {                                       
            $tall = $tall - ($tri * pow(10, 18));         
            $str = $tri . " trillioner, ";                  //Lager streng
        }

        $brd = floor($tall / pow(10,15));                   //Billiard
        if ($brd) {$tall = $tall - ($brd * pow(10, 15));    //$tall brukes videre
            $str = $str . $brd . " billiarder, ";
        }

        $bil = floor($tall / pow(10,12));                   //Billion
        if ($bil) {$tall = $tall - ($bil * pow(10, 12));
            $str = $str . $bil . " billioner, ";
        }
        
        $mrd = floor($tall / pow(10,9));                    //Milliard
        if ($mrd) {$tall = $tall - ($mrd * pow(10, 9));
            $str = $str . $mrd . " milliarder, ";
        }
        
        $mil = floor($tall / pow(10,6));                    //Million
        if ($mil) {$tall = $tall - ($mil * pow(10, 6));
            $str = $str . $mil . " millioner, ";
        }

        $tus = floor($tall / pow(10,3));                    //Tusen
        if ($tus) {$tall = $tall - ($tus * pow(10, 3));
            $str = $str . $tus . " tusen, ";
        }

        $hun = floor($tall / pow(10,2));                    //Hundre
        if ($hun) {$tall = $tall - ($hun * pow(10, 2));
            $str = $str . $hun . " hundre";
        }

        if($overflow && $s)     {--$tall;}                  //Kompanserer for upresis float-verdi
        

        if($tall)   {$str = $str . " og " . $tall;}         //Rest


        return $str;        //Returnterer som streng
    }
    else{return $tall;}     //Returnerer som int
}

///////////////////////////////////////////////////////////////////


for ($i = $start; $i <= $slutt; $i++){                      //Løkken kjører 64 ganger
    if($i == $start){++$korn;}                              //Første iterasjon: antall = 1
    else{$korn = $korn * 2;}                                //Videre iterasjoner: antall * 2
    $sum = $sum + $korn;                                    //antall korn legges til

    //Utskrift for hver iterasjon
    echo 'Rute "' . $i . '" har ' . tekstTall($korn, false) . ' hvetekorn' . "<br>";    
}

//Endelig utskrift av sum
echo "<b>Ferdig å telle! Summen av tallene ble " . tekstTall($sum, true) . "</b>";     
?>