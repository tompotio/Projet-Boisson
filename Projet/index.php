<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="projetBoisson/arbreStyle.css">
    <link rel="stylesheet" href="styles.css">
    <script src="index.js" defer></script>
</head>
<body>
    <?php
        include_once("./projetBoisson/tree.php"); 
        $servername = "localhost";
    $username = "root";
    $password = "";
    ?>
     <div class="container">
        <?php
             $pdo = new PDO("mysql:host=$servername;dbname=projetBoisson", $username);
             $arr2 =array();
             $i = 0;
             $requete="";
       
             $query = 'select distinct * from RECIPES';
             echo("<div class='grid'>");
             $goodLink = "../../Photos/unknown.jpg"; 
             $script = "this.src='$goodLink'";
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
                
                 $path = "../../Photos/$nameFile.jpg";
                 echo( "<a style='text-decoration:none;color:black' href=http://localhost/projetBoisson/productPage/recipe.php?recipe=" .$row['id'].">".
                     "<div class='gridItem'>".
                     "<img class ='photo' src ='$path' onError=$script>".
                     "<p style='z-index:10000'>".
                      $row['Title']."</p> "."</div></a>");
             }
             echo("</div");
             
            
            
            
             
        ?>
    ?>
</body>
</html>