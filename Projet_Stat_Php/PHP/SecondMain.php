<?php
// Import de la classe Statistiques
require('Statistiques.class.php');
// création d'un objet Statistiques
$stats = new Statistiques() ;
//affichage superflux
echo $stats->getStats();
 ?>
