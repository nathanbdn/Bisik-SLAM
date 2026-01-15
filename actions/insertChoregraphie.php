<?php


//on récupère les données du POST
$message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);
$angle = filter_input(INPUT_POST, 'angle', FILTER_VALIDATE_INT);
$duree = filter_input(INPUT_POST, 'duree', FILTER_VALIDATE_INT);
$musique = filter_input(INPUT_POST, 'musique', FILTER_DEFAULT);

include "../config.php";
$pdo = new PDO('mysql:host=' . config::HOST . ';dbname=' . config::DBNAME
    , config::USER, config::PASSWORD);

//on prépare la requête avec des bindParam pour éviter les injections SQL
$req=$pdo->prepare("INSERT INTO choregraphie (message, mouvement_angle, mouvement_duree, musique) VALUES (:message, :angle, :duree, :musique)");
$req->bindParam(':message', $message);
$req->bindParam(':angle', $angle);
$req->bindParam(':duree', $duree);
$req->bindParam(':musique', $musique);

$req->execute();

//retour à la page d'accueil
header("Location: ../index.php");