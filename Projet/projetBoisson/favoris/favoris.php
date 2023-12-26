<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                 
                $connection = new PDO("mysql:host=localhost;dbname=projetBoisson", "root"); 
                if(!isset($_SESSION['id'])){
                    if(!isset($_SESSION['panier'])){
                        $_SESSION['panier']=[];
                    }
                    foreach($_SESSION['panier'] as $recipe){
                        $requestQuery = "select Title from recipes where id=$recipe";
                        $res = $connection->query($requestQuery);
                        $title = $res->fetch();
                        $goodLink = "../../Photos/unknown.jpg" ;
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
                           
                            echo("<div class='product'> 
                                    <img class='photo' src=".$path." onError=".$script.
                                    ">
                                    <h1><a style='text-decoration:none' href='http://localhost/projetBoisson/productPage/recipe.php?recipe=".$recipe."'>".$title['Title']."</a></h1>
                                    <div>
                                        <button data-id =".$recipe." class='addToCart'>retirer des favoris</button>
                                    </div>
                                </div>");
                            
                    }
                }
                else{
                    $selectQuery = "select Title,id from recipes r join cart c on r.id=c.recipesID where c.userID=".$_SESSION['id'];
                    $recipesStatement = $connection->query($selectQuery);
                    $recipes = $recipesStatement->fetchAll();
                    foreach($recipes as $recipe){
                        $goodLink = "../../Photos/Black_velvet.jpg" ;
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
                           
                            echo("<div class='product'> 
                                    <img class='photo' src=".$path." onError=".$script.
                                    ">
                                    <h2 ><a style='color:black; font-weight:bold;' href='http://localhost/projetBoisson/productPage/recipe.php?recipe=".$recipe['id']."'>".$recipe['Title']."</a></h2>
                                    <div>
                                        <button data-id=".$recipe['id']." class='addToCart'>retirer des favoris</button>
                                    </div>
                                </div>");
                    }
                }
            ?>
        </div>
    </div>
</body>
<script src="./favoris.js"></script>
</html>
