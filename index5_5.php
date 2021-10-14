<?php
//Koden krypterer og dekrypterer ved å skifte hvert tegn ut med 
//  et annet fra ASCII tabellen.
//Endringen bestemmes ved at tegnets nummer (index?) økes med 
//  variabelen $asciiEndring.
//Variabelen økes/senkes for hvert tegn som krypteres/dekrypteres 
//  slik at det blir vanskeligere å finne den orginale strengen 
//  uten riktig funksjon.

//Koden er ment å kunne håndtere alle tegn fra og med nr 32 til 
//  og med 126 i ASCII tabellen. 
//Det sørges for at den krypterte strengen også kun består av disse 
//  tegnene slik at det kan skrives ut. 
//Dermed vil ingen "gyldige" strenger resultere i tegn som ikke kan 
//  vises på skjermen.



//Funksjoner defineres
function krypter($s){                                   
 
    $asciiEndring = 5;     //Definerer endring 
    $s = str_split($s);    //Fra streng til array
    
    if(!empty($s)){       
        $ks = array();     //Array - krypterte tegn

        foreach($s as $i => $c){                        //Hvert tegn i array

            $ks[$i] = (int) ord($c) + $asciiEndring++;  //Finner nytt nr

            if($ks[$i] > 222){                          //Sikrer lesbart tegn
                $ks[$i] -= 191;
            }                       
            elseif($ks[$i] > 127){                         
                $ks[$i] -= 96;
            }                 
                
                $ks[$i] = chr($ks[$i]);        //Finner ASCII tegn
        }
        return implode($ks);                   //Returnerer arrayen som streng
    }
    else{
        echo "Venligst skriv inn en streng";
    }
    return null;
}

function dekrypter($s){              //Dekrypterer 

    $s = str_split($s);              //Fra streng til array
    $asciiEndring = -5;                               

    if(!empty($s)){                
        $ks = array();               //Array - krypterte tegn

        foreach($s as $i => $c){    //Hvert tegn i array

            $ks[$i] = (int) ord($c) + $asciiEndring--;    

            if($ks[$i] < -95){       //Sikrer lesbart tegn
                $ks[$i] += 191;
            }                        
            elseif($ks[$i] < 32){                       
                $ks[$i] += 96;
            }                 
                
                $ks[$i] = chr($ks[$i]);
        }
        return implode($ks);
    }
    else{echo "Venligst skriv inn en streng";
    }

}


$streng = "Hei jeg heter Daniel";           //Strengens verdi settes

echo "<b>Før kryptering: </b><br>" . $streng . "<br>"; //Utskrift

$kryptertStreng = krypter($streng);                    //Lager kryptert streng

echo "<br><b>Etter kryptering: </b><br>" . $kryptertStreng . "<br>"; //Utskrift 

echo "<br><b>Etter dekryptering: </b><br>" . dekrypter($kryptertStreng);   



?>