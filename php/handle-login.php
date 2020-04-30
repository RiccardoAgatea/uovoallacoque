<?php
require_once __DIR__ . "/user.php";

session_start();

$user = new User($_POST['email']);

if ($user->getPassword() != $_POST['password']) {
    echo "Fucked up!";
} else {
    $_SESSION["logged"] = true;
    $_SESSION['user'] = $user;
    header("Location: ./utente.php");
}
