<?php
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";
session_start();

if (!key_exists("logged", $_SESSION) || !$_SESSION["logged"]) {
    header("Location: ../401.php");
    exit;
}
if (!$_SESSION["user"]->getAdmin()) {
    header("Location: ../403.php");
    exit;
}

$filePattern = "../img/ricette/" . $_GET['removeId'] . ".*";
array_map("unlink", glob($filePattern));

$removeId = intval($_GET['removeId']);
$connection = new DBConnection();
$connection->query(" DELETE FROM ricette WHERE ricette.id=\"{$removeId}\" ");	
$connection->disconnect();
$portata = $_GET['portata'];
header("Location: ./elenco.php?id=$portata");
exit;