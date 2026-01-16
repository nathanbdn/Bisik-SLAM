<?php
include "header.php";
$volume = 40;
$dir = "son/";
$files = scandir($dir);
?>




<h1>Ajouter une chorégraphie</h1>

<form action="actions/insertChoregraphie.php" method="post">
    Message: <br><input type="text" required maxlength="50" name="message">
    <br><br>
    mouvement(angle) : <br><input type="int" required name="angle">
    <br><br>
    mouvement(durée) : <br><input type="int" required name="duree">
    <br><br>
    Musique : <br><select name="musique" id="musique" required>
        <option value="">-- Choisir une musique --</option>

        <?php
        foreach ($files as $file) {
            if ($file !== "." && $file !== "..") {
                echo "<option value=\"$file\">$file</option>";
            }
        }
        ?>
    </select>
    <br><br>
    volume : <span id="val"><?= $volume ?></span>%
    <br>
    <input
            type="range"
            min="0"
            max="100"
            value="<?= $volume ?>"
            name="volume"
            oninput="document.getElementById('val').textContent = this.value"
    >
    <br>

    <input type="submit" value="OK">

</form>



