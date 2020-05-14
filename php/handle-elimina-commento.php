<?php
require_once __DIR__. "/db-connection.php";
require_once __DIR__. "/user.php";

session_start();
$connection = new DBConnection();

$idRicetta = $_GET['ricetta'];
$idCommento = $_GET['idcommento'];

$connection->query("DELETE FROM commenti WHERE commenti.id=$idCommento");
header("Location: ricetta.php?id=$idRicetta&pagina=1#sezione-commenti");