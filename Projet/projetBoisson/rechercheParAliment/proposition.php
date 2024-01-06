<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);
require_once("../../Identifiant/identifiantSQL.inc.php");
$connection = new PDO("mysql:host=$servername;dbname=$dataBase;charset=utf8mb4", $username,$password);
$request = "select product_name from PRODUCTS where product_name like '" .$data['search']."%'";
$stmt = $connection->query($request);
$data = $stmt->fetchAll();
$connection = null;
echo(json_encode($data));
?>