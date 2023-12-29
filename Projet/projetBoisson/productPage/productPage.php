<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <p style='width:fit-content;position:relative;left:50%;transform:translateX(-50%)'><?php echo(str_replace("%20"," ",$_GET['chemin']));?></p>
        <?php 
        $splitResult = preg_split("~->~",$_GET['chemin']);
        $arr = array();
        $categorieArr = findCat($arbre,$splitResult[count($splitResult)-1]);
        chercherFeuilles($arr,$categorieArr,$splitResult[count($splitResult)-1]);
       
        
      
        ?>
        <?php
             $pdo = new PDO("mysql:host=$servername;dbname=$dataBase", $username,$password);
             
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
             $query = 'select DISTINCT Title,id from RECIPES r join composition c on r.id=c.recipeID join products p on p.productID=c.productID where '.$requete;
            echo("<div class='grid'>");
            $goodLink = "../../Photos/unknown.jpg"; 
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
                echo(
                    "<div class='gridItem'>".
                    "<img style='width:50px;height:50px;object-fit:cover;' class ='photo' src ='$path' onError=$script>".
                    "<p >".
                    "<a  href=http://localhost/projetBoisson/productPage/recipe.php?recipe=" .$row['id'].">".
                     $row['Title']."</a></p> "."</div>");
            }
            echo("</div");
             
            
            
            
             
        ?>

    </div>
   
</body>
</html>