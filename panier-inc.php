<?php

    // Initialiser la session
    session_start();
    
    // Vérifier si l'uilisateur est connecté, si non, le rediriger vers la page login.php
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["nbAllProducts"])){
        header("location: login.php");
        exit;
    }

    // Nombre toatal de produits
    $n = $_SESSION["nbAllProducts"];

    // Créer une variable session représentant le panier sous forma d'un tableau associatif
    $_SESSION["panier"] = [];
    $j = 0;
    for($i = 0; $i < $n; $i++){
        if (isset($_POST[$i])) 
        { 
            $p = ["ref"   => $_POST[$i], 
                "label" => $_POST["label$i"], 
                "price" => $_POST["price$i"],
                "qua"  => $_POST["qua$i"]
            ];
            $_SESSION["panier"][$j] = $p;
            $j++;
        }
    }

    // Fonction qui calcule le montant total correspondant à un panier
    function totalPrice($panier){
        $total = 0;
        for($i = 0 ; $i < count($panier); $i++){
            $total = $total + $panier[$i]["price"] * $panier[$i]["qua"];
        }
        return $total;
    }

    // Afficher un panier sous forme d'un tableau HTML
    function showPanier($panier){
        echo "<table class = 'table table-hover'>";
        echo "<thead>";
        echo "<tr><th>Produit</th><th>Quatité</th><th>Prix unitaire</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        for($i = 0; $i < count($panier); $i++){
            echo "<tr><td>". $panier[$i]['label'] . "</td><td>" . $panier[$i]['qua'] . "</td><td>" . $panier[$i]['price'] . "</td></tr>";
        }
        echo "</tbody>";
        echo"</table>";
    }
?>