<pre>                   
<?php
$a[0] = "a";                                    //Lager array og gir indexene i verdi 
$a[3] = "b";
$a[5] = "c";
$a[7] = "d";
$a[8] = "e";
$a[15] = "f";

echo "<b>Skriver ut med print_r:</b><br>";

print_r($a);                                    //Utskrift med print_r

echo "<br><br><b>Skriver ut med for-løkke:</b><br>";

for ($i = 0; $i <= max(array_keys($a)); $i++){  //Utskrift med for-løkke
    if (array_key_exists($i, $a)){
        echo "index " . $i . " = " . $a[$i] . "<br>";
    }
}
?>
</pre> 