<?php
session_start();


class Statistiques{

// Constructeur de la classe

  function __construct()
  {

    $servername = "localhost:3307";
    $username = "i171301";
    $password = "rmo24pq";
    $dbname = "INF2_i171301_";
    $name = $_SERVER['PHP_SELF'] ;
    $ip = $_SERVER['REMOTE_ADDR'] ;
    $idSession = session_id() ;
    try {
        //Connection à la bdd via l'objet PDO
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Mode Exception pour les erreurs
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Création de la commande
	            $sql = "SELECT * FROM statistiques WHERE pageVisitee='".$name."' AND ip='".$ip."' AND numSession='".$idSession."' AND date=curdate() ;";
              $result = $db->query($sql);
              if($result->rowCount() == 0) {
                  $insert = "INSERT INTO statistiques (pageVisitee,nbVisites,ip,numSession,date) VALUES ('".$name."',1,'".$ip."','".$idSession."',curdate() );";
                  $db->exec($insert);
                  // Création du cookie de la session
                  setcookie("Id",$idSession, time()+ 365*24*3600, null, null, false, true);
              } else {
                $sql = "UPDATE `statistiques` SET nbVisites=nbVisites+1 WHERE pageVisitee='".$name."' AND ip='".$ip."' AND numSession='".$idSession."' AND date=curdate() ;";
                // execution de la commande avec exec() car la commande ne retourne pas de valeur
                $db->exec($sql);
            }
        $sql = "UPDATE `statistiques` SET ip='".$ip."' WHERE pageVisitee='".$name."';";
        $db->exec($sql);
// Mise a jour de la date
    /*    $sql = "UPDATE `statistiques` SET date= curdate() WHERE pageVisitee='".$name."';";
        $db->exec($sql); */

        $sql = "SELECT id FROM statistiques WHERE pageVisitee='".$name."' AND ip='".$ip."' AND numSession='".$idSession."' AND date=curdate() ;";
        $result = $db->query($sql);
        $nb = $result->FETCH();
        $IdBDD =  $nb["id"];

      }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
      }

  }

// Fonction D'affichage du nombre d'acces
function showPageAccess(){ 
    $servername = "localhost:3307";
    $username = "i171301";
    $password = "rmo24pq";
    $dbname = "INF2_i171301_";
    $name = $_SERVER['PHP_SELF'] ;
    try {/*Début try*/
        //Connection à la bdd via l'objet PDO
        $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Mode Exception pour les erreurs
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Création de la commande
        $sql = "SELECT nbVisites FROM statistiques WHERE pageVisitee='".$name."';";
        $result = $db->query($sql);
        $nb = $result->FETCH();
        return $nb["nbVisites"];

      }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
      }
  }

