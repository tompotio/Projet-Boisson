<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);
include("../treeData.php");
include("../../Identifiant/identifiantSQL.inc.php");
$connection = new pdo("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4",$username,$password);
$requete = "select Title,product_name,r.id from COMPOSITION c JOIN RECIPES r on c.recipeID = r.id JOIN PRODUCTS p on p.productID = c.productID";
$stmt = $connection->query($requete);
$resultArr = $stmt->fetchAll();
$result = array();
$success = true;
$sortResult =[];
foreach($resultArr as $composition){
    if(!isset($sortResult[$composition['Title']])){
        $sortResult[$composition['Title']]=[];
    }
    array_push($sortResult[$composition['Title']],['product_name'=>$composition['product_name'],'id'=>$composition['id']]);
}
$j=0;
foreach($sortResult as $key => $composition){
    $success = true;
   // echo(print_r(array_column($composition,'product_name'),true));
    foreach($data['desiré'] as $wish){ 
        $arr = array();
        $categorieArr = findCat($arbre,$wish);
        chercherFeuilles($arr,$categorieArr,$wish);
        $orSuccess = false;
        foreach($arr as $leaf){
            if(in_array($leaf,array_column($composition,'product_name'))){
                $orSuccess = true;
            }
        }
        if(!$orSuccess){
            $success = false;
        }
    }
    foreach($data['indesiré'] as $unWish){
        $arr = array();
        $categorieArr = findCat($arbre,$unWish);
        chercherFeuilles($arr,$categorieArr,$unWish);
        
        foreach($arr as $leaf){
           // echo($leaf);
            if(in_array($leaf,array_column($composition,'product_name'))){     
                $success = false;
            }
        }
       
    }
    if($success == false){
       // echo("$key ne passe pas");
    }
    else{
        
        $nameFileArray= preg_split("/ /",$key);
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
        array_push($result,['recipe'=>$key,'id'=>$composition[0]['id'],'path'=>$path]);
    }   
    $j++;
}
$connection =null;
echo(json_encode($result,JSON_UNESCAPED_UNICODE));  
?>





