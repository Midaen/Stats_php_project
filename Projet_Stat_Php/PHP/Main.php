
<!DOCTYPE html>
<html>
<body>

<h1>Connexion</h1>
<form method="post" action="Auth.php">
  Login:<br>
  <input type="text" name="Login" value=""><br>
  Password:<br>
  <input type="password" name="Password" value="">
  <input type="submit" value="Submit">

</form>
<a href="CreateAcc">Créer un Compte</a>

</body>
</html>

<?php
// Import de la classe Statistiques
require('Statistiques.class.php');
// création d'un objet Statistiques
$stats = new Statistiques() ;

 ?>
