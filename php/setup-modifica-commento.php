<?php
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";

session_start();

$idRicetta = $_GET['ricetta'];
$idCommento = $_GET['idcommento'];
$pagina = $_GET['pagina'];

header("Location: ricetta.php?id=$idRicetta&pagina=$pagina&idcommento=$idCommento#sezione-commenti");
