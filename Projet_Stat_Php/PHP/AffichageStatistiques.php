<!DOCTYPE html>
<html>
<body>


<a href="Main.php"> <- Retour  </a>
<br>
<a href="SecondMain.php"> <- Vers Page 2  </a>

<br>
<br>

</body>
</html>

<?php
// Import de la classe Statistiques
require('Statistiques.class.php');
// création d'un objet Statistiques
$stats = new Statistiques() ;
echo "Bienvenue ".$_SESSION['user']."<br> <br> <br>
";
//affichage
echo $stats->getStats()."<br>";
echo $stats->getStatsByIp()."<br>";
echo $stats->getStatsPng()."<br>";
echo $stats->getDailyStats($_SESSION['user'])."<br>";

echo $stats->getDailyStatsPng($stats->getDate())."<br>";





 ?>
