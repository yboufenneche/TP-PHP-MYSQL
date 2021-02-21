<?php
    require "config.php";
    // Récuperer et afficher la liste dede tous les produits
    function listProducts(){
        global $pdo;
        try{
            $sql = "SELECT * FROM products";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            
            // Afficher les produits
            showProducts($result);
            return $result;
        }
        catch(PDOException $e){
            echo "Impossible de récuperer la liste des produits";
        }
    }

    // Fonction qui permet d'afficher la liste de tous les produits
    // avec des cases à cocheret des "input number" pour choisir la quantité 
    function showProducts($products){
        echo "<ul class='list-group'>";
        for($i = 0; $i< count($products); $i++){
            $ref   = $products[$i]['ref'];
            $label = $products[$i]['label'];
            $price = $products[$i]['price'];
            echo "<li class='list-group-item'><input type='checkbox' id = $i name = $i value = $ref>
                <label for=$i> $label ($price  &euro;) </label>
                <input type='number' name='qua$i' min='1' max='5' value = '1'></li>";            
            echo "<input type = hidden name = 'label$i' value = $label >";
            echo "<input type = hidden name = 'price$i' value = $price >";
        }
        echo "</ul>";
    }
?>