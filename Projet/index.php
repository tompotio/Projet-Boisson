<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="projetBoisson/arbreStyle.css">
    <link rel="stylesheet" href="styles.css">
    <script src="index.js" defer></script>
</head>
<body>
    <?php
        require_once("./Identifiant/identifiantSQL.inc.php");
        include_once("./projetBoisson/tree.php");
    ?>
     <div class="container">
        <?php
             $pdo = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4", $username,$password);
             $arr2 =array();
             $i = 0;
             $requete="";
       
             $query = 'select distinct * from RECIPES';
             echo("<div class='grid'>");
             $goodLink = "./Photos/unknown.png"; 
             $script = "this.src='$goodLink'";
             $delay = 0;
             foreach($pdo->query($query) as $row){
                 $ingredientReplace = str_replace("|"," ",$row['ingredient']);
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
                
                 $path = "./Photos/$nameFile.jpg";
                 if(!file_exists($path)){
                    $path = $goodLink;
                 }
                 echo( "<a style='text-decoration:none;color:black;' href=http://".$_SERVER['SERVER_NAME']."/projetBoisson/productPage/recipe.php?recipe=".$row['id'].">".
                     "<div class='gridItem' style='animation-delay:".$delay."ms'>".
                     "<img class ='photo' src ='$path'".
                     "<p style='z-index:10000;text-decoration:none;color:black;'>".
                      $row['Title']."</p>"."</div></a>");
                     
             }
             echo("</div");
            $pdo=null;    
            
        ?>
        
    
</body>
</html>
