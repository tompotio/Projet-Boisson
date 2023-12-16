<?php
require_once 'Donnees.inc.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau Dynamique</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    // ---------------------------------------------------------------------------- [Fonctions] ----------------------------------------------------------------------------  \\

    // Fonction pour afficher l'arbre.
    function genererListeHTML($noeud) {
        foreach ($noeud as $nomCategorie => $categories) {
            if(isset($categories) && !empty($categories)){
                echo '<li class="parent"><a href="#" nowrap>' . $nomCategorie . '<span class="expand">»</span></a>';
                echo '<ul class="child">';
                foreach ($categories as $nomEnfant => $categoriesEnfant) {
                    if(!empty($categoriesEnfant)){
                        genererListeHTML($categoriesEnfant);
                    }else{
                        echo '<li><a href="#" nowrap>' . $nomEnfant . '</a></li>';
                    }
                }
                echo '</ul>';
                echo '</li>';
            }else{
                echo '<li><a href="#" nowrap>' . $nomCategorie . '</a></li>';
            }    
        }  
    }

    // Fonction récursive pour rajouter des sous-catégories à des aliments dans le arbre.
    function ajouterSousCategories(&$noeud, $Hierarchie, $nouvelAliment){
        foreach ($Hierarchie as $aliment => $categories) {
            // On retrouve l'array du nouvelAliment dans la hiérarchie.
            if(strcasecmp($aliment, $nouvelAliment) === 0){
                if(isset($categories['sous-categorie'])){
                    // On parcoure les sous-cat et on les rajoute au nouvelAliment
                    foreach ($categories['sous-categorie'] as $index => $nom) {
                        $noeud[$nom] = array();
                        ajouterSousCategories(
                            $noeud[$nom], 
                            $Hierarchie, 
                            $nom
                        );
                    }
                }
            }
        }
    }

    // ---------------------------------------------------------------------------- [Code] ----------------------------------------------------------------------------  \\

    // Instanciation de la racine de l'arbre.
    $arbre = array(
        'Aliment' => array()
    );

    // On parcoure tous les éléments de la hiérarchie.
    foreach ($Hierarchie as $aliment => $categories) {
        // Si l'élément est une sous-catégorie directe de Aliment, on met superAliment à true.
        if(!empty($categories)){
            if(isset($categories['super-categorie'])){
                foreach ($categories['super-categorie'] as $index => $nom) {
                    if(strcasecmp($nom, 'Aliment') === 0){
                        // On instancie un nouveau tableau au niveau de l'élément.
                        ajouterSousCategories(
                            $arbre['Aliment'], 
                            $Hierarchie, 
                            $nom
                        );
                    }
                }
            }
        }
    }
    
    // Affiche toute la hiérarchie sur la page web.
    echo '<ul id="main">';
    foreach($arbre['Aliment'] as $nomCategorie => $categories){
        echo '<li class="parent">' . $nomCategorie;
        echo '<ul class="child">';
        genererListeHTML($categories);
        echo '</ul>';
        echo '</li>';
    }
    echo '</ul>';
    echo '<br>';

    ?>
</body>