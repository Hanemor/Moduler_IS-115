<?php

$mappe = "./index8_katalog/";     //Henviser til mappe

$mappeRef = opendir($mappe);      //Mappe åpnes


?>

<table border=1>
    <tr>
        <b>
        <td>Filnavn <td>Filtype <td>Filstørrelse <td>Sist endret <td>Tillatelser </td>
        </b>
        
        <?php while($neste = readdir($mappeRef)){       //Går igjennom mappe

            if (filetype($mappe . $neste) != "dir"){    //Fjerner "." og ".."

                $endret = filemtime($mappe . $neste);
                $endringsTidspunkt = date("d.m.Y | H:i", $endret);

                $tillatelser = "";                     //Finner tillatelser
                if(is_readable(  $mappe . $neste)){$tillatelser  .= "read";     }
                if(is_writable(  $mappe . $neste)){$tillatelser  .= ", write";    }
                if(is_executable($mappe . $neste)){ $tillatelser .= ", execute";}

                //Printer filer til tabell
                echo "<tr><td><a href = $mappe$neste>$neste</a>";   //Henvisning til fil
                echo "<td>" . filetype($mappe . $neste);            //Utskrift i tabell
                echo "<td>" . filesize($mappe . $neste);
                echo "<td>" . $endringsTidspunkt;
                echo "<td>" . $tillatelser . "</td>";   
            }
        }
        ?>
            
    </tr>
            
</table> 