<?php
require_once "./db-connection.php";
require_once "./user.php";

(new DBConnection())->query("INSERT INTO utenti (email, passw, nickname) VALUES (\"{$_POST['email']}\",\"{$_POST['password1']}\",\"{$_POST['nickname']}\");");

$user = new User($_POST['email']);
$_SESSION['user'] = $user;
header("Location: ./utente.php");
