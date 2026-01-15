
<?php

//on récupère les données du POST
$id=filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

include "../config.php";
$pdo = new PDO('mysql:host=' . config::HOST . ';dbname=' . config::DBNAME
    , config::USER, config::PASSWORD);

//on prépare la requête avec des bindParam pour éviter les injections SQL
$req=$pdo->prepare("delete from choregraphie where id=:id");
$req->bindParam(':id', $id);
$req->execute();

//retour à la page d'accueil
header("Location: ../index.php");