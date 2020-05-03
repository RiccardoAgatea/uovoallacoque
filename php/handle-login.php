<?php
require_once __DIR__ . "/user.php";

session_start();

try {
    $user = new User($_POST['email']);

    if ($user->getPassword() != $_POST['password']) {
        throw new Exception("Wrong password", 1);
    } else {
        $_SESSION["logged"] = true;
        $_SESSION['user'] = $user;
        $_SESSION["wrong-login"] = false;
        $_SESSION["email"] = "";
        $_SESSION["password"] = "";
        header("Location: ./utente.php");
    }
} catch (Exception $e) {
    $_SESSION["logged"] = false;
    $_SESSION["wrong-login"] = true;
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["password"] = $_POST["password"];
    header("Location: ./login.php");
}
