<?php



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

<h1>Modifier une catégorie</h1>
<form action="actions/updateChoregraphie.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id ?>">

    Message: <input value = "<?php echo htmlentities($choregraphies["message"])?>" type="text" required maxlength="50" name="message">
    <br>
    mouvement(angle) : <input value = "<?php echo htmlentities($choregraphies["mouvement_angle"])?>" type="number" required name="angle">
    <br>
    Description(durée) : <input value = "<?php echo htmlentities($choregraphies["mouvement_duree"])?>" type="number" required name="duree">
    <br>
    Musique : <br>
    <textarea name="musique">"<?php echo htmlentities($choregraphies["musique"])?>"</textarea>


    <input type="submit" value="OK">

</form>


