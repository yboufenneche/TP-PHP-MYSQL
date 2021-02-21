<?php
   require_once "register-inc.php";
?>
 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <div class="container">
    <div class="page-header">
        <h1>Création de compte</h1>
    </div>
        <p>Veuillez remplir ce formulaire pour créer un compte.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confimer le mot de passe</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Envoyer">
                <input type="reset" class="btn btn-default" value="Réinitiliser">
            </div>

            <p>Vous avez déja un compte? <a href="login.php">Se connecter</a>.</p>
            
        </form>
    </div>    
</body>
</html>