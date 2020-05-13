<?php

require_once __DIR__. "/db-connection.php";
require_once __DIR__. "/user.php";

session_start();
$connection = new DBConnection();

$idUtente = $_SESSION['user']->getId();
$idRicetta = $_GET['ricetta'];
$testo = $_POST['scrivi-commento'];

$connection->query("INSERT INTO commenti(utente, ricetta, contenuto, dataeora) VALUE($idUtente, $idRicetta, \"$testo\", NOW())");
header("Location: ricetta.php?id=$idRicetta#sezione-commenti");