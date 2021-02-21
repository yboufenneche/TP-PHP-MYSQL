<?php
    set_error_handler(function($niveau, $message, $fichier, $ligne){
    echo "Erreur : " .$message. "<br>";
    echo "Niveau de l'erreur : " .$niveau. "<br>";
    echo "Erreur dans le fichier : " .$fichier. "<br>";
    echo "Emplacement de l'erreur : " .$ligne. "<br>";
    });
?>