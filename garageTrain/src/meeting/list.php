<?php
require_once('function_meeting.php');
$meetings = getAllMeetings();
include('../template/header.php'); 
?>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Date & Heure</th>
                <th>véhicule</th>
                <th>descritpion</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($meetings as $meeting): ?>
                <tr>
                <td><?php echo htmlspecialchars($meeting['id']); ?></td>
                <td><?php echo htmlspecialchars($meeting['date_heure']); ?></td>
                <?php
                require_once('../vehicule/function_vehicule.php');
                $vehicule = getVehiculeById($meeting['vehicule_id']);
                ?>
                <td><?php echo htmlspecialchars($vehicule['marque'] . ' ' . $vehicule['modele']); ?></td>
                <td><?php echo htmlspecialchars($meeting['description']); ?></td>
                <td>
                    <a href="edit_meeting.php?id=<?php echo $meeting['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="delete_meeting.php?id=<?php echo $meeting['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
