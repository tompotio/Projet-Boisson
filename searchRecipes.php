<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);
try{
    $pdo = new PDO("mysql:host=$servername;dbname=projetBoisson", "root");
    if($data)
}
?>