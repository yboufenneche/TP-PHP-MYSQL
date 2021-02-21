<?php
    require "login-inc.php";
?>
 
<!DOCTYPE html>
<html lang = "fr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>
<body>
    <div class="container">
    <div class="page-header">
        <h1>Authentification</h1>
    </div>
        <p>Veuillez renseigner vos informations de connexion.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>  

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Se conecter">
            </div>

            <p>Vous n'avez pas encore un compte? <a href="register.php">Créer un compte</a>.</p>

        </form>
    </div>
</body>
</html>