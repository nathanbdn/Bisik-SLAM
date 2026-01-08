<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>menu de config de Bisik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"></script>
</head>
<body>
    <h1>Chorégraphie :</h1>
    <?php
    include "config.php";
    $pdo  = new PDO("mysql:host=".config::HOST.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
    $req = $pdo->prepare("select * from choregraphie");
    $req -> execute();
    $categories = $req -> fetchAll();
    ?>
    <table class="table table-stripped">
        <tr>
            <th>id</th>
            <th>message</th>
            <th>duree_mouvement</th>
            <th>angle_mouvement</th>
            <th>musique</th>
        </tr>
    <?php
    foreach ($categories as $categorie) {
        ?>
        <tr>
            <td><?php echo $categorie["id"]?></td>
            <td><?php echo $categorie["message"]?></td>
            <td><?php echo $categorie["mouvement_duree"]?></td>
            <td><?php echo $categorie["mouvement_angle"]?></td>
            <td><?php echo $categorie["musique"]?></td>
            <td>
                <a href="modifierCategorie.php?id=<?php echo $categorie["id"] ?>">Modifier</a>
                <a href="supprimerCategorie.php?id=<?php echo $categorie["id"] ?>">Supprimer</a>
            </td>
        </tr>
        <?php
    }
    ?>

    </table>
    <a href="ajouterCategorie.php" class="btn btn">Ajouter</a>

</body>
</html>


