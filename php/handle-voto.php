<?php 
require_once "./db-connection.php";
require_once "./user.php";

session_start();

if (!key_exists("user", $_SESSION)) {
    header("Location: ../401.php");
    exit;
}
$connection = new DBConnection();

$idUtente = $_SESSION['user']->getId();
$idRicetta = $_GET['ricetta'];
$voto = intval($_POST['pulsante-voto']);

$contaRicette = $connection->query("SELECT COUNT(*) FROM ricette WHERE id=$idRicetta")->fetch_row()[0];

if (intval($contaRicette) == 0) {
    $connection->disconnect();
    header("Location: ../404.php");
    exit;
}
$queryVoto = $connection->query("SELECT voto FROM voti WHERE voti.utente={$idUtente} AND voti.ricetta=$idRicetta");
if($queryVoto && $queryVoto->num_rows!=0) {
    $connection->disconnect();
    header("Location: ../400.php");
    exit;
}

$connection->query("INSERT INTO voti (utente, ricetta, voto) VALUES($idUtente, $idRicetta, $voto)");
$connection->disconnect();
header("Location: ./ricetta.php?id=$idRicetta&pagina=1");
exit;

