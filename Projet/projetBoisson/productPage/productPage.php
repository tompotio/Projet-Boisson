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
        print_r(array_unique($arr));
        
        echo($_SESSION['id']);
        ?>
        <?php
            $pdo = new PDO("mysql:host=$servername;dbname=projetBoisson", $username);
            $query = 'select distinct Title,ingredient,recipe from RECIPES r join composition c on r.id = c.recipeID join products p on p.productID = c.productID where p.product_name ='."'".$_GET['produit']."'";
            $result = $pdo->query($query);
        ?>

    </div>
   
</body>
</html>