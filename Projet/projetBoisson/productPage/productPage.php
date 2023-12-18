<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../arbreStyle.css">
</head>
<body>
   
    <?php
     include("../../tree.php");
    $servername = "localhost";
    $username = "root";
    $password = "";
    ?>
     <div class="container">
        <p><?php echo(str_replace("%20"," ",$_GET['chemin']));?></p>
        <?php 
        $splitResult = preg_split("~->~",$_GET['chemin']);
        $arr = array();
        $categorieArr = findCat($arbre,$splitResult[count($splitResult)-1]);
        $productsList = chercherFeuilles($arr,$categorieArr,$splitResult[count($splitResult)-1]);
       
        
      
        ?>
        <?php
             $pdo = new PDO("mysql:host=$servername;dbname=projetBoisson", $username);
             $arr2 =array();
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
             $query = 'select distinct * from RECIPES r join composition c on r.id=c.recipeID join products p on p.productID=c.productID where '.$requete;
            echo("<div style = 'display:flex;flex-direction:column;justify-content:center;align-items:center;'>");
             foreach($pdo->query($query) as $row){
               generate_recipe($row);
            }
            echo("</div");
             
            
            
            
             
        ?>

    </div>
   
</body>
</html>