<?php

$mappe = "./index8_katalog/";     //Henviser til mappe

$mappeRef = opendir($mappe);    //Mappe åpnes

?>

<table border=1>
    <tr>
        <b>
        <td>Filnavn <td>Filtype <td>Filstørrelse
        <td>Sist endret <td>Tillatelser </td>
        </b>
        
        <?php while($neste = readdir($mappeRef)){

            if (filetype($mappe . $neste) != "dir"){

                $endret = filemtime($mappe . $neste);
                $endringsTidspunkt = date("d.m.Y | H:i", $endret);

                $tillatelser = "";
                if(is_readable($mappe . $neste)){   $tillatelser .= "r, ";}
                if(is_writable($mappe . $neste)){   $tillatelser .= "w, ";}
                if(is_executable($mappe . $neste)){ $tillatelser .= "e";}

                echo "<tr><td><a href = $mappe$neste>$neste</a> </td>";
                echo "<td>" . filetype($mappe . $neste) .      "</td>";
                echo "<td>" . filesize($mappe . $neste) .      "</td>";
                echo "<td>" . $endringsTidspunkt .             "</td>";
                echo "<td>" . $tillatelser       .             "</td>";   
            }
        }
        ?>
            
    </tr>
            
</table> 