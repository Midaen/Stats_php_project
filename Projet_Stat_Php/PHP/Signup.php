<?php

require('db.inc.php');
$login = $_POST['Login'];
$passwordInput = $_POST['Password'];

try {
    //Connection à la bdd via l'objet PDO
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Mode Exception pour les erreurs
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Création de la commande
    $insert = "INSERT INTO statistiques (pageVisitee,nbVisites,ip,numSession,date,Login,Password) VALUES ('".$name."',1,'".$ip."','".$idSession."',curdate(),'".$login."','".$passwordInput."' );";
    $db->exec($insert);
    echo 'compte créé';
    echo "<script type='text/javascript'>document.location.replace('Main.php');</script>";

  } 
catch(PDOException $e)  {
  echo $sql . "<br>" . $e->getMessage();
}




 ?>
