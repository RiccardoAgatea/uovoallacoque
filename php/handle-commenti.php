<?php

require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";

session_start();
$connection = new DBConnection();

if (!key_exists("user", $_SESSION)) {
    header("Location: ../401.php");
    exit;
}

$idUtente = $_SESSION['user']->getId();
$idRicetta = $_GET['ricetta'];
$testo = $_POST['scrivi-commento'];

$contaRicette = $connection->query("SELECT COUNT(*) FROM ricette WHERE id=$idRicetta")->fetch_row()[0];

if (intval($contaRicette) == 0) {
    header("Location: ../404.php");
    exit;
}

$connection->query("INSERT INTO commenti(utente, ricetta, contenuto, dataeora) VALUE($idUtente, $idRicetta, \"$testo\", NOW())");

$connection->disconnect();

header("Location: ricetta.php?id=$idRicetta&pagina=1#sezione-commenti");
