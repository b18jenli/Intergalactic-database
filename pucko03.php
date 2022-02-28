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

<h3>Addera/uppdatera oregistrerad alien:</h3>

<form action="pucko03.php" method="post">
  Id: <input type="text" name="id" /><br>
  Alienid: <input type="text" name="alienid" /><br>
  Namn: <input type="text" name="namn" /><br>
  <input type="submit" />
</form>

<?php

    $pdo = new PDO('mysql:dbname=b18jenli;host=localhost', 'admin', 'mypass');
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );

    if(isset($_POST['id'])){
       $querystring='INSERT INTO regalien (id, alienid, namn) VALUES(:id,:alienid,:namn);';
       $stmt = $pdo->prepare($querystring);
       $stmt->bindParam(':id', $_POST['id']);
       $stmt->bindParam(':alienid', $_POST['alienid']);
       $stmt->bindParam(':namn', $_POST['namn']);
       $stmt->execute();
   }

    if(isset($_POST['ModId'])){
        $querystring='UPDATE oregalien SET id=:id, alienid=:alienid, namn=:namn WHERE id=:ModId;';
        $stmt = $pdo->prepare($querystring);
        $stmt->bindParam(':id', $_POST['id']);
        $stmt->bindParam(':alienid', $_POST['alienid']);
        $stmt->bindParam(':namn', $_POST['namn']);
        $stmt->bindParam(':ModId', $_POST['ModId']);
        $stmt->execute();
    }else if(isset($_POST['EdId'])){
        echo "<div style='border:1px solid outset #888;border-radius:4px;background-color:#eee;'>";
        echo "<form action='pucko03.php' method='post' >";
            echo "<input type='hidden' name='ModId' value='".$_POST['EdId']."'>";
            echo "Id:<input type='text' name='id' value='".$_POST['EdId']."'><br>";
            echo "Alienid:<input type='text' name='alienid' value='".$_POST['alienid']."'><br>";
            echo "Namn:<input type='text' name='namn' value='".$_POST['namn']."'><br>";
            echo "<input type='submit' value='Save' >";
        echo "</form>";
        echo "</div>";
    }

    echo "<table>";
    echo "<tr>";
    echo "<td class='rubrik'>Id:"."</td>";
    echo "<td class='rubrik'>Alienid:"."</td>";
    echo "<td class='rubrik'>Namn:"."</td>";
    echo "<td class='rubrik'>"."</td>";
    echo "</tr>";
    foreach($pdo->query("SELECT * FROM oregalien") as $row){
      echo "<tr>";
      echo "<td>".$row['id']."</td>";
      echo "<td>".$row['alienid']."</td>";
      echo "<td>".$row['namn']."</td>";
      echo "<td>";
        echo "<form action='pucko03.php' method='post' >";
          echo "<input type='hidden' name='EdId' value='".$row['id']."'>";
          echo "<input type='hidden' name='alienid' value='".$row['alienid']."'>";
          echo "<input type='hidden' name='namn' value='".$row['namn']."'>";
          echo "<input type='submit' value='Edit' >";
        echo "</form>";
      echo "</td>";
      echo "</tr>";
    }
    echo "</table>";

?>
</body>
</html>
