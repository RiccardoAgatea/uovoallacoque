<?php
require_once "./db-connection.php";
require_once "./user.php";
require_once "./validation.php";

session_start();

$_SESSION["email"] = $_POST['email'];
$_SESSION["password"] = $_POST['password1'];
$_SESSION["nickname"] = $_POST['nickname'];

$_SESSION["errorNickname"] = checkNickname("nickname"); //richiamo della funzione in validation.php
$_SESSION["errorEmail"] = checkEmail("email");
$_SESSION["errorPassword"] = comparePassword("password1", "password2");

if ($_SESSION["errorNickname"] !== "" || $_SESSION["errorEmail"] !== "" || $_SESSION["errorPassword"]) { //c'è almeno un errore
    $_SESSION["wrong-signup"] = true; //qualcosa è andato storto
    header("Location: ./signup.php"); //rimango nella pagina di signup
    exit;
} else { //non c'è nessun errore
    $connection = new DBConnection();
    $connection->query("INSERT INTO utenti (email, passw, nickname) VALUES (\"{$_POST['email']}\",\"{$_POST['password1']}\",\"{$_POST['nickname']}\");");

    $user = new User($_POST['nickname']);
    $_SESSION['user'] = $user;
    $_SESSION["logged"] = true;
    $_SESSION["wrong-signup"] = false;
    $_SESSION["email"] = "";
    $_SESSION["password"] = "";
    $_SESSION["nickname"] = "";
    $connection->disconnect();
    header("Location: ./utente.php");
    exit;
}
