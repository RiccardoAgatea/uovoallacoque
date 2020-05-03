<?php
require_once "./db-connection.php";
require_once "./user.php";

session_start();

$connection = new DBConnection();

if ($connection->query("SELECT email FROM utenti WHERE email=\"{$_POST['email']}\"")->fetch_row() != null) {
    $_SESSION["wrong-signup"] = true;
    $_SESSION["error"] = "email";
    $_SESSION["email"] = $_POST['email'];
    $_SESSION["password"] = $_POST['password1'];
    $_SESSION["nickname"] = $_POST['nickname'];
    header("Location: ./signup.php");
} else if ($connection->query("SELECT nickname FROM utenti WHERE nickname=\"{$_POST['nickname']}\"")->fetch_row() != null) {
    $_SESSION["wrong-signup"] = true;
    $_SESSION["error"] = "nickname";
    $_SESSION["email"] = $_POST['email'];
    $_SESSION["password"] = $_POST['password1'];
    $_SESSION["nickname"] = $_POST['nickname'];
    header("Location: ./signup.php");
} else {
    (new DBConnection())->query("INSERT INTO utenti (email, passw, nickname) VALUES (\"{$_POST['email']}\",\"{$_POST['password1']}\",\"{$_POST['nickname']}\");");

    $user = new User($_POST['email']);
    $_SESSION['user'] = $user;
    $_SESSION["wrong-signup"] = false;
    $_SESSION["error"] = "";
    $_SESSION["email"] = "";
    $_SESSION["password"] = "";
    $_SESSION["nickname"] = "";
    header("Location: ./utente.php");
}
