<?php
// Initialiser la session
session_start();
 
// Vérifier si l'uilisateur est connecté, si non, le rediriger vers la page login.php
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

//
require "welcome-inc.php";
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!-- <link rel = "stylesheet" href = "style.css"> -->
</head> 
<body>
    <div class = "container">
        <div class="page-header">
            <h1>Bonjour, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenue sur notre site.</h1>
        </div>
        <div class="form-group">
            <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
        </div>
            <form action = "panier.php" method = "post">
                <div class = "form-group">
                    <?php
                        $_SESSION["nbAllProducts"] = count(listProducts());
                    ?>
                </div>
                <div class = "form-group">
                <button type="submit" class="btn btn-primary">Suivant</button>
                </div>
            </form>
    </div>
</body>
</html>