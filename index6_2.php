<?php

function settVerdi($i){                             //skriver ut $_POST[]
    if (isset($_POST[$i])) {echo $_POST[$i];} 
}

function dbConnect(){                               //Kobler seg til DB

    $user = 'root';
    $password = '';
    $db = 'klubbdb';

    $db = new mysqli('localhost', $user, $password, $db) or die("Tilkobling misslykket");

    if ($db) {echo "DB-tilkobling vellykket";}                   //Feedback

    return $db;
}

function feilmeldinger($a){                         //Returnerer feilmeldinger
        
    $messages = array();    //Lagrer feilmeldinger i array

        //Setter inn feilmeldinger
    if (empty($a['fornavn'])){   
        $messages[] = "Du må fylle inn fornavn";            
    }
    if (empty($a['etternavn'])){   
        $messages[] = "Du må fylle inn etternavn";          
    }
    
    if (empty($a['adresse'])){   
        $messages[] = "Du må fylle inn adresse";            
    }
    if (empty($a['postnummer'])){   
        $messages[] = "Du må fylle inn postnummer";         
    }
    elseif((1000 > $a['postnummer']) || ( $a['postnummer'] > 9999 )){
        $messages[] = "Ugyldig postnummer";    
    }
    
    if (empty($a['tlf'])){   
        $messages[] = "Du må fylle inn tlf";                
    }
    elseif((10000000 > $a['tlf']) || ( $a['tlf'] > 99999999 )){
        $messages[] = "Ugyldig tlf";           
    }
    if (empty($a['mail'])){   
        $messages[] = "Du må fylle inn mail";               
    }
    if (empty($a['fodselsdato'])){   
        $messages[] = "Du må fylle inn fødselsdato";        
    }
    if (empty($a['kjonn'])){   
        $messages[] = "Du må fylle inn kjønn";                  
    }
    
    if (empty($a['roller'])){   
        $messages[] = "Du må fylle inn minst en rolle";     
    }
    if (empty($a['dato'])){   
        $messages[] = "Du må fylle inn medlem siden dato";  
    }
    if (empty($a['kontigentstatus'])){  
        $messages[] = "Du må fylle inn kontigentstatus";    
    }

    return $messages;                               //returnerer array
}

function insertMedlem($medlem, $con){               //Sender medlem til DB

    if ($medlem["kjonn"] == "Mann") {$medlem["kjonn"] = 1;}     //Setter som bolean
    else                            {$medlem["kjonn"] = 0; }

    if ($medlem["kontigentstatus"] == "Betalt") {$medlem["kontigentstatus"] = 1;}
    else                                        {$medlem["kontigentstatus"] = 0;}
        

    $sqlInsertMedlem = $con->prepare
        ('INSERT INTO medlemmer (fornavn, etternavn, adresse, postnummer, tlf, 
        mail, fodselsdato, kjonn, medlemSidenDato, kontigentstatus)

        VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);');         //Bruker prepared statement


    $sqlInsertMedlem->bind_param( "sssiissisi",
        $medlem["fornavn"], $medlem["etternavn"], $medlem["adresse"], 
        $medlem["postnummer"], $medlem["tlf"], $medlem["mail"], 
        $medlem["fodselsdato"], $medlem["kjonn"], 
        $medlem["dato"], $medlem["kontigentstatus"]     
    );                                                   //Dynamisk spørring

    $sqlInsertMedlem->execute();
    $sqlInsertMedlem->close();


}

function insertInteresse($id, $arr, $con){          //Sender interesse til DB

    foreach ($arr as $a){

        $sqlInsertInteresse = $con->prepare
            ('INSERT INTO interesseregister (mid, iid)
            VALUES (?, ?)'
        );


        $sqlInsertInteresse->bind_param( "ii", $id, $a);

        $sqlInsertInteresse->execute();
        $sqlInsertInteresse->close();
    }

}

function insertRolle($id, $arr, $con){              //Sender rolle til DB

    foreach ($arr as $a){

        $sqlInsertRolle = $con->prepare
            ('INSERT INTO rolleregister (mid, rid)
            VALUES (?, ?)'
        );
          

        $sqlInsertRolle->bind_param("ii", $id, $a,);

        $sqlInsertRolle->execute();
        $sqlInsertRolle->close();
    }
    
}

function insertAktivitet($id, $arr, $con){

    foreach ($arr as $a){
    
        $sqlInsertAktivitet = $con->prepare
            ('INSERT INTO aktivitetspåmelding (mid, aid)
            VALUES (?, ?)'
        );


        $sqlInsertAktivitet->bind_param( "ii", $id, $a);

        $sqlInsertAktivitet->execute();
        $sqlInsertAktivitet->close();
    }
}

