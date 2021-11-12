<?php

require 'index7_db.php';

if(isset($_REQUEST['loggin'])){


    $query = "SELECT passordliste.passord, medlemmer.mail
    FROM medlemmer
    JOIN passordliste ON passordliste.mid = medlemmer.id
    WHERE medlemmer.mail='" . $_REQUEST["mail"] . "'";


    
    $con = dbConnect();

    $result = mysqli_query($con, $query);    
    
    if($result->num_rows === 0){
        $brukerFunnet = false;
    }
    else{$brukerFunnet = true;}

    

    if ($brukerFunnet){
        
        $r = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if(password_verify($_REQUEST["passord"], $r[0]["passord"])){

            mysqli_close($con);

            session_start();

            $_SESSION['bruker']['innlogget'] = true;
            $_SESSION['bruker']['mail'] = $r[0]["mail"];

            header("Location: index7_visMedlemmer.php");
            exit;
        }
        else{echo "Du har tastet inn feil brukernavn eller passord";}
    }
    else{echo "Du har tastet inn feil brukernavn eller passord";}
}

?>



<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="container">
        <label for="mail"><b>Mailadresse</b></label>
        <input type="text" placeholder="Skriv inn mailadresse" name="mail" required>

            
        <label for="passord"><b>Passord</b></label>
        <input type="password" placeholder="Skriv inn Passord" name="passord" required>
            
        <input type="submit" name="loggin" value="Logg inn" />
    </div>     
</form>