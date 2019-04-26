<?php
session_start();
$idSession = session_id();

setcookie('pseudo', $idSession, time() + 365*24*3600, null, null, false, true);
echo $_COOKIE['pseudo'];




 ?>
