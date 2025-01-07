<?php
session_start();
require_once('../../security/connexion.php');
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['token'];
$error = 0;
$errrorMessage = [];
$login = isset($_GET['login']) ? $_GET['login'] : false;
$register = isset($_GET['register']) ? $_GET['register'] : false;

if ($login)
{
    if (!empty($_SESSION['token']))
    {
        if(isTokenValid($_SESSION['token'])){
            header("Location: ../home/dashboard.php?token=" .$csrfToken); 
        }
    }
    else
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
    
        if($requestMethod == 'GET' && $_GET['login'] == "true")
        {
            if(isset($_GET['mail']) && isset($_GET['pass'])){
                $logUser = loginWithToken($_GET['mail'], $_GET['pass']);
                if($logUser){
                    $_SESSION['token'] = $logUser;
                    header("Location: ../home/dashboard.php?token=" .$csrfToken); 
                }
                else{
                    $error = "Connexion impossible, utilisateur non-authentifié";
                }
            }
            else {
                $error = "Un champ de connexion manquant";
            }
        }
    }
}
elseif($register)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['mail'];
        $password = $_POST['pass'];
        $confirmPassword = $_POST['confirm_pass'];
        // var_dump($username, $password, $confirmPassword);exit;
        if ($password !== $confirmPassword) {
            $error++;
            $errrorMessage[] = "Les mots de passe ne correspondent pas.";
        } else {
            require_once('../../security/connexion.php');
            $registerUser = register($username, $password);
            if ($registerUser) {
                $_SESSION['token'] = $registerUser;
                header("Location: ../home/dashboard.php");
            } else {
                $error++;
                $errrorMessage[] = "Inscription impossible, veuillez réessayer.";
            }
        }
    }
}
include('../template/header.php'); 
?>
<main>
    <div class="container-fluid">
        <?php
            if($error)
            {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= implode('<br>- ', $errrorMessage) ?>
                </div>
                <?php
            }
        ?>
        <div class="row mh-100vh">
            <div class="col-10 col-sm-8 col-md-6 col-lg-6 offset-1 offset-sm-2 offset-md-3 offset-lg-0 align-self-center d-lg-flex align-items-lg-center align-self-lg-stretch bg-white p-5 rounded rounded-lg-0 my-5 my-lg-0" id="login-block">
                <div class="m-auto w-lg-75 w-xl-50">
                    <h2 class="text-info fw-light mb-5"><i class="fa fa-car"></i>&nbsp;Garage Train</h2>
                    <form method="<?= $register ? 'POST' : 'GET' ?>">
                        <?php 
                        if (!$register)
                        {
                            ?>
                                <div class="form-group mb-3"><label class="form-label text-secondary">Utilisateur</label><input class="form-control" type="text" required="" name="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,15}$" inputmode="email"></div>
                                <div class="form-group mb-3"><label class="form-label text-secondary">Mot de passe</label><input class="form-control" type="password" name="pass" required=""></div>
                                <button class="btn btn-info mt-2" name="login" type="submit" value="true">Connexion</button>
                                <button class="btn btn-secondary mt-2" type="button" onclick="window.location.href='login.php?register=true'">Créer un compte</button>
                            <?php
                        }
                        else
                        {
                            ?>
                                <input type="hidden" name="register" value="true">
                                <div class="form-group mb-3"><label class="form-label text-secondary">Utilisateur</label><input class="form-control" type="text" required="" name="mail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,15}$" inputmode="email"></div>
                                <div class="form-group mb-3"><label class="form-label text-secondary">Mot de passe</label><input class="form-control" type="password" name="pass" required=""></div>
                                <div class="form-group mb-3"><label class="form-label text-secondary">Confirmer le mot de passe</label><input class="form-control" type="password" name="confirm_pass" required=""></div>
                                <button class="btn btn-info mt-2" name="register" type="submit">S'inscrire</button>
                            <?php
                        }
                        ?>
                    </form>
                    <p class="mt-3 mb-0"></p>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-end" id="bg-block" style="background-image: url(&quot;https://images.assetsdelivery.com/compings_v2/auxins/auxins2302/auxins230200611.jpg&quot;);background-size: cover;background-position: center center;">
                <p class="ms-auto small text-dark mb-2"><em>Photo by Auxin Nopparat / auxins<br></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</main>
</body>

</html>