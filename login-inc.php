<?php
// Initialiser la session
session_start();
 
// Vérifier si l'utilisateur est déja connecté, si oui, on le redirige vers la page welcome
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Inclure le fichier config.php
require "config.php";
 
// Definir les variables et les initialiser avec des valeurs vides
$username = $password = "";
$username_err = $password_err = "";
 
// Traitement des données du formulaire lorsque celle-ci est envoyée
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Vérifier si username est vide
    if(empty(trim($_POST["username"]))){
        $username_err = "Veuillez entrer le nom d'utilisateur.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Vérifier si password est vide
    if(empty(trim($_POST["password"]))){
        $password_err = "Veuillez entrer le mot de passe.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Valider les informations de connexion
    if(empty($username_err) && empty($password_err)){       
        try{
            // Preparer une requête select
            $sql = "SELECT id, username, password FROM users WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            // Lier les variables avec les patramètres
            $stmt->bindParam(":username", $param_username);
            
            // Configurer le paramètre username
            $param_username = trim($_POST["username"]);
            
            // Execution de la requête préparée
            $stmt->execute();
            // Véririfier si le nom d'utilisateur existe, si oui, vérifier le mot de passe
            if($stmt->rowCount() == 1){
                $row = $stmt->fetch();
                $id = $row["id"];
                $username = $row["username"];
                $hashed_password = $row["password"];
                if(password_verify($password, $hashed_password)){
                    // Le mot de passe est correct, on démarre une session
                    session_start();
                            
                    // Stocker les données dans les variables de session
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;                            
                            
                    // Redirection vers la page welcome
                    header("location: welcome.php");
                } else{
                    // Afficher un message d'erreur si le mot de passe n'est pas valide
                    $password_err = "Le mot de passe saisi n'est pas valide.";
                }
            } else{
                // Afficher un message d'erreur si username n'existe pas
                $username_err = "Aucun compte n'est lié à ce nom d'utilisateur";
            }
        }
        catch(PDOException $e) {
            echo "Oops! Quelque chose ne va pas. Veillez réessayer.";
        }
    
    // Fermer la connexion
    $pdo = null;
   }
}
?>