////////////////////////////////////////////////////



if (isset($_POST['contact-send'])){

    
    $medlem = $_POST;                       //kopierer $_POST over i lokal array

    $messages = feilmeldinger($medlem);     //Lagrer feilmeldinger i array

 
    if (empty($messages)){                  //Sender til DB

        foreach ($_POST as $k=>$v) {        //Sletter data i $_post
            unset($_POST[$k]);
        }

        $con = dbConnect();                 //returnerer mysqli

        insertMedlem($medlem, $con);

        
        $idQuery = "SELECT id FROM medlemmer WHERE     
            mail = '" . $medlem["mail"] . "' AND fornavn = '" . $medlem["fornavn"] . "';";

        $result = mysqli_query($con, $idQuery);     //Henter id fra DB
        
        $r = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        mysqli_free_result($result);                //Frigir minne

        $id = $r[0]["id"];                          //Legger id i variabel
        
        insertRolle(    $id, $medlem["roller"],      $con); //Funksjoner for insert
        insertInteresse($id, $medlem["interesser"],  $con);
        insertAktivitet($id, $medlem["aktiviteter"], $con);

        echo "<br>Bruker lagt til med id: " . $id;

        mysqli_close($con);      //Lukker DB-connection'

        

    
    }
    else {                                      //Utskrift av feilmeldinger
        echo "<b>Venligst fyll inn alle feltene riktig:</b><br>";
        for($i = 0; $i < count($messages); $i++){
            echo $messages[$i] . '<br>';
        }
    }
    
}

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Oppgave 2</title>
    </head>

    <body>
        <pre>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <p> 
            <label for="fornavn">Fornavn</label>
            <input name="fornavn" type="text"       
                value="<?php settVerdi("fornavn"); ?>">
        
            <label for="etternavn">Etternavn</label>
            <input name="etternavn" type="text"     
                value="<?php settVerdi("etternavn"); ?>">
        
        <p>
            <label for="adresse">Gateadresse</label>
            <input name="adresse" type="text"       
                value="<?php settVerdi("adresse"); ?>">
        
            <label for="postnummer">Postnummer</label>
            <input name="postnummer" type="number"    
                value="<?php settVerdi("postnummer"); ?>">
        
        <p>
            <label for="tlf">Telefonnummer</label>
            <input name="tlf" type="number"           
                value="<?php settVerdi("tlf"); ?>">
        
            <label for="mail">E-post</label>
            <input name="mail" type="text"          
                value="<?php settVerdi("mail"); ?>">
        
        <p>
            <label for="fodselsdato">Fødselsdato</label>
            <input name="fodselsdato" type="date"   
                value="<?php settVerdi("fodselsdato"); ?>">

                        <!––Bruker velger en av to verdier -->    
            <label for="kjonn">Kjønn</label>
            <select name="kjonn">       
                <option value="" disabled selected>Velg Kjønn</option>
                <option value="Mann">Mann</option>
                <option value="Kvinne">Kvinne</option>
            </select>

        <p>             <!––Sender valgte alternativer i array -->
            <label for="interesser[]">Interesser</label>
            <select multiple name="interesser[]">  
                <option value=1>Fotball</option>
                <option value=2>Dart</option>
                <option value=3>Biljard</option>
                <option value=4>Dans</option>
            </select>
        
            <label for="aktiviteter[]">Kursaktiviteter</label>
            <select multiple name="aktiviteter[]" >          
                <option value=1>Fotballkurs</option>
                <option value=2>Biljardturnering</option>
                <option value=3>Dartturnering</option>
            </select>

            <label for="roller[]">Roller</label>
            <select multiple name="roller[]">
                <option value=1>Admin</option>
                <option value=2>Leder</option>
                <option value=3>Medlem</option>
            </select>

        <p>
            <label for="dato">Medlem-siden dato</label>
            <input name="dato" type="date"          
                value="<?php settVerdi("dato"); ?>">
        
            <label for="kontigentstatus">Kontigentstatus</label>
            <select name="kontigentstatus">
                <option value="" disabled selected>Velg Kontigentstatus</option>
                <option value="Betalt">Betalt</option>
                <option value="Ikke betalt">Ikke betalt</option>
            </select>
        
        <p>               <!––"send" knapp -->
            <button type="submit" name="contact-send">Send</button>                       
        </p>
    </pre>
    </form>
    </body> 
</html>