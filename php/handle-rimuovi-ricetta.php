<?php
require_once __DIR__ . "/db-connection.php";

$removeId = intval($_GET['removeId']);
$connection = new DBConnection();
$connection->query(" DELETE FROM ricette WHERE ricette.id=\"{$removeId}\" ");	
$connection->disconnect();
$portata = $_GET['portata'];
header("Location: ./elenco.php?id=$portata");
exit;