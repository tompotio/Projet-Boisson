<?php
    $input_data = file_get_contents("php://input");
    $data = json_decode($input_data, true);
    session_start();
    try{
        require_once("../../Identifiant/identifiantSQL.inc.php");
        $connection = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4", $username,$password);
        $verif ="select count(*) from USER where login=?";
        $statement = $connection->prepare($verif);
        $statement->execute([$data['login']]);
        $count = $statement->fetch();
        if($count['count(*)']==0){
            
            if($data['birthday']!=null){
            $date = date_create($data['birthday']);
            $formatedDate = $date->format('Y-m-d');
            }
            else{
                $formatedDate = null;
            }
            $query ="insert into USER(login,password,nom,prenom,mail,sexe,birthday,street,zipCode,telephone,city) values(?,?,?,?,?,?,?,?,?,?,?)";
            $statement = $connection->prepare($query);
            $statement->execute([$data['login'],$data['password'],$data['nom'],$data['prenom'],$data['mail'],$data['sexe'],$formatedDate,$data['adresse'],$data['cp'],$data['téléphone'],$data['ville'],]);
            $userID = $statement->fetch(PDO::FETCH_ASSOC);
            $verif ="select id from USER where login=?";
            $statement = $connection->prepare($verif);
            $statement->execute([$data['login']]);
            $id = $statement->fetch(); 
            if(empty($id)){
                $response = array("status"=>"failed","message"=>"insertion impossible");
                echo json_encode($response);
            }
            else{
                $_SESSION['id']=$id['id'];
                $response = array("status"=>"success");
                echo json_encode($response);
            }
        }
        else{
            $response = array("status"=>"failed","message"=>"login déjà utilisé");
                echo json_encode($response);
        } 
        $connection = null;   
    }
    catch(PDOException $error){
        echo json_encode($error->getMessage());
    }
?>