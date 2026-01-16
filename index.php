<?php
include "header.php";
?>
    <h1>Chorégraphie :</h1>
    <?php
    include "config.php";
    $pdo  = new PDO("mysql:host=".config::HOST.";dbname=".config::DBNAME, config::USER, config::PASSWORD);
    $req = $pdo->prepare("select * from choregraphie");
    $req -> execute();
    $choregraphies = $req -> fetchAll();
    ?>
<div class="row">
    <?php foreach ($choregraphies as $choregraphie) : ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlentities($choregraphie["message"]) ?></h5>
                    <p class="card-text">
                        <strong>Durée :</strong> <?= $choregraphie["mouvement_duree"] ?> s<br>
                        <strong>Angle :</strong> <?= $choregraphie["mouvement_angle"] ?>°<br>
                        <?php if (!empty($choregraphie['musique'])): ?>
                    <p class="card-text mb-2">
                        <strong>Son :</strong> <?= htmlspecialchars($choregraphie['musique']) ?>
                    </p>
                    <audio controls class="w-100 mb-2">
                        <source src="son/<?= htmlspecialchars($choregraphie['musique']) ?>" type="audio/mpeg">
                    </audio>
                    <?php endif; ?>
                        <strong>Volume :</strong> <?= $choregraphie["volume"] ?>%
                    </p>
                </div>
                <div class="card-footer text-center">
                    <a href="modifierChoregraphie.php?id=<?= $choregraphie["id"] ?>" class="btn btn-sm btn-warning me-2">Modifier</a>
                    <a href="supprimerChoregraphie.php?id=<?= $choregraphie["id"] ?>" class="btn btn-sm btn-danger">Supprimer</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<a href="ajouterChoregraphie.php" class="btn btn-success mt-3">Ajouter une chorégraphie</a>


</body>
</html>


