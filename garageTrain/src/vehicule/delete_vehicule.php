<?php
$error = 0;
$errorMessage = [];
require_once('function_vehicule.php');

if ($_GET['id']) {
    $vehicule = getVehiculeById($_GET['id']);
    if (!$vehicule) {
        $error++;
        $errorMessage[] = "Véhicule introuvable";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $deleteVehicule = deleteVehicule($_GET['id']);
        if ($deleteVehicule) {
            header("Location: ../home/dashboard.php");
        } else {
            $error++;
            $errorMessage[] = "Erreur lors de l'ajout du véhicule";
        }
    }
}
else
{
    $error++;
    $errorMessage[] = "Véhicule introuvable";
}
include('../template/header.php'); 
?>
<main>
    <div class="container">
        <?php
            if($error)
            {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= implode('<br>- ', $errorMessage) ?>
                </div>
                <?php
            }
        ?>
        <h2 class="mt-5">Supprimer le Véhicule</h2>
        <?php if ($vehicule): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($vehicule['marque']) ?> <?= htmlspecialchars($vehicule['modele']) ?></h5>
                    <p class="card-text">
                        <strong>Immatriculation:</strong> <?= htmlspecialchars($vehicule['immatriculation']) ?><br>
                        <strong>Couleur:</strong> <?= htmlspecialchars($vehicule['couleur']) ?><br>
                        <strong>Année:</strong> <?= htmlspecialchars($vehicule['annee']) ?><br>
                    </p>
                </div>
            </div>
        <?php endif; ?>
        <p>Êtes-vous sûr de vouloir supprimer ce véhicule ? Cette action est irréversible.</p>
        <form action="delete_vehicule.php?id=<?= $_GET['id'] ?>" method="POST" class="mt-4">
            <button type="submit" class="btn btn-danger">Confirmer</button>
            <a href="../home/dashboard.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</main>
</body>
</html>