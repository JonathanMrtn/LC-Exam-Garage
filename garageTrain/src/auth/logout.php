<?php
$error = 0;
$errrorMessage = [];
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_logout']) && $_POST['confirm_logout'] === 'yes') {
    if (!empty($_SESSION['token'])) {
        require_once('../../security/connexion.php');
        if (isTokenValid($_SESSION['token'])) {
            $_SESSION['token'] = NULL;
            session_destroy();
            header("Location: ../../index.php");
            exit();
        }
    }
    else
    {
        session_destroy();
        header("Location: ../../index.php");
        exit();
    }
}
include('../template/header.php');
?>
    <div class="container mt-5">
        <h1 class="text-center">Êtes-vous sûr de vouloir vous déconnecter ?</h1>
        <form method="post" action="logout.php" class="text-center">
            <input type="hidden" name="confirm_logout" value="yes">
            <button type="submit" class="btn btn-danger">Oui, Déconnexion</button>
            <a href="/index.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>