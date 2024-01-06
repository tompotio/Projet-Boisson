<?php
include("../../Identifiant/identifiantSQL.inc.php");
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);

$connection = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4", $username,$password);
session_start();
if(!isset($_SESSION['id'])){
    
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier']=[];
    }
    $arrayIDcopy = new ArrayObject($_SESSION['panier']);
    $arrayID = $arrayIDcopy->getArrayCopy();
}
else{
    $request = "select recipesID from CART c where userID = '" . $_SESSION['id']."'";
    $stmt = $connection->query($request);
    $arrayID = $stmt->fetchAll();
}
$array = [];
foreach($arrayID as $recipeID){
        $request  = "select Title,id from RECIPES where id =" . $recipeID['recipesID'];
        $stmt = $connection->query($request);
        $dataRecipe = $stmt->fetch();
        if(str_starts_with(strtolower($dataRecipe['Title']),strtolower($data['search']))){
            $goodLink = "../../Photos/unknown.png";
            $nameFileArray= preg_split("/ /",$dataRecipe['Title']);
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
            array_push($array,[mb_convert_encoding($dataRecipe['Title'], "UTF-8", "auto"),$dataRecipe['id'],$path]);
        }
    }
$connection=null;
echo json_encode($array);   


?>