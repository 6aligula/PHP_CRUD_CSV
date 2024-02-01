<?php
require_once "./clases/Cartera.php";
require_once "./clases/Empresa.php"; 

$cartera = new Cartera();

$id = isset($_GET['id']) ? $_GET['id'] : null;
echo $id;
$client = $cartera->getClient($id);
echo $client;



if (count($_POST) > 0) {
    $cartera->update($_POST);
    header("location: index.php");
}