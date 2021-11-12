<?php

function dbConnect(){

$user = 'root';
$password = '';
$db = 'klubbdb';

$db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");

//if ($db) {echo "DB-tilkobling vellykket<br>";}                   //Feedback

return $db;
}

?>