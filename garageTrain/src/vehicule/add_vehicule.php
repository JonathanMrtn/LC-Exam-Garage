<?php
$error = 0;
$errorMessage = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $annee = $_POST['annee'];
    $couleur = $_POST['couleur'];
    $kilometrage = $_POST['kilometrage'];
    $immatriculation = $_POST['immatriculation'];
    $detail = $_POST['detail'];
    $client_id = $_POST['client'];


    require_once('function_vehicule.php');
    $createVehicule = createVehicule($marque, $modele, $annee, $couleur, $kilometrage, $immatriculation, $detail, $client_id);
    if ($createVehicule) {
        header("Location: ../home/dashboard.php");
    } else {
        $error++;
        $errorMessage[] = "Erreur lors de l'ajout du véhicule";
    }
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
        <h1 class="mt-5">Ajouter un Véhicule</h1>
        <form action="add_vehicule.php" method="POST" class="mt-4">
            <div class="form-group">
                <label for="marque">Marque:</label>
                <input type="text" id="marque" name="marque" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="modele">Modèle:</label>
                <input type="text" id="modele" name="modele" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="annee">Année:</label>
                <input type="number" id="annee" name="annee" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="couleur">Couleur:</label>
                <select id="couleur" name="couleur" class="form-control" required>
                    <option value="Rouge">Rouge &#128308;</option>
                    <option value="Bleu">Bleu &#128309;</option>
                    <option value="Vert">Vert &#128994;</option>
                    <option value="Jaune">Jaune &#128993;</option>
                    <option value="Blanc">Blanc &#9898;</option>
                    <option value="Noir">Noir &#9899;</option>
                    <option value="Orange">Orange &#128992;</option>
                </select>
            </div>
            <div class="form-group">
                <label for="immatriculation">Immatriculation:</label>
                <input type="text" id="immatriculation" name="immatriculation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kilometrage">Kilométrage:</label>
                <input type="number" id="kilometrage" name="kilometrage" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="client">Client:</label>
                <select id="client" name="client" class="form-control" required>
                    <?php
                    require_once('../client/function_client.php');
                    $clients = getAllClients();
                    foreach ($clients as $client) {
                        $selected = $client['id'] == $vehicule['client_id'] ? 'selected' : '';
                        echo "<option value='{$client['id']}' {$selected}>{$client['nom']} {$client['prenom']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="detail">Détail:</label>
                <textarea id="detail" name="detail" class="form-control" maxlength="255" required></textarea>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Ajouter Véhicule</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</main>
</body>
</html>