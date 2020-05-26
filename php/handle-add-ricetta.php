<?php
require_once "./db-connection.php";
require_once "./validation.php";

session_start();
$_SESSION["error"] = "";

if ($_SESSION["error"] !== "" ) { 
    $_SESSION["wrong-add"] = true; 
   header("Location: ./add-ricetta.php"); 
    exit;
} else { 
    $connection = new DBConnection();
    $connection->query("INSERT INTO ricette (nome, difficolta, tempo, img, portata, ingredienti, procedimento) VALUES (\"{$_POST['nome']}\",\"{$_POST['difficolta']}\",\"{$_POST['tempo']}\",\"{$_POST['immagine']}\",\"1\",\"{$_POST['ingredienti']}\",\"{$_POST['procedura']}\");");

    $_SESSION["wrong-add"] = false;
    $connection->disconnect();
    header("Location: ./utente.php");
    exit;
}
