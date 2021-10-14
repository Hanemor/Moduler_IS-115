<?php

date_default_timezone_set('CET');       //Setter gjeldende tidssone
//Fødselsdagen som brukes defineres (hardkodet)
$f_dag = 13;   
$f_mnd = 12; 
$f_år  = 1998;


//Klasse for datoer kun definert av år og dag
class Dato{ 
    private $år;                                //Datoens år
    private $dag;                               //Datoens dager

    public function __construct($d, $å){        //konstruktor som tar inn år og dager
        $this->år = $å;
        $this->dag = $d;
    }


    //Funksjon som finner alderen og skriver ut
    public function printAlder(){               
        $å = date("Y") - $this->år;
        $d = date("z") - $this->dag;

        if($d < 0){                             //sikrer riktig output dersom dagen ble negativ ved forrige utregning
            --$å;                           
            $d = $d + 365;                      
        }
        
        echo "Alderen er: " . $å . " år og " . $d . " dager";
    }

}

//////////////////////////////////////////////

//Lager objekt med fødselsdatoen
$fødselsdag = mktime(0,0,0,$f_mnd, $f_dag, $f_år);            //mktime() brukes her for å regne fra måneder til dager
$fd = new Dato(date("z", $fødselsdag), date("Y", $fødselsdag));


$fd->printAlder();                              //Tilkaller funksjonen som regner og skriver ut

?>