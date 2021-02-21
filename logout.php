<?php
// Initialiser la session
session_start();
 
// Supprimer toutes les variables de la session
$_SESSION = array();
 
// Détruire la session.
session_destroy();
 
// Redirection vers la page loginr.php
header("location: login.php");
exit;
?>