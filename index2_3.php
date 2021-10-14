<?php 
//Lager variabel med strengen
$str = "Thereses familie skulle ha ris til middag. Hun ville heller ha en is å spise.";

//Setter str til lowercase dersom det skulle trengs (noe som ikke er tilfellet her)
$str = strtolower($str);           

//lager variabel med valgt substring
$sub_str = "is";

//bruker funksjon for å telle antallet før den printer ut
$antall_is = substr_count($str, $sub_str);
echo '"' . $sub_str . '" nevnes ' . $antall_is . ' ganger';
?>