<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorie</title>
    <script src="productPage.js" defer></script>
    <link rel="stylesheet" href="../arbreStyle.css">
    <link rel="stylesheet" href="productPage.css">
 
</head>
<body>
   
    <?php


    include("../../Identifiant/identifiantSQL.inc.php");
    include("../tree.php");
    ?>
     <div class="container">
        
        <?php 
        $splitResult = preg_split("~->~",$_GET['chemin']);
        $chemin = "";
        $cheminAvecLien="";
        $i=0;
        foreach($splitResult as $word){
                if($i==0){
                    $chemin=$chemin.$word;
                    $cheminAvecLien.="<a style='text-decoration:none;color:black' href='http://localhost/projetBoisson/productPage/productPage.php?produit=".$word."&"."chemin=".$chemin."'>".$word."</a>";
                }
                else{
                    $chemin=$chemin."->".$word;
                    $cheminAvecLien.="<a style='text-decoration:none;color:black' href='http://localhost/projetBoisson/productPage/productPage.php?produit=".$word."&"."chemin=".$chemin."'>"."->".$word."</a>";
                }
                $i++;
        }
        $arr = array();
        $categorieArr = findCat($arbre,$splitResult[count($splitResult)-1]);
        chercherFeuilles($arr,$categorieArr,$splitResult[count($splitResult)-1]);      
        ?>
        <p style='width:fit-content;position:relative;left:50%;transform:translateX(-50%)'><?php echo($cheminAvecLien);?></p>
        <?php
             $pdo = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4", $username,$password);
             
             $i = 0;
             $requete="";
             foreach(array_unique($arr) as $nomProduit){
                if($i==0){
                    $requete = $requete.'product_name ='.'"'.$nomProduit.'"';
                }
                else{
                    $requete = $requete.'or product_name ='.'"'.$nomProduit.'"';
                }
                $i++;
            }
             $query = 'select DISTINCT Title,id from RECIPES r join COMPOSITION c on r.id=c.recipeID join PRODUCTS p on p.productID=c.productID where '.$requete;
            echo("<div class='grid'>");
            $goodLink = "../../Photos/unknown.png"; 
            $script = "this.src='$goodLink'";
            foreach($pdo->query($query) as $row){
               
                $nameFileArray= preg_split("/ /",$row['Title']);
                $i = 0;
                $nameFile ="";
                foreach($nameFileArray as $word){
                   
                    if($i!=0){
                        $nameFile .="_".strtolower($word);
                    }
                    else{
                        $nameFile .=$word;
                        
                    }
                  
                    $i++;
                }

               
                $path = "../../Photos/$nameFile.jpg";
                if(!file_exists($path)){
                    $path = "../../Photos/unknown.png";
                }
                echo(
                    "<a style='text-decoration: none; color:black;' href=http://".$_SERVER['SERVER_NAME']."/projetBoisson/productPage/recipe.php?recipe=" .$row['id'].">".
                    "<div class='gridItem'>".
                    "<img  class ='photo' src ='$path' >".
                    "<p> ".$row['Title']."</p> "."</div></a>");
            }
            echo("</div");
            $pdo=null;
        ?>
    </div>
   
</body>
</html>