<?php
try{
    $connection = new PDO("mysql:host=localhost;dbname=projetBoisson", "root");
    $fetchCartRequest = "select id,Title,ingredient,recipe from cart c join recipes r on c.recipesID = r.id and c.userID = ?";
    $statement = $connection->prepare($fetchCartRequest);
    $userID = 3;
    $statement->execute([$userID]);
}
catch(PDOException $error){
    echo($error->getMessage());
}
?>