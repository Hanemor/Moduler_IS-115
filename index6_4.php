<?php
function dbConnect(){

    $user = 'root';
    $password = '';
    $db = 'klubbdb';

    $db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");

    if ($db) {echo "DB-tilkobling vellykket";}                   //Feedback

    return $db;
}

$sql = "SELECT aktiviteter.id, aktiviteter.navn, 
aktiviteter.ansvarlig_id, aktiviteter.dato

FROM aktiviteter";

                    
$db = dbConnect();

$result = mysqli_query($db, $sql);                          //Henter med spørring
$aktiviteter = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);  

mysqli_close($db); 

?>


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Oppgave 4</title>
    </head>

    <body>
        <table border=1>
                <tr><td><b>Id    </b></td>
                    <td><b>Navn   </b></td>
                    <td><b>Ansvarlig </b></td>
                    <td><b>Dato </b></td>

                <?php foreach ($aktiviteter as $aktivitet):?>

                    <?php                         

                    $d1 = new datetime(date("Y-m-d"));
                    $d2 = new datetime($aktivitet["dato"]);

                        if ($d1 < $d2){
                            echo "<tr><td>" . $aktivitet["id"]              . "</td>";   
                            echo "<td>"     . $aktivitet["navn"]            . "</td>";          
                            echo "<td>"     . $aktivitet["ansvarlig_id"]    . "</td>";                     
                            echo "<td>"     . $aktivitet["dato"]            . "</td>";   
                        }
                    ?>                
                </tr>

            <?php   endforeach; ?>
        
        </table>
    </body>
</html>