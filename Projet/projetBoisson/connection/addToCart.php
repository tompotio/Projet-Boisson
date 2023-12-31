<?php
include("../../Identifiant/identifiantSQL.inc.php");
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);

$recipeID = $data['id'];
session_start();
try{
    if(!isset($_SESSION['id'])){
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier']=null;
        }
        if(!in_array($recipeID,$_SESSION['panier'])){
            array_push($_SESSION['panier'],$recipeID);
            $response = array("status"=> 'add');
            echo(json_encode($response));
        }else{
            unset($_SESSION['panier'][array_search($recipeID,$_SESSION['panier'])]);
            $response = array("status"=> 'delete');
            echo(json_encode($response));
        }
    }
    else{
        $pdo = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4",$username,$password);
        $query = "select recipesID from CART where userID =? and recipesID=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['id'],$recipeID]);
        if(!$stmt->fetch()){
            $insertQuery = "insert into CART(userID,recipesID) values(?,?)";
            $stmt = $pdo->prepare($insertQuery);
            $stmt->execute([$_SESSION['id'],$recipeID]);
            $response = array("status"=> 'add');
            echo(json_encode($response));
        }
        else{
            $insertQuery = "delete from CART where userID =? and recipesID=?";
            $stmt = $pdo->prepare($insertQuery);
            $stmt->execute([$_SESSION['id'],$recipeID]);
            $response = array("status"=> 'delete');
            echo(json_encode($response));
        }   
    }
    $pdo=null;
}
catch(PDOException $error){
    echo ($error->getMessage());
}


?>