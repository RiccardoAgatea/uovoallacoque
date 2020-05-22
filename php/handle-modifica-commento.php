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
$idCommento = $_GET['idcommento'];
$pagina = $_GET['pagina'];
$testo = $_POST['modifica-commento'];

$result = $connection->query("SELECT commenti.utente AS idutente, commenti.ricetta AS idricetta FROM commenti WHERE commenti.id=$idCommento");

if ($result) {
    $row = $result->fetch_assoc();

    if ($row['idutente'] != $_SESSION['user']->getID()) {
        $connection->disconnect();
        header("Location: ../403.php");
        exit;
    }

    if ($row['idricetta'] != $idRicetta) {
        $connection->disconnect();
        header("Location: ../400.php");
        exit;
    }
}

$connection->query("UPDATE commenti SET commenti.contenuto = \"$testo\", commenti.modificato = TRUE WHERE commenti.id=$idCommento");

$connection->disconnect();

header("Location: ricetta.php?id=$idRicetta&pagina=$pagina#sezione-commenti");
