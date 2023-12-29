<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);
require_once("./Identifiant/identifiantSQL.inc.php");
$connection = new PDO("mysql:host=$servername;dbname=$dataBase", $username,$password);
session_start();
$request = "select distinct Title,id from recipes where Title like '".strtolower($data['search'])."%'";
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
       
        $path = "../../Photos/$nameFile.jpg";
    array_push($array,[$recipe['Title'],$recipe['id'],$path]);
}

echo json_encode($array,JSON_UNESCAPED_UNICODE);
?>