<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="recipe.css">
    <link rel="stylesheet" href="../arbreStyle.css">
</head>
<body>
    <?php
    try{
       
        include("../tree.php");
        include("../../Identifiant/identifiantSQL.inc.php");
        $connection = new PDO("mysql:host=$servername;dbname=$dataBase", $username,$password);
        $query = 'select Title,ingredient,recipe from RECIPES where id='.$_GET['recipe'] ;
        
        $data = $connection->query($query);
        $data  = $data->fetch();
        $nameFileArray= preg_split("/ /",$data['Title']);
        $i = 0;
        $nameFile ="";
        $goodLink = "../../Photos/unknown.jpg"; 
        $script = "this.src='$goodLink'";
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
        $ingredientReplace = str_replace("|"," ",$data['ingredient']);
       
       $html = "<div class='container'>
                    <div class='productLegend'>
             
                        <img class='photo' src=$path onError=$script>"."<h1 >".
                        $data['Title']."</h1>".
                        "</div>
                         <hr>
                         <h1 style='text-align:center;'>Preparation</h1>
                         <hr />
                         <p style = 'margin:auto'>".$data['recipe']."</p>";
        echo($html);
        $ingredients = preg_split("/[|]/",$data['ingredient']);
        echo(" <hr>
        <h1 style='text-align: center;'>Ingredient</h1>
        <hr />");
        echo("<ul style='margin:10px auto'>");
        foreach($ingredients as $ingredient){
            echo("<li class ='ingredient'>$ingredient</li>");
        }
        echo("</ul>");
        if(!isset($_SESSION['id'])){
            if(!isset($_SESSION['panier'])){
                $_SESSION['panier']=[];
            }
            if(in_array($_GET['recipe'],$_SESSION['panier'])){
                echo("<button class='addToCart'>retirer des favoris</button>");
            }
            else{
                echo("<button class='addToCart'>Ajouter au favoris</button>");
            }
        }
        else{
            $query = "select recipesID from cart where userID =? and recipesID=?";
            $stmt = $connection->prepare($query);
            $stmt->execute([$_SESSION['id'],$_GET['recipe']]);
            if(!$stmt->fetch()){
                echo("<button class='addToCart'>Ajouter au favoris</button>");
            }else{
                echo("<button class='addToCart'>retirer des favoris</button>");
            }
        }
      
       
        
    }
    catch(PDOException $error){
        echo($error);
    }
    ?>
    <script src="./recipe.js"></script>
</body>

</html>