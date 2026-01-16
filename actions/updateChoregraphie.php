<?php
//récupère les données du post
$message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);
$angle = filter_input(INPUT_POST, 'angle', FILTER_VALIDATE_INT);
$duree = filter_input(INPUT_POST, 'duree', FILTER_VALIDATE_INT);
$musique = filter_input(INPUT_POST, 'musique', FILTER_DEFAULT);
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$volume = filter_input(INPUT_POST,'volume',FILTER_DEFAULT);
include "../config.php";
$pdo = new PDO("mysql:host=" . config::HOST . ";dbname=" . config::DBNAME, config::USER, config::PASSWORD);
$req = $pdo->prepare("update choregraphie set message =:message, mouvement_angle = :angle, mouvement_duree = :duree, musique = :musique, volume = :volume   where id=:id");
$req->bindParam(':message', $message);
$req->bindParam(':angle', $angle);
$req->bindParam(':duree', $duree);
$req->bindParam(':musique', $musique);
$req->bindParam(':id', $id);
$req->bindParam(':volume', $volume);
$req->execute();

header("Location: ../index.php");
