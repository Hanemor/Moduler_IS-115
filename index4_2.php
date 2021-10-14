<?php

function settVerdi($i){
    if (isset($_POST[$i])) {echo $_POST[$i];} 
}


if (isset($_POST['contact-send'])){
    $messages = array();    //Lagrer feilmeldinger i array
    $medlem = $_POST;       //kopierer $_POST over i lokal array

    

    //Setter inn feilmeldinger
    if (empty($_POST['id'])){   
        $messages[] = "Du må fylle inn ID";                 
    }
    if (empty($_POST['fornavn'])){   
        $messages[] = "Du må fylle inn fornavn";            
    }
    if (empty($_POST['etternavn'])){   
        $messages[] = "Du må fylle inn etternavn";          
    }

    if (empty($_POST['adresse'])){   
        $messages[] = "Du må fylle inn adresse";            
    }
    if (empty($_POST['postnummer'])){   
        $messages[] = "Du må fylle inn postnummer";         
    }
    elseif((1000 > $_POST['postnummer']) || 
        ( $_POST['postnummer'] > 9999 )){
            $messages[] = "Ugyldig postnummer";    
        }
    if (empty($_POST['poststed'])){   
        $messages[] = "Du må fylle inn poststed";           
    }

    if (empty($_POST['tlf'])){   
        $messages[] = "Du må fylle inn tlf";                
    }
    elseif((10000000 > $_POST['tlf']) || 
        ( $_POST['tlf'] > 99999999 )){
            $messages[] = "Ugyldig tlf";           
        }
    if (empty($_POST['mail'])){   
        $messages[] = "Du må fylle inn mail";               
    }

    if (empty($_POST['fodselsdato'])){   
        $messages[] = "Du må fylle inn fødselsdato";        
    }
    if (empty($_POST['kjonn'])){   
        $messages[] = "Du må fylle inn kjønn";              
    }

    if (empty($_POST['roller'])){   
        $messages[] = "Du må fylle inn minst en rolle";     
    }
    if (empty($_POST['dato'])){   
        $messages[] = "Du må fylle inn medlem siden dato";  
    }
    if (empty($_POST['kontigentstatus'])){  
        $messages[] = "Du må fylle inn kontigentstatus";    
    }

    

    if (empty($messages)){      //Skriver ut hvis det ikke fins feilmeldinger
        
        echo "<b>Bruker registrert</b><br>";    //Bekreftelse før utskrift

        foreach($medlem as $k => $v){          
            switch ($k){                        //Skriver ut forklaring
                case 'id':              echo "ID: ";                    break;
                case 'fornavn':         echo "Navn: ";                  break;
                case 'etternavn':       echo "Etternavn: ";             break;
                case 'adresse':         echo "Adresse: ";               break;
                case 'postnummer':      echo "Postnummer: ";            break;
                case 'poststed':        echo "Poststed:" ;              break;
                case 'tlf':             echo "Telefonnummer:" ;         break;
                case 'mail':            echo "E-post: ";                break;
                case 'fodselsdato':     echo "Poststed: ";              break;
                case 'kjonn':           echo "Telefonnummer: ";         break;
                case 'interesser':      echo "Interesser: ";            break;
                case 'aktiviteter':     echo "Kursaktiviteter: ";       break;
                case 'roller':          echo "Roller: ";                break;
                case 'dato':            echo "Medlem-siden dato: ";     break;
                case 'kontigentstatus': echo "Kontigentstatus: ";       break;                
            }

            if (($k == 'interesser') || ($k == 'aktiviteter') ||($k == 'roller')){   
                foreach($v as $n => $i){echo  " - " . $i . "<br>";}   //Printer array
            }
            else{echo "\t" . $v . "<br>";}      //Printer alt annet
            
        }

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

        <p>             <!––Input sendes med $_POST -->
            <label for="id">ID</label>
            <input name="id" type="number"       
                value="<?php settVerdi("id"); ?>">   

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
            
            <label for="poststed">Poststed</label>
            <input name="poststed" type="text"      
                value="<?php settVerdi("poststed") ?>">
        
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
                <option value="Sport">Sport</option>
                <option value="Musikk">Musikk</option>
                <option value="Biler og Kjøretøy">Biler og Kjøretøy</option>
                <option value="PC og Spill">PC og Spill</option>
            </select>
        
            <label for="aktiviteter[]">Kursaktiviteter</label>
            <select multiple name="aktiviteter[]" >          
                <option value="Matlaging">Matlaging</option>
                <option value="Strikking">Strikking</option>
                <option value="Fotball">Fotball</option>
            </select>

            <label for="roller[]">Roller</label>
            <select multiple name="roller[]">
                <option value="Admin">Admin</option>
                <option value="Leder">Leder</option>
                <option value="Medlem">Medlem</option>
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