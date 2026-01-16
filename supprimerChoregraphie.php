<?php
include "header.php";
// on récupère l'id
$id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
include "config.php";
$pdo  = new PDO("mysql:host=".config::HOST.";dbname=".config::DBNAME, config::USER, config::PASSWORD);

$req=$pdo->prepare("select * from choregraphie where id=:id");
$req->bindParam('id', $id);
$req->execute();
$choregraphies=$req->fetchAll();

if(count($choregraphies)!=1){
    http_response_code(404);
    die("pas de catégorie pour l'id ".$id);
}
$choregraphies = $choregraphies[0]
?>

<h1>Êtes-vous sûr de supprimer cette catégorie</h1>
<form action="actions/deleteChoregraphie.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>" />
    <p>êtes-vous sur de vouloir supprimer cette ligne</p>
    <input type="submit" value="OK">

</form>
<form action="index.php">
    <input type="submit" value="NO">
</form>

