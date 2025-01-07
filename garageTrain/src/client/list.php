<?php
require_once('function_client.php');
$clients = getAllClients();
include('../template/header.php'); 
?>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>email</th>
                <th>télephone</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clients as $client): ?>
                <tr>
                <td><?php echo htmlspecialchars($client['id']); ?></td>
                <td><?php echo htmlspecialchars($client['nom']); ?></td>
                <td><?php echo htmlspecialchars($client['email']); ?></td>
                <td><?php echo htmlspecialchars($client['telephone']); ?></td>
                <td>
                    <a href="edit_client.php?id=<?php echo $client['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="delete_client.php?id=<?php echo $client['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
