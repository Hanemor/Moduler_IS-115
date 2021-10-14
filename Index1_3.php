<?php
$navn = "Daniel";
$alder = 23;
?>

<html>

<!––skrives ut i tabell -->
<table border=1>
    <tr>
        <th>Navn</th>
        <th>Alder</th>
    </tr>
  <tr>
    <td><?php echo $navn?></td>
    <td><?php echo $alder?></td>
  </tr>
</table> 

<!––skrives ut i nummerert liste -->
<ol>
  <li><?php echo $navn?></li>
  <li><?php echo $alder?></li>
</ol>


<!––skrives ut i punktmerket liste -->
<ul>
  <li><?php echo $navn?></li>
  <li><?php echo $alder?></li>
</ul>

<!––skrives ut i paragraf -->
<p>
  Navn: <?php echo $navn?>
  <br>
  Alder: <?php echo $alder?>
</p>


</html>