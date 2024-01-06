<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../arbreStyle.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include("../tree.php");
    ?>
    <div class="container">
        <h1>Vos Favoris</h1>
        <div class='productList'>
            <?php
            try{
                include("../../Identifiant/identifiantSQL.inc.php");
                $connection = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4",$username,$password); 
                if(!isset($_SESSION['id'])){
                    if(!isset($_SESSION['panier'])){
                        $_SESSION['panier']=[];
                    }
                    foreach($_SESSION['panier'] as $recipe){   
                        $requestQuery = "select Title from RECIPES where id=$recipe";
                        $res = $connection->query($requestQuery);
                        $title = $res->fetch();
                        $goodLink = "../../Photos/unknown.png" ;
                        $script = "this.src='$goodLink'";
                        $nameFileArray= preg_split("/ /",$title['Title']);
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
                            echo("<div class='product'> 
                                    <img class='photo' src=".$path.
                                    ">
                                    <h1><a style='text-decoration:none;color:black;font-weight:bold;' href='http://localhost/projetBoisson/productPage/recipe.php?recipe=".$recipe."'>".$title['Title']."</a></h1>
                                    <div>
                                        <button data-id =".$recipe." class='addToCart'>retirer des favoris</button>
                                    </div>
                                </div>");
                            
                    }
                }
                else{
                    $selectQuery = "select Title,id from RECIPES r join CART c on r.id=c.recipesID where c.userID=".$_SESSION['id'];
                    $recipesStatement = $connection->query($selectQuery);
                    $recipes = $recipesStatement->fetchAll();
                    foreach($recipes as $recipe){
                        $goodLink = "../../Photos/unknown.png" ;
                        $script = "this.src='$goodLink'";
                        $nameFileArray= preg_split("/ /",$recipe['Title']);
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
                            echo("<div class='product'> 
                                    <img class='photo' src=".$path.
                                    ">
                                    <h2 ><a style='color:black;text-decoration:none; font-weight:bold;' href='http://localhost/projetBoisson/productPage/recipe.php?recipe=".$recipe['id']."'>".$recipe['Title']."</a></h2>
                                    <div>
                                        <button data-id=".$recipe['id']." class='addToCart'>retirer des favoris</button>
                                    </div>
                                </div>");
                    }
                }
                $connection=null;
            }
           
            catch(PDOException $error){
                echo($error->getMessage());
            }
            ?>
        </div>
    </div>
</body>
<script src="./favoris.js"></script>
</html>
