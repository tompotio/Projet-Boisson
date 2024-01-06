<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);
require_once("./Identifiant/identifiantSQL.inc.php");

$connection = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4", $username,$password);
$request = "select distinct Title,id from RECIPES where Title like '".strtolower($data['search'])."%'";
$stmt=$connection->query($request);
$result = $stmt->fetchAll();
$array =[];
foreach($result as $recipe){
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
    $goodLink = "./Photos/unknown.png"; 
    $path = "./Photos/$nameFile.jpg";
    if(!file_exists($path)){
        $path = $goodLink;
    }    
    array_push($array,[$recipe['Title'],$recipe['id'],$path]);
}
$connection =null;
echo json_encode($array,JSON_UNESCAPED_UNICODE);
?>