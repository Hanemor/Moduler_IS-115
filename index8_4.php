<?php
if(!empty($_GET['fil'])){   
    $filnavn = basename($_GET['fil']);      //Henter filnavn
    
    $path = 'index8_katalog/' . $filnavn;   //Henvisning til fil

    //Kjører om fil er funnet
    if(file_exists($path) && (!empty($path))){

        //Definerer headere
        header('Cache-Conrol: public');
        header('Content-Descriprion: File Transfer');
        header('Content-Disposition: attachment; filename=' . $filnavn);
        header('Content-Type: application/pdf');
        header('Content-Transfer-Encoding: binary');

        readfile($path);
        exit;

    }
    else {"Filen du prøvde å laste ned ble ikke funnet";}

}
?>

<html>
    <head>
        <h2>Last ned oppgavebeskrivelsen her</h2>
    </head>
    <body>
        <a href="index8_4.php?fil=oppgavebeskrivelse.pdf">Last ned</a>
    </body>
</html>