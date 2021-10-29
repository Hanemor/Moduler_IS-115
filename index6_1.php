<?php
$user = 'root';
$password = '';
$db = 'klubbdb';

$db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");

if ($db) {echo "Tilkoblet vellykket";}                      //Feedback

$sql = "SELECT * from medlemmer";                           //Definerer spørring

$result = mysqli_query($db, $sql);                          //Henter med spørring

$medlemmer = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);                                //frigir minne

mysqli_close($db);                                          //Lukker DB-connection


?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Oppgave 1</title>
    </head>

    <body>
        <p>
            <b>Medlemmene er som følger:</b>
            <table border=1>
                <tr>
                <?php foreach ($medlemmer[0] as $navn => $verdi){echo "<td><b>" . $navn . "</b></td>";}?>

                <?php foreach($medlemmer as $medlem):?>
                    <tr><?php foreach ($medlem as $navn => $verdi){

                        if ($navn == "kjonn"){              //Endrer fra boolsk verdi
                            switch ($verdi){
                                case 0: $val = "Kvinne";         break;
                                case 1: $val = "Mann";           break;
                            }
                        }
                        elseif ($navn == "kontigentstatus"){
                            switch ($verdi){
                                case 0: $val = "Ikke betalt";    break;
                                case 1: $val = "Betalt";         break;
                            }
                        }
                        else{
                            $val = $verdi;
                        }
                        
                        echo "<td>" . $val . "</td>";}      //Utskrift i rute
                        ?>

                <?php   endforeach; ?>
            
                </tr>
            
            </table> 
        </p>
    </body>
</html>