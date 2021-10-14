<?php
$kommune = "Kristiansand";         //Velger kommune

switch (strtolower($kommune)){     //sammenligner med switch
    case "kristiansand":    $fylke = "Agder";             break;    
    case "lillesand":       $fylke = "Agder";             break;
    case "birkenes":        $fylke = "Agder";             break;
    case "harstad":         $fylke = "Troms og Finnmark"; break; 
    case "kvæfjord":        $fylke = "Troms og Finnmark"; break;
    case "tromsø":          $fylke = "Troms og Finnmark"; break;
    case "bergen":          $fylke = "Vestland";          break;
    case "trondheim":       $fylke = "Trøndelag";         break;
    default:                $fylke = "ukjent";                    

}   

echo $kommune . " ligger  i " . $fylke . " fylke";  //Skriver ut

?>