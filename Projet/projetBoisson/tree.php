<?php
require_once 'Donnees.inc.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau Dynamique</title>
    <link rel="stylesheet" href="arbreStyle.css">
</head>

<body>
    <?php

    // ---------------------------------------------------------------------------- [Fonctions] ----------------------------------------------------------------------------  \\

    // Fonction pour afficher l'arbre.
    function genererListeHTML($noeud,$chemin) {
        foreach ($noeud as $nomCategorie => $categories) {
            if(isset($categories) && !empty($categories)){
                echo '<li class="parent"><a href="http://localhost/projetBoisson/productPage/productPage.php?produit='.$nomCategorie.'&chemin='.$chemin.'->'.$nomCategorie.'">'.$nomCategorie. '<span class="expand">»</span></a>';
                echo '<ul class="child">';
                genererListeHTML($categories,$chemin.'->'.$nomCategorie);
                echo '</ul>';
                echo '</li>';
            }else{
                echo '<li><a href="http://localhost/projetBoisson/productPage/productPage.php?chemin='.$chemin.'->'.$nomCategorie.'&produit='.$nomCategorie.'" nowrap>' . $nomCategorie . '</a></li>';
            }    
        }  
    }

    // Fonction récursive pour rajouter des sous-catégories à des aliments dans l'arbre.
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
    function findCat($arbre,$categories){
        $arr = null;
            foreach($arbre as $nomCategorie=>$arrCategorie){
                if(strcasecmp($nomCategorie,$categories) == 0 ){
                   $arr =$arrCategorie; 
                }
                else{
                   $result = findCat($arrCategorie,$categories);
                   if(isset($result)){
                    $arr = $result;
                   }
                }
            }
        return $arr;
            
    }
    function chercherFeuilles(&$arr, $categories,$nomCategorie) {
        if (!empty($categories)) {
            foreach ($categories as $nom=>$sousCategories) {
                chercherFeuilles($arr, $sousCategories,$nom);
            }
        } else {
            // $categories est une feuille, ajoutons-la à $arr
            
            array_push($arr,$nomCategorie);
            
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
                    if(strcasecmp($nom, 'Aliment') == 0){
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
    
    ?>
    
    <?php
    function generateNav($arbre){
    echo('<div style="background-color:blue;display:flex;flex-direction:row;">
    <ul id="main" style="width:80%">');
   
    
    session_start();
    foreach($arbre['Aliment'] as $nomCategorie => $categories){
        echo '<li class="parent">' . $nomCategorie;
        echo '<ul class="child">';
        genererListeHTML($categories,$nomCategorie);
        echo '</ul>';
        echo '</li>';
    }
    
    echo("</ul>");
    if(isset($_SESSION['id'])){
        echo(" <button><a href='http://localhost/projetBoisson/connection/deconnection.php'>déconnectez vous</a></button>
        <button><a href='localhost/'>profil</a></button>
                ");
    }else{
        echo(" <button><a href='http://localhost/projetBoisson/connexion.php'>connectez vous</a></button>");
    }
    
   echo("</div>"); 
}
generateNav($arbre);
    ?>
    
</body>