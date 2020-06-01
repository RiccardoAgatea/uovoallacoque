<?php
require_once "./db-connection.php";
require_once "./validation.php";

session_start();

$_SESSION["nome"] = $_POST['nome'];
$_SESSION["tempo"] = $_POST['tempo'];
$_SESSION["difficolta"] = $_POST['difficolta'];
$_SESSION["immagine"] = $_POST['immagine'];
$_SESSION["tipo"] = $_POST['tipo'];
$_SESSION["ingredienti"] = $_POST['ingredienti'];
$_SESSION["procedura"] = $_POST['procedura'];

$_SESSION["errorNome"] = checkAddNomeRicetta("nome");
$_SESSION["errorImg"] = "";
$_SESSION["errorDifficolta"] = checkDifficolta("difficolta");
$_SESSION["errorTempo"] = checkTempo("tempo");

if ($_SESSION["errorNome"] != "" || $_SESSION["errorImg"] != "" || $_SESSION["errorDifficolta"] != "" || $_SESSION["errorTempo"] != "") { 
    $_SESSION["wrong-add"] = true; 
   header("Location: ./add-ricetta.php"); 
    exit;
} else { 
    $connection = new DBConnection();
    $connection->query("INSERT INTO ricette (nome, difficolta, tempo, img, portata, ingredienti, procedimento) VALUES (\"{$_POST['nome']}\",\"{$_POST['difficolta']}\",\"{$_POST['tempo']}\",\"{$_POST['immagine']}\",\"{$_POST['tipo']}\",\"{$_POST['ingredienti']}\",\"{$_POST['procedura']}\");");

    $connection->disconnect();
    $_SESSION["wrong-add"] = false;
    $_SESSION["nome"] = "";
	$_SESSION["tempo"] = "";
	$_SESSION["difficolta"] = "";
	$_SESSION["immagine"] = "";
    $_SESSION["ingredienti"] = "";
    $_SESSION["procedura"] = "";
    $_SESSION["tipo"] = "";
    header("Location: ./utente.php");
    exit;
}
