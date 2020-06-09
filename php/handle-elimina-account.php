<?php
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";
session_start();

if ($_POST["user-password-elimina"] == $_SESSION["user"]->getPassword()) {
    $connection = new DBConnection();
    $userId = $_SESSION["user"]->getId();
    $connection->query("DELETE FROM utenti WHERE utenti.id = $userId");
    $connection->disconnect();

    $filePattern = "../img/utenti/" . $_SESSION["user"]->getId() . ".*";

    array_map("unlink", glob($filePattern));

    session_unset();

    session_destroy();

    header("Location: ../index.php");
    exit;
} else {
    $_SESSION["wrong"] = "";

    header("Location: ./utente.php");
    exit;
}
