<?php
require_once 'Donnees.inc.php';
// ---------------------------------------------------------------------------- [Fonctions] ----------------------------------------------------------------------------  \\

// Fonction pour afficher l'arbre.
function genererListeHTML($noeud,$chemin) {
    foreach ($noeud as $nomCategorie => $categories) {
        if(isset($categories) && !empty($categories)){
            echo '<li class="parent"><a href="http://'.$_SERVER['SERVER_NAME'].'/projetBoisson/productPage/productPage.php?produit='.$nomCategorie.'&chemin='.$chemin.'->'.$nomCategorie.'">'.$nomCategorie. '<span class="expand">»</span></a>';
            echo '<ul class="child">';
            genererListeHTML($categories,$chemin.'->'.$nomCategorie);
            echo '</ul>';
            echo '</li>';
        }else{
            echo '<li><a href="http://'.$_SERVER['SERVER_NAME'].'/projetBoisson/productPage/productPage.php?chemin='.$chemin.'->'.$nomCategorie.'&produit='.$nomCategorie.'" nowrap>' . $nomCategorie . '</a></li>';
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
echo('<nav style="background-color:white;display:flex;flex-direction:column;width:100%;">
<ul class="mainNavBar"style=display:flex;justify-content:center;gap:10px;height:50px;align-items:center;paddin:10px>');
session_start();
echo("<li><a style='color:black;' href=http://".$_SERVER['SERVER_NAME'].">Accueil</a>");
if(isset($_SESSION['id'])){
    echo("<li ><div id='nomCategorie'><a style='color:black;width:100%' href='http://".$_SERVER['SERVER_NAME']."/projetBoisson/profil/profil.php'>profil</a></div></li>
    <li><div id='nomCategorie'><a style='color:black;width:100%' href='http://".$_SERVER['SERVER_NAME']."/projetBoisson/connection/deconnection.php'>déconnectez vous</a></div></li>");
}
else{
    echo("<li><div id='nomCategorie'><a style='color:black;' href='http://".$_SERVER['SERVER_NAME']."/projetBoisson/connection/connexion.php'> connectez vous</a></div></li>");
}
echo("<img src='http://".$_SERVER['SERVER_NAME']."/Photos/loupe.png' class='loupe' alt='' style=' width:1%; height:30%;'> <li class='search' id='search' style='  display: flex; justify-content: center; margin:0 auto;'><input style='width:100%;margin:0 auto' type='text'></li>");
echo("<li><a href=http://".$_SERVER['SERVER_NAME']."/projetBoisson/rechercheParAliment/rechercheParAliment.php style='color:black'>recherche par groupe d'aliment</a></li>");
echo("<li ><div id='nomCategorie'><a style='color:black;' href='http://".$_SERVER['SERVER_NAME']."/projetBoisson/favoris/favoris.php'>vos favoris</a></div></li>");

echo("</ul>");
echo('<ul id="main" style="width:100%">');



foreach($arbre['Aliment'] as $nomCategorie => $categories){
    echo '<li class="parent">  <div id="nomCategorie"><a href=http://'.$_SERVER['SERVER_NAME'].'/projetBoisson/productPage/productPage.php?produit='.$nomCategorie.'&chemin='.$nomCategorie.'>'.$nomCategorie.'</a></div>';
    echo '<ul class="child">';
    genererListeHTML($categories,$nomCategorie);
    echo '</ul>';
    echo '</li>';
}

echo("</ul>");
echo("</nav>"); 
}
?>