<?php
session_start();
if (!isset($_SESSION['token'])) {
    header('Location: ../auth/login.php');
    exit();
}
require_once('../../database/db.php');
$conn = connectDB();

$result = $conn->query("SELECT COUNT(*) AS total_clients FROM clients");
$row = $result->fetch_assoc();
$totalClients = $row['total_clients'];

$result = $conn->query("SELECT COUNT(*) AS total_vehicules FROM vehicules");
$row = $result->fetch_assoc();
$totalVehicules = $row['total_vehicules'];

$result = $conn->query("SELECT COUNT(*) AS total_rendezvous FROM rendezvous");
$row = $result->fetch_assoc();
$totalRendezvous = $row['total_rendezvous'];
?>

<?php include('../template/header.php'); ?>
    <main>
        <div class="container mt-5">
            <h1 class="text-center mb-4">Tableau de Bord Garage Train</h1>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Clients</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Clients</h5>
                            <p class="card-text"><?= $totalClients ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Véhicules</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Véhicules</h5>
                            <p class="card-text"><?= $totalVehicules ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header">Rendez-vous</div>
                        <div class="card-body">
                            <h5 class="card-title">Total Rendez-vous</h5>
                            <p class="card-text"><?= $totalRendezvous ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <h2 class="text-center mb-4">Liste des Véhicules</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Année</th>
                        <th>Couleur</th>
                        <th>Immatriculation</th>
                        <th>Kilométrage</th>
                        <th>Détails</th>
                        <th>Propriétaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM vehicules");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['marque'] . "</td>";
                        echo "<td>" . $row['modele'] . "</td>";
                        echo "<td>" . $row['annee'] . "</td>";
                        echo "<td>" . $row['couleur'] . "</td>";
                        $colorMapping = [
                            'Rouge' => 'Rouge &#128308;',
                            'Bleu' => 'Bleu &#128309;',
                            'Vert' => 'Vert &#128994;',
                            'Jaune' => 'Jaune &#128993;',
                            'Blanc' => 'Blanc &#9898;',
                            'Noir' => 'Noir &#9899;',
                            'Orange' => 'Orange &#128992;'
                        ];
                        $couleur = $row['couleur'];
                        echo "<td>" . (isset($colorMapping[$couleur]) ? $colorMapping[$couleur] : $couleur) . "</td>";
                        echo "<td>" . $row['immatriculation'] . "</td>";
                        echo "<td>" . number_format($row['kilometrage'], 0, ",", ".") . "</td>";
                        if (!empty($row['detail'])) {
                            $detail = $row['detail'];
                            if (strlen($detail) > 23) {
                                $detail = substr($detail, 0, 20) . '...';
                            }
                        } else {
                            $detail = 'Aucun détail';
                        }
                        echo "<td>" . $detail . "</td>";
                        $client = $conn->query("SELECT * FROM clients WHERE id = " . $row['client_id'])->fetch_assoc();
                        echo "<td>" . $client['nom'] . " (" . $client['email'] . ")</td>";

                        echo "<td>
                                <a href='../vehicule/edit_vehicule.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Modifier</a>
                                <a href='../vehicule/delete_vehicule.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="../vehicule/add_vehicule.php" class="btn btn-primary">Ajouter un Véhicule</a>
        </div>
    </main>
</body>
</html>