function getStats() {
    $servername = "localhost:3307";
    $username = "i171301";
    $password = "rmo24pq";
    $dbname = "INF2_i171301_";
    $name = $_SERVER['PHP_SELF'] ;
    $ip = $_SERVER['REMOTE_ADDR'] ;
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $sql = "SELECT * FROM statistiques;";
    $resultStats = $db->query($sql);
			echo "<table>\n
				<tr>\n
				<td class='titre_colonne'>Pages</td>\n
				<td class='titre_colonne'>Nombre d'accès</td>\n
				</tr>\n";
			foreach($resultStats as $ligne) {
				echo "<tr>\n";
				echo "<td>".$ligne["pageVisitee"]."</td>\n";
				echo "<td>".$ligne["nbVisites"]."</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";
    }

function getStatsByIp(){
  $servername = "localhost:3307";
  $username = "i171301";
  $password = "rmo24pq";
  $dbname = "INF2_i171301_";
  $name = $_SERVER['PHP_SELF'] ;
  $ip = $_SERVER['REMOTE_ADDR'] ;
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $sql = "SELECT * FROM statistiques;";
  $resultStats = $db->query($sql);
    echo "<table>\n
      <tr>\n
      <td class='titre_colonne'>Ip</td>\n
      <td class='titre_colonne'>Pages</td>\n
      <td class='titre_colonne'>Nombre d'accès</td>\n
      </tr>\n";
    foreach($resultStats as $ligne) {
      echo "<tr>\n";
      echo "<td>".$ligne["ip"]."</td>\n";
      echo "<td>".$ligne["pageVisitee"]."</td>\n";
      echo "<td>".$ligne["nbVisites"]."</td>\n";
      echo "</tr>\n";
    }
    echo "</table>\n";


}
function getDate(){
  $servername = "localhost:3307";
  $username = "i171301";
  $password = "rmo24pq";
  $dbname = "INF2_i171301_";
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $sql = "SELECT date FROM statistiques WHERE date=curdate() ;";
  $result = $db->query($sql);
  $nb = $result->FETCH();
  return  $nb["date"];
}
function getStatsPng(){ 

  $servername = "localhost:3307";
  $username = "i171301";
  $password = "rmo24pq";
  $dbname = "INF2_i171301_";
  $name = $_SERVER['PHP_SELF'] ;
  $ip = $_SERVER['REMOTE_ADDR'] ;
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $sql = "SELECT `nbVisites`, `pageVisitee`, `ip` FROM `statistiques` WHERE 1 ORDER BY nbVisites DESC";
  $resultStats = $db->query($sql);
  $tempo=1;

    echo "<table>\n
      <tr>\n
      <td class='titre_colonne'>Pages</td>\n
      <td class='titre_colonne'>Nombre d'accès</td>\n
      </tr>\n";

    foreach($resultStats as $ligne) {
      if($tempo == 1)
      $valMax=$ligne["nbVisites"];
      $dimension = ($ligne["nbVisites"]/$valMax)*100;
      echo "<tr>\n";
      echo "<td>".$ligne["pageVisitee"]."</td>\n";
      echo "<td> <img src='imgOrange.php' width='".$dimension."' height='10'/> </td>";
      echo "</tr>\n";
      $tempo++;
    }
    echo "</table>\n";

} 

function getDailyStatsPng($dateVoulue){ 

  $servername = "localhost:3307";
  $username = "i171301";
  $password = "rmo24pq";
  $dbname = "INF2_i171301_";
  $name = $_SERVER['PHP_SELF'] ;
  $ip = $_SERVER['REMOTE_ADDR'] ;
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $sql = "SELECT `nbVisites`, `pageVisitee`, `ip` FROM `statistiques` WHERE date='".$dateVoulue."' ORDER BY nbVisites DESC";
  $resultStats = $db->query($sql);
  $tempo=1;

    echo "<table>\n
      <tr>\n
      <td class='titre_colonne'>Pages</td>\n
      <td class='titre_colonne'>Nombre d'accès</td>\n
      </tr>\n";

    foreach($resultStats as $ligne) {
      if($tempo == 1)
      $valMax=$ligne["nbVisites"];
      $dimension = ($ligne["nbVisites"]/$valMax)*100;
      echo "<tr>\n";
      echo "<td>".$ligne["pageVisitee"]."</td>\n";
      echo "<td> <img src='imgOrange.php' width='".$dimension."' height='10'/> </td>";
      echo "</tr>\n";
      $tempo++;
    }
    echo "</table>\n";


    } 

    function updateSession($pseudo){

      $_SESSION['user']= $pseudo;
    }


function updateLoginPassword($identifiant,$mdp){
  $servername = "localhost:3307";
  $username = "i171301";
  $password = "rmo24pq";
  $dbname = "INF2_i171301_";
  $name = $_SERVER['PHP_SELF'] ;
  $ip = $_SERVER['REMOTE_ADDR'] ;
  $idSession = session_id() ;
  $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $sql = "SELECT id FROM statistiques WHERE pageVisitee='".$name."' AND ip='".$ip."' AND numSession='".$idSession."' AND date=curdate() ;";
  $result = $db->query($sql);
  $nb = $result->FETCH();
  $IdBDD =  $nb["id"];
  $sql = "UPDATE `statistiques` SET Login='".$identifiant."' AND Password='".$mdp."' AND numSession='".$idSession."' WHERE pageVisitee='".$name."' AND ip='".$ip."' AND numSession='".$idSession."' AND date=curdate() AND id='".$IdBDD."' ;";
  // execution de la commande avec exec() car la commande ne retourne pas de valeur
  $db->exec($sql);


}
function getDailyStats($user) {
    $servername = "localhost:3307";
    $username = "i171301";
    $password = "rmo24pq";
    $dbname = "INF2_i171301_";
    $name = $_SERVER['PHP_SELF'] ;
    $ip = $_SERVER['REMOTE_ADDR'] ;
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $sql = "SELECT * FROM statistiques WHERE Login='".$user."' ORDER BY date DESC ;";
    $resultStats = $db->query($sql);
			echo "<table>\n
				<tr>\n
				<td class='titre_colonne'>Pages</td>\n
				<td class='titre_colonne'>Nombre d'accès</td>\n
				</tr>\n";
			foreach($resultStats as $ligne) {
				echo "<tr>\n";
				echo "<td>".$ligne["pageVisitee"]."</td>\n";
				echo "<td>".$ligne["nbVisites"]."</td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";
    }

}       

$conn= null ;
 ?>
