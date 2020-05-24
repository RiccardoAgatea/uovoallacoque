<?php
require_once "./db-connection.php";
require_once "./user.php";
require_once "./validation.php";

session_start();

$_SESSION["email"] = $_POST['email'];
$_SESSION["password"] = $_POST['password1'];
$_SESSION["nickname"] = $_POST['nickname'];

$_SESSION["errorNickname"] = checkNickname("nickname"); 

if ($_SESSION["errorNickname"] !== NULL) {
    $_SESSION["wrong-signup"] = true;
    header("Location: ./signup.php");
    exit;
} else {
    $connection = new DBConnection();
    $connection->query("INSERT INTO utenti (email, passw, nickname) VALUES (\"{$_POST['email']}\",\"{$_POST['password1']}\",\"{$_POST['nickname']}\");");

    $user = new User($_POST['email']);
    $_SESSION['user'] = $user;
    $_SESSION["wrong-signup"] = false;
    $_SESSION["email"] = "";
    $_SESSION["password"] = "";
    $_SESSION["nickname"] = "";
    $connection->disconnect();
    header("Location: ./utente.php");
    exit;
}
