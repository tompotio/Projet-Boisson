<?php
$input_data = file_get_contents("php://input");
$data = json_decode($input_data, true);
require_once("../../Identifiant/identifiantSQL.inc.php");
$connection = new PDO("mysql:host=$servername;dbname=$dataBase", $username,$password);
$request = "select product_name from products where product_name like '" .$data['search']."%'";
$stmt = $connection->query($request);
$data = $stmt->fetchAll();
echo(json_encode($data));
?>