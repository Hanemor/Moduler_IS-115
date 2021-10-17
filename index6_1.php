<?php
/*Lag en databasetabell som heter medlemmer (eller noe lignende) som skal inneholde medlemsdata. 

Lag et script som kobler til databasen og henter data. 
Scriptet skal vise en oversikt over medlemmene som 
finnes i denne tabellen som en html tabell*/

$user = 'root';
$password = '';
$db = 'klubbdb';

$db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");

echo "Tilkoblet vellykket";



?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Oppgave 2</title>
    </head>

    <body>
        <p>
            <table>
            <tr>
                <th>Company</th>
                <th>Contact</th>
                <th>Country</th>
            </tr>
            <tr>
                <td>Alfreds Futterkiste</td>
                <td>Maria Anders</td>
                <td>Germany</td>
            </tr>
            <tr>
                <td>Centro comercial Moctezuma</td>
                <td>Francisco Chang</td>
                <td>Mexico</td>
            </tr>
            </table> 
        </p>
    </body>
</html>