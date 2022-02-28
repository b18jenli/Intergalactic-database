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

<h3>Planeter</h3>
<table>

<?php

    $pdo = new PDO('mysql:dbname=b18jenli;host=localhost', 'admin', 'mypass');

    foreach($pdo->query("SELECT * FROM planet") as $row){
      echo "<tr>";
      echo "<td>".$row['planetkod']."</td>";
      echo "<td>".$row['planetnamn']."</td>";
      echo "</tr>";
    }
?>

</table>
</body>
</html>
