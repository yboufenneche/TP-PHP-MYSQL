<?php
    // Initialiser la session
    session_start();

    // Inclure le fichier config.php
    require "config.php";
    
    // Definir les variables et les initialiser avec des valeurs vides
    $idUser = $_SESSION["id"];
    // On crée un identifiant de la commande
    $idOrder = $idUser . time();
    $idProduct = "";
    $quantity = 0;

    $orders  = $_SESSION["panier"];
    try{
        // Sauvegarder la commande dans la table orders
        $sql = "INSERT INTO orders (id_order, id_user) 
                VALUES (:idOrder, :idUser)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idOrder', $idOrder);
        $stmt->bindParam(':idUser', $idUser);
        $stmt->execute();

        // Sauvegarder dans la table concern
        $sql = "INSERT INTO concern (id_order, ref_product, quantity) 
                VALUES (:idOrder, :idProduct, :quantity)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idOrder', $idOrder);
        $stmt->bindParam(':idProduct', $idProduct);
        $stmt->bindParam(':quantity', $quantity);

        // On insère une ligne dans la table concern pour chaque produit avec le même idOrder
        for ($i = 0; $i< count($orders); $i++){
            $idProduct = $orders[$i]["ref"];
            $quantity  = $orders[$i]["qua"];
            $stmt->execute();
        }
        echo "Félicitations! Nous avons bien enregisté votre commande.";
    }
    catch(PDOException $e) {
        echo "Oops! Quelque chose ne va pas. Veillez réessayer. <br>";
        echo "Message: " . $e->getMessage() ."<br>";
        echo "File: " . $e->getFile() ."<br>";
        echo "Ligne: " . $e->getLine() ."<br>";
    }        
    // Fermer la connexion
    $pdo = null;
?>