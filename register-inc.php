<?php
// Inclure le fichier config.php
require_once "config.php";
 
// Definir les variables et les initialiser avec des valeurs vides
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Traitement des données du formulaire lorsque celle-ci est envoyée
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Valider le nom d'utilisateur
    if(empty(trim($_POST["username"]))){
        $username_err = "Veuillez saisir le nom d'utilisateur.";
    } 
    else{ 
        try{
            // Preparer une requête select
            $sql = "SELECT id FROM users WHERE username = :username";
            $stmt = $pdo->prepare($sql);
             // Lier les variables avec les patramètres
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Configurer le paramètre username
            $param_username = trim($_POST["username"]);
            
            // Execution de la requête préparée
            $stmt->execute();
            if($stmt->rowCount() == 1){
                $username_err = "Ce nom d'utilisateur est déja pris.";
            } else{
                $username = trim($_POST["username"]);
            }            
        }
        catch (PDOException $e){
            echo "Oops! Quelque chose ne va pas. Veillez réessayer.";
        }
    }
    
    // Valider le mot de passe
    if(empty(trim($_POST["password"]))){
        $password_err = "Veuillez entrer un mot de passe.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Le mot de passe doit comporter au moins 6 caractères.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Valider la confirmation du mot de passe
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Veuillez confirmer le mot de passe.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Les mots de passe ne correspondent pas.";
        }
    }
    
    // Vérifiez les erreurs des inputs avant de les insérer dans la base de données
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){        
        try{
            // Préparer une requête insert
            $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($sql);
            
            // Lier les variables avec les patramètres
            $stmt->bindParam(":username", $param_username);
            $stmt->bindParam(":password", $param_password);
            
            // Configurer les paramètres
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Crypter le mot de passe
            
            // Execution de la requête préparée
            $stmt->execute();
            // Redirection vers la page login.php
            header("location: login.php");
        }
        catch(PDOException $e){
            echo "Quelque chose ne va pas. Veillez réessayer.";
        }
    }
    
    // Fermer la connexion
   $pdo = null;
}
?>