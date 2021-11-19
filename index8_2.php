<?php
/**Programmet holder styr på antall brukere som besøker siden, og  
 * printer ut de ti siste som har lagt inn en melding i gjesteboken.
*/

if(isset($_POST["contact-send"])){      //Legger inn i gjestebok
    $loggfil = fopen("index8_katalog/log.txt", "a+");
    fwrite($loggfil, "\n" . "(" . date("d.m.y H:i"). ") ".
    $_POST["navn"] . ": " . $_POST["hilsen"]);
    fclose($loggfil);

    foreach ($_POST as $k=>$v) {        //Sletter data i $_post
        unset($_POST[$k]);
    }
}

//Åpner for å lese
$loggfil = fopen("index8_katalog/log.txt", "r"); //handel til fil
$antall = (int) fgets($loggfil) + 1;             //Finner antall besøkende
fclose($loggfil);


//Skriver endring
$loggfil = fopen("index8_katalog/log.txt", "r+");
fwrite($loggfil, $antall);
fclose($loggfil);



$loggfil = fopen("index8_katalog/log.txt", "r");
echo "Antall brukere som har åpnet denne siden: ";

$arr = array();
while(!feof($loggfil)) {
    $arr[] = fgets($loggfil) . "<br>";
} //Leser


echo $arr[0] . "<br>" . $arr[1];        //antall og overskrift
for($i = sizeof($arr); $i > sizeof($arr) - 10 ; $i--){
    if($i > 1){                         //Printer ikke overskrift
        echo $arr[$i - 1];
    }
}

fclose($loggfil);


?>


<html>
    <body>

        <p>
            <h2>
                Velkommen! Du kan skrive deg inn i gjesteboken under:
            </h2>
        </p>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="container">
                <label for="Navn"><b>Navn</b></label>
                <input type="text" placeholder="Skriv inn navn" name="navn" required>

                    
                <label for="hilsen"><b>Hilsen</b></label>
                <input type="tekst" placeholder="Skriv inn en hilsen" name="hilsen" required>
                   
                <button type="submit" name="contact-send">Send</button>     
            </div>     
        </form>
    </body>
<html>