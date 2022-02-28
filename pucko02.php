<html>
<head>
  <link rel="stylesheet" type="text/css" href="layout.css">
</head>
<body>

  <h1>P.U.C.K.O - an intergalactic database</h1>

  <ul>
    <li><a class="active" href="pucko01.php">Start</a></li>
    <li><a href="pucko02.php">Registrerade aliens</a></li>
    <li><a href="pucko03.php">Oregistrerade aliens</a></li>
  </ul>

<h3>Registrera/uppdatera alien:</h3>

<form action="pucko02.php" method="post">
  Pnr: <input type="text" name="pnr" /><br>
  Alienid: <input type="text" name="alienid" /><br>
  Namn: <input type="text" name="namn" /><br>
  Planet: <input type="text" name="planet" /><br>
  <input type="submit" />
</form>



<?php

    $pdo = new PDO('mysql:dbname=b18jenli;host=localhost', 'admin', 'mypass');
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

    if(isset($_POST['pnr'])){
       $querystring='INSERT INTO regalien (pnr,alienid, namn, planet) VALUES(:pnr,:alienid,:namn,:planet);';
       $stmt = $pdo->prepare($querystring);
       $stmt->bindParam(':pnr', $_POST['pnr']);
       $stmt->bindParam(':alienid', $_POST['alienid']);
       $stmt->bindParam(':namn', $_POST['namn']);
       $stmt->bindParam(':planet', $_POST['planet']);
       $stmt->execute();
   }

    if(isset($_POST['ModPnr'])){
        $querystring='UPDATE regalien SET pnr=:pnr, alienid=:alienid, namn=:namn, planet=:planet WHERE pnr=:ModPnr;';
        $stmt = $pdo->prepare($querystring);
        $stmt->bindParam(':pnr', $_POST['pnr']);
        $stmt->bindParam(':alienid', $_POST['alienid']);
        $stmt->bindParam(':namn', $_POST['namn']);
        $stmt->bindParam(':planet', $_POST['planet']);
        $stmt->bindParam(':ModPnr', $_POST['ModPnr']);
        $stmt->execute();
    }else if(isset($_POST['EdPnr'])){
        echo "<div style='border:1px solid outset #888;border-radius:4px;background-color:#eee;'>";
        echo "<form action='pucko02.php' method='post' >";
            echo "<input type='hidden' name='ModPnr' value='".$_POST['EdPnr']."'>";
            echo "Pnr:<input type='text' name='pnr' value='".$_POST['EdPnr']."'><br>";
            echo "Alienid:<input type='text' name='alienid' value='".$_POST['alienid']."'><br>";
            echo "Namn:<input type='text' name='namn' value='".$_POST['namn']."'><br>";
            echo "Planet:<input type='text' name='planet' value='".$_POST['planet']."'><br>";
            echo "<input type='submit' value='Save' >";
        echo "</form>";
        echo "</div>";
    }

    echo "<table>";
    echo "<tr>";
    echo "<td class='rubrik'>Pnr:"."</td>";
    echo "<td class='rubrik'>Alienid:"."</td>";
    echo "<td class='rubrik'>Namn:"."</td>";
    echo "<td class='rubrik'>Planet:"."</td>";
    echo "<td class='rubrik'>"."</td>";
    echo "</tr>";
    foreach($pdo->query('SELECT * FROM regalien') as $row){
      echo "<tr>";
      echo "<td>".$row['pnr']."</td>";
      echo "<td>".$row['alienid']."</td>";
      echo "<td>".$row['namn']."</td>";
      echo "<td><a href='pucko04.php?planet=".urlencode($row['planet'])."'> ".$row['planet']."</a></td>";
      echo "<td>";
        echo "<form action='pucko02.php' method='post' >";
          echo "<input type='hidden' name='EdPnr' value='".$row['pnr']."'>";
          echo "<input type='hidden' name='alienid' value='".$row['alienid']."'>";
          echo "<input type='hidden' name='namn' value='".$row['namn']."'>";
          echo "<input type='hidden' name='planet' value='".$row['planet']."'>";
          echo "<input type='submit' value='Edit' >";
        echo "</form>";
      echo "</td>";
      echo "</tr>";
    }
    echo "</table>";

?>
</body>
</html>
