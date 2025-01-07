<?php
require_once('function_vehicule.php');
require_once('../client/function_client.php');
$vehicules = getVehicules();
include('../template/header.php'); 
?>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Année</th>
                <th>Kilométrage</th>
                <th>Immatriculation</th>
                <th>Couleur</th>
                <th>Détails</th>
                <th>Propriétaire</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($vehicules as $vehicule): ?>
                <tr>
                <td><?php echo htmlspecialchars($vehicule['id']); ?></td>
                <td><?php echo htmlspecialchars($vehicule['marque']); ?></td>
                <td><?php echo htmlspecialchars($vehicule['modele']); ?></td>
                <td><?php echo htmlspecialchars($vehicule['annee']); ?></td>
                <td><?php echo htmlspecialchars($vehicule['kilometrage']); ?></td>
                <td><?php echo htmlspecialchars($vehicule['immatriculation']); ?></td>
                <td><?php echo htmlspecialchars($vehicule['couleur']); ?></td>
                <td>
                <?php 
                if (!empty($vehicule['detail'])) {
                    echo htmlspecialchars($vehicule['detail']);
                } else {
                    echo 'Aucun détail';
                }
                ?>
                </td>
                <td>
                    <?php 
                    $client = getClientById($vehicule['client_id']); 
                    echo htmlspecialchars($client['nom']) . ' (' . htmlspecialchars($client['email'] . ')'); 
                    ?>
                </td>
                <td>
                    <a href="edit_vehicule.php?id=<?php echo $vehicule['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="delete_vehicule.php?id=<?php echo $vehicule['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
