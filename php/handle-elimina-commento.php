<?php
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";

session_start();
$connection = new DBConnection();

if (!key_exists("user", $_SESSION)) {
    header("Location: ../401.php");
}

$idRicetta = $_GET['ricetta'];
$idCommento = $_GET['idcommento'];

$result = $connection->query("SELECT commenti.utente AS idutente, commenti.ricetta AS idricetta FROM commenti WHERE commenti.id=$idCommento");

if ($result) {
    $row = $result->fetch_assoc();

    if ($row['idutente'] != $_SESSION['user']->getID() && !$_SESSION['user']->getAdmin()) {
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

$connection->query("DELETE FROM commenti WHERE commenti.id=$idCommento");

$connection->disconnect();

header("Location: ricetta.php?id=$idRicetta&pagina=1#sezione-commenti");
