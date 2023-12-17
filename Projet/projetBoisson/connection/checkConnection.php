<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);
 try{
    session_start();
    $connection = new PDO("mysql:host=localhost;dbname=projetBoisson", "root");
    $query = "select id from USER where login = ? and password = ?";
    $statement = $connection->prepare($query);
    $statement->execute([$data['login'],$data['password']]);
    $userID = $statement->fetch(PDO::FETCH_ASSOC);
    if(empty($userID)||!isset($userID)){
        $response = array("status"=> 'failed');
        echo json_encode($response);
    }
    else{
        $_SESSION['id']=$userID['id'];
        $fetchCartRequest = "select id,Title,ingredient,recipe from cart c join recipes r on c.recipesID = r.id and c.userID = ?";
        $statement = $connection->prepare($fetchCartRequest);
        $statement->execute([$userID['id']]);
        if(!isset($session['cart'])){
            $session['cart']=[];
        }
        $recipes =$statement->fetchAll(PDO::FETCH_ASSOC);
        foreach($recipes as $recipe){
            array_push($session['cart'],[$recipe['id'],$recipe['Title'],$recipe['ingredient'],$recipe['recipe']]);
        }
            $response = array("status"=> 'success');
            echo json_encode($response);
    }
    
}
catch(PDOException $error){
    echo($error->getMessage());
}



?>