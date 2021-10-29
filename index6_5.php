<?php
function dbConnect(){

    $user = 'root';
    $password = '';
    $db = 'klubbdb';

    $db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");

    if ($db) {echo "DB-tilkobling vellykket";}                   //Feedback

    return $db;
}

$sqlM = "SELECT 
    medlemmer.id, medlemmer.fornavn, medlemmer.etternavn, 
    interesseregister.iid, interesser.navn
    FROM medlemmer
    INNER JOIN interesseregister on interesseregister.mid = medlemmer.id
    INNER JOIN interesser on interesseregister.iid = interesser.id
    ORDER BY medlemmer.id";                                     //Definerer spørring


$sqlI = "SELECT interesser.navn
    FROM interesser";                       

$db = dbConnect();

$result = mysqli_query($db, $sqlM);                          //Henter med spørring
$medlemmer = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);  


$result = mysqli_query($db, $sqlI); 
$interesser = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);                                //frigir minne


mysqli_close($db);                                          //Lukker DB-connection

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Oppgave 5</title>
    </head>

    <body>
        <p>
            <?php foreach ($interesser as $interesse):?>


                <?php echo "<br><h2>" . $interesse["navn"] . "<h2>"?>

                <table border=1>

                    <tr><td><b>ID        </b></td>
                        <td><b>Fornavn   </b></td>
                        <td><b>Etternavn </b></td>

                    <?php foreach($medlemmer as $medlem){
                        
                        if ($medlem["navn"] == $interesse["navn"]){
                            echo "<tr><td>" . $medlem["id"]         . "</td>";   
                            echo "<td>"     . $medlem["fornavn"]    . "</td>";   
                            echo "<td>"     . $medlem["etternavn"]  . "</td>";      
                        }
                    }?>                
                    </tr>

                </table>             
            <?php   endforeach; ?>

        </p>
    </body>
</html>