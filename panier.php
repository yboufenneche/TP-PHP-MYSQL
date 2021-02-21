<?php
    require "panier-inc.php";
?>
 
<!DOCTYPE html>
<html lang = "fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de commande</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <div class = "container">
        <div class = "page-header">
            <h1> Détails de votre commande </h1>
        </div>
        <form action = "valid.php" method = "post">
            <div class ="form-group">
                <?php
                    showPanier($_SESSION["panier"]);    
                    echo "<b>TOTAL: </b> <span class = 'badge'> ". totalPrice($_SESSION["panier"]) . " euros </span><br>";
                ?>
            </div>
            <div class="form-group">
                <a href="welcome.php" id="cancel" name="cancel" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>
    </div>
</body>
</html>