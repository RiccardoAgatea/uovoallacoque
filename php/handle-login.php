<?php
require_once "./user.php";

$user = new User($_POST['email']);

if ($user->getPassword() != $_POST['password']) {
    echo "Fucked up!";
} else {
    $_SESSION['user'] = $user;
    header("Location: ./utente.php");
}
