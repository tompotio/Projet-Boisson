<?php
     $input_data = file_get_contents("php://input");
     $data = json_decode($input_data, true);
     include("../../Identifiant/identifiantSQL.inc.php");
     session_start();
     try{
        $connection = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4", $username,$password);
        $requete = "update USER set nom = ?, prenom = ?, mail=?,Street=?,zipCode=?,city=?,telephone=? where id='" .$_SESSION['id']."'";
        $stmt = $connection->prepare($requete);
        $stmt->execute([$data['nom'],$data['prenom'],$data['mail'],$data['adresse'],$data['codepostal'],$data['ville'],$data['téléphone']]);
        echo("success");
        $connection=null;
     }
     catch(PDOException $error){
        echo json_encode($error->getMessage());
    }
?>