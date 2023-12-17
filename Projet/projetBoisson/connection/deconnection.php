<?php
session_start();
$_SESSION['id']=null;
header('Location: http://localhost/tree.php');
?>