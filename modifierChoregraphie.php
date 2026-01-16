<?php

include "header.php";
$dir = "son/";
$files = scandir($dir);
$extensions = ['mp3','wav','ogg'];

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

    Message: <br><input value = "<?php echo htmlentities($choregraphies["message"])?>" type="text" required maxlength="50" name="message">
    <br><br>
    mouvement(angle) : <input value = "<?php echo htmlentities($choregraphies["mouvement_angle"])?>" type="number" required name="angle">
    <br><br>
    Description(durée) : <input value = "<?php echo htmlentities($choregraphies["mouvement_duree"])?>" type="number" required name="duree">
    <br><br>
    volume : <input value = "<?php echo htmlentities($choregraphies["volume"])?>" type="number" required name="volume">
    <br><br>
    Musique :<br>
    <select name="musique" required>
        <option value="">-- Choisir une musique --</option>
        <?php
        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), $extensions)) {
                $selected = ($file == $choregraphies['musique']) ? "selected" : "";
                echo "<option value=\"$file\" $selected>$file</option>";
            }
        }
        ?>
    </select>
    <br><br>
    <input type="submit" value="OK">

</form>


