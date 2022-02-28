<html>
<head>
<link rel="stylesheet" type="text/css" href="layout.css">
</head>
<body>
  <h1>P.U.C.K.O - an alien database</h1>

  <ul>
    <li><a class="active" href="pucko01.php">Start</a></li>
    <li><a href="pucko02.php">Registrerade aliens</a></li>
    <li><a href="pucko03.php">Oregistrerade aliens</a></li>
  </ul>

  <h3>Ny alien:</h3>

  <form action="pucko01.php" method="post">
    Idkod: <input type="text" name="idkod" /><br>
    Farlighet: <input type="text" name="farlighet" /><br>
    <input type="submit" />
  </form>

<table>
  <tr>
    <td class="rubrik">Idkod:</td>
    <td class="rubrik">Farlighet:</td>
  </tr>

<?php

    $pdo = new PDO('mysql:dbname=b18jenli;host=localhost', 'admin', 'mypass');
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

    if(isset($_POST['idkod'])){
       $querystring='INSERT INTO alien (idkod,farlighet) VALUES(:idkod,:farlighet);';
       $stmt = $pdo->prepare($querystring);
       $stmt->bindParam(':idkod', $_POST['idkod']);
       $stmt->bindParam(':farlighet', $_POST['farlighet']);
       $stmt->execute();
   }

    foreach($pdo->query( 'SELECT * FROM alien;' ) as $row){
          echo "<tr>";
          echo "<td>".$row['idkod']."</td>";
          echo "<td><a href='pucko05.php?farlighet=".urlencode($row['farlighet'])."'> ".$row['farlighet']."</a></td>";
          echo "</tr>";
        }

        function debug($o){
        echo "<table>";
        echo '<pre>';
        print_r($o);
        echo '</pre>';

        }

        foreach($pdo->query( 'CALL avgfarlighet();' ) as $row){
        debug($row);
        }
?>

</table>
</body>
</html>
