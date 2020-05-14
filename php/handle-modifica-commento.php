<?php

require_once __DIR__. "/db-connection.php";
require_once __DIR__. "/user.php";

session_start();
$connection = new DBConnection();

$idUtente = $_SESSION['user']->getId();
$idRicetta = $_GET['ricetta'];
$idCommento = $_GET['idcommento'];
$pagina = $_GET['pagina'];
$testo = $_POST['modifica-commento'];

$connection->query("UPDATE commenti SET commenti.contenuto = \"$testo\", commenti.modificato = TRUE WHERE commenti.id=$idCommento");
header("Location: ricetta.php?id=$idRicetta&pagina=$pagina#sezione-commenti");