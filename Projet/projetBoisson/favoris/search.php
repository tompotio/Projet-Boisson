<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);

$connection = new PDO("mysql:host=localhost;dbname=projetBoisson", "root");
session_start();
if(!isset($_SESSION['id'])){
    
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier']=[];
    }
    $arrayIDcopy = new ArrayObject($_SESSION['panier']);
    $arrayID = $arrayIDcopy->getArrayCopy();
}else{
    $request = "select recipesID from cart c on where userID" . $_SESSION['id'];
    $stmt = $connection->query();
    $arrayID = $stmt->fetchAll();
}
    $array = [];
    foreach($arrayID as $recipeID){
        $request  = "select Title,id from recipes where id=" . $recipeID;
        $stmt = $connection->query($request);
        $dataRecipe = $stmt->fetch();
        if(str_starts_with(strtolower($dataRecipe['Title']),strtolower($data['search']))){
            $goodLink = "../../Photos/Black_velvet.jpg" ;
            $script = "this.src='$goodLink'";
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
            array_push($array,[mb_convert_encoding($dataRecipe['Title'], "UTF-8", "auto"),$dataRecipe['id'],$path]);
        }
    }
    echo json_encode($array);   


?>