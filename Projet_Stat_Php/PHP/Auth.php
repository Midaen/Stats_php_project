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

    				$ok = false;

    			$sql = "SELECT Login,Password FROM statistiques WHERE Login='".$login."' AND Password='".$passwordInput."'";

    				$infos_st = $db->query($sql);

    				if ($infos_rs = $infos_st->fetch()) {
    					// si la requete s'execute sans erreur et qu'une "vraie" ligne est retournee
              require('Statistiques.class.php');
              $stat = new Statistiques();
              $stat->updateLoginPassword($login,$passwordInput);   
              $stat->updateSession($login);

              $ok = true;
          echo "Connexion".$_SESSION['user'];
          echo "<script type='text/javascript'>document.location.replace('AffichageStatistiques.php');</script>";


        }else{

          echo 'Identifiants incorects<br>';
          echo 'Redirection en cours...';
        echo '<meta http-equiv="Refresh" content="2;URL=Main.php">';

        }

  } 
catch(PDOException $e)  {
  echo $sql . "<br>" . $e->getMessage();
}
 ?>
