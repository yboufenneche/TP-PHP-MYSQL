<?php
// Informations de connexion à la base de donées 
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'tp');
 
// Tentative de conexion à la base de données
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Configurer PDO error mode à l'éxception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERREUR: Impossible de se connecter à la base de données. " . $e->getMessage());
}
?>