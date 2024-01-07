<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);

include("../treeData.php");
include("../../Identifiant/identifiantSQL.inc.php");
$arr = array();
$categorieArr = findCat($arbre,$data['id']);
chercherFeuilles($arr,$categorieArr,$data['id']);
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
$query = 'select distinct Title,id from RECIPES r join COMPOSITION c on r.id=c.recipeID join PRODUCTS p on p.productID=c.productID where '.$requete;
$pdo = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4", $username,$password);
foreach($pdo->query($query) as $row){
    if(str_starts_with(strtolower($row['Title']),strtolower($data['search']))){
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
        array_push($arr2,[$row['Title'],$row['id'],$path]);
    }
}
$pdo=null;
echo json_encode($arr2,JSON_UNESCAPED_UNICODE);
?>