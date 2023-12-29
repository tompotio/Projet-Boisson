<?php
include("../../Identifiant/identifiantSQL.inc.php");
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);
 try{
    session_start();
    $connection = new PDO("mysql:host=$servername;dbname=$dataBase", $username,$password);
    $query = "select id from USER where login = ? and password = ?";
    $statement = $connection->prepare($query);
    $statement->execute([$data['login'],$data['password']]);
    $userID = $statement->fetch(PDO::FETCH_ASSOC);
    if(empty($userID)||!isset($userID)){
        $response = array("status"=> 'failed');
        echo json_encode($response);
    }
    else{   
            //on enregistre les elements de la session dans la bdd
            foreach($_SESSION['panier'] as $recipe){
                $checkQuery = "select recipesID from cart where userID=".$userID['id']. " and recipesID=".$recipe;
                $data = $connection->query($checkQuery);
                if(!$data->fetch()){
                    $insertQuery = 'insert into cart(userID,recipesID) values('.$userID["id"].",".$recipe.")";
                    $connection->exec($insertQuery);
                }  
            }
            $_SESSION['panier']=[];
            $request = "select recipesID from cart where userID=".$userID['id'];
            $stmt = $connection->query($request);
            $array = $stmt->fetchAll();
            foreach($array as $recipe){
               array_push($_SESSION['panier'],$recipe['recipesID']); 
            }
            $_SESSION['id']=$userID['id'];
            $response = array("status"=> 'success');
            echo json_encode($response);
    }
    
}
catch(PDOException $error){
    echo($error->getMessage());
}



?>