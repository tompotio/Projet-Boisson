<?php
session_start();
session_destroy();
$_SESSION['id']=null;

// Récupérer l'ancienne URL
$ancienneUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;

// Récupérer les paramètres GET actuels
$parametresGet = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

// Ajouter les paramètres GET à l'ancienne URL
$ancienneUrlAvecGet = $ancienneUrl . ($parametresGet ? '?' . $parametresGet : '');

// Afficher l'ancienne URL avec les paramètres GET
echo "Ancienne URL avec GET : " . $ancienneUrlAvecGet;
header("location:$ancienneUrlAvecGet");

?>