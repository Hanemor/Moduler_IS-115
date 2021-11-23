<?php
//Dummy login som erstattes i medlemssystem-prosjektet
//Bruker $_SESSION for å "late som" brukeren har logget inn
session_start();                                        //Oppretter session
$_SESSION['bruker']['innlogget']    = true;             //Gir array verdi    
$_SESSION['bruker']['mail']         = "post@mail.com";
$_SESSION['bruker']['id']           = 1;
//////////////////////////////////////////////////////////////////////////
//Funksjonaliteten under vil virke inn på hvilket bilde som vises på en profilside
//  da dette bestemmes av navn og filplassering
//////////////////////////////////////////////////////////////////////////




require "index_db.php";

$con = dbConnect();                                     //Mysqli

$query = "SELECT medlemmer.id, medlemmer.fornavn, medlemmer.etternavn
FROM medlemmer
WHERE medlemmer.id='" . $_SESSION['bruker']['id'] . "'";

$result = mysqli_query($con, $query);    
$n = mysqli_fetch_all($result, MYSQLI_ASSOC);   //Henter navn

$fornavn = $n[0]['fornavn'];                    //Variabler til overskrift
$etternavn = $n[0]['etternavn'];
$id = $n[0]['id'];

if (isset($_POST['contact-send'])){             //Bildet er sendt

    //$fil = $_FILES["profilbilde"];
    $filNavn = $_FILES["profilbilde"]['name'];
    $filTmpNavn = $_FILES['profilbilde']['tmp_name'];
    $filType = $_FILES["profilbilde"]['type'];
    $filStr = $_FILES["profilbilde"]['size'];
    $filFeil = $_FILES["profilbilde"]['error'];

    $fileExt = explode('.', $filNavn);
    $fileActualExt = strtolower(end($fileExt)); //jpg eller png

    $tillat = array('jpg', 'png');

    $riktigFormat = False;

    if (in_array($fileActualExt, $tillat)){  //Filtype
        if ($filFeil === 0){                 //Evt andre feil
            if ($filStr < 2000000){          //Filstr i bytes
                $riktigFormat = True;
            }
            else {echo "Filen er for stor";}
        }
        else{echo "Feil med filen";}
    }
    else {echo "Ugyldig filtype";}


    if($riktigFormat){
        $nyttNavn = $n[0]['id'];
        $nyttNavn .= "." . $fileActualExt;

        $mappePath = "index8_katalog/" . $nyttNavn;

        $mappeRef = opendir('index8_katalog/');      //Mappe åpnes
        while($neste = readdir($mappeRef)){ //Sjekker filer i katalog
            
            //Fjerner gammelt bilde
            if (($id . ".jpg") == $neste)
            { unlink('index8_katalog/' . $neste);}
            if (($id . ".png") == $neste)
            { unlink('index8_katalog/' . $neste);}

        }

        //Flytter nytt til katalog
        move_uploaded_file($filTmpNavn, $mappePath);

    }

}

session_destroy();
?>


<html>
    <head>
    <h2>
        Endre profilbilde som brukeren 
        <?php echo $fornavn . " " . $etternavn; ?><br>
    </h2>
    </head>

    <body>

        <?php 
        $mappe = "./index8_katalog/";     //Henviser til mappe

        $mappeRef = opendir($mappe);        //Mappe åpnes
        while($neste = readdir($mappeRef)){ //Sjekker filer i katalog
            
            //Printer kun fil med riktig navn
            if (($id . ".jpg") == $neste)
            {echo '<img src="index8_katalog/' . $neste . 
                '" alt="Profilbilde" style="width:125px;height:125px;">';
            }
            if (($id . ".png") == $neste)
            {echo '<img src="index8_katalog/' . $neste . 
                '" alt="Profilbilde" style="width:125px;height:125px;">';
            }

        }
        
        ?>

        <br>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>"
        method="post"
        enctype="multipart/form-data">

        <input type="file" name="profilbilde">

        <button type="submit" name="contact-send"
        value="upload">Last Opp</button>

        </form>
    </body>
</html>