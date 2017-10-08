<?php
require_once('includes/start.inc.php');
include_once('includes/header.inc.php');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header('Location: index.php');
}

if (!isset($_SESSION['creating']) || $_SESSION['creating'] == false) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if (($userdb = $db->read('user', $_POST['email'], 'email')->fetch()) === false) {
            $_SESSION['creating'] = true;
            $_SESSION['data'] = ['email' => $_POST['email'], 'password' => hash('sha256', $_POST['password'])];
        } else {
            $user = new user($userdb);
            if ($user->active) {
                if (hash('sha256', $_POST['password']) == $user->password) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = $user;
                    if (isset($_SESSION['attempts'])) {
                        unset($_SESSION['attempts']);
                    }
                    header('Location: index.php');
                } else {
                    $message = urlencode('Le mot de passe est erroné.');
                    if ($_SESSION['attempts']) {
                        if ($_SESSION['attempts'] < 3) {
                            $_SESSION['attempts']++;
                        } else {
                            $_SESSION['blocked'] = time() + 300;
                        }
                    } else {
                        $_SESSION['attempts'] = 1;
                    }
                    header('Location: login.php?notif=' . $message);
                }
            } else {
                $message = urlencode('Votre compte n\'a pas encore été validé !');
                header('Location: login.php?notif=' . $message);
            }
        }
    }
} else if (isset($_POST['confirm-pw'])) {
    if (hash('sha256', $_POST['confirm-pw']) == $_SESSION['data']['password']) {
        user::create($_SESSION['data']['email'], $_SESSION['data']['password'], $_POST['lastname'], $_POST['firstname']);
        $_SESSION['creating'] = false;
        $message = urlencode('Vous avez bien créé votre compte, il doit maintenant être validé par un administrateur !');
        header('Location: login.php?notif=' . $message);
    }
}
?>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-6">
            <form method="post" id="content">
                <?php
                if (!isset($_SESSION['creating']) || $_SESSION['creati:ng'] == false) {
                    ?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                               placeholder="adresse@serveur.ext" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Mot de passe" required>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="form-group">
                        <label for="confirm-pw">Confirmez le mot de passe</label>
                        <input type="password" class="form-control" id="confirm-pw" name="confirm-pw" placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Prénom">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nom de famille</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Nom de famille">
                    </div>
                    <?php
                }
                ?>
                <button type="submit" class="btn btn-primary">S'inscrire / Se connecter</button>
            </form>
        </div>
    </div>
</div>
