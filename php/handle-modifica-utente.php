<?php
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";
session_start();

if (!key_exists("logged", $_SESSION) || (!$_SESSION["logged"])) {
    header("Location: ../401.php");
}

switch ($_GET["item"]) {
    case "img":if ($_POST["user-password-immagine"] == $_SESSION["user"]->getPassword()) {
            $imageFileType = strtolower(pathinfo($_FILES['user-immagine']['name'], PATHINFO_EXTENSION));
            $uploadfile = "../img/utenti/" . basename($_FILES['user-immagine']['name']);
            move_uploaded_file($_FILES['user-immagine']['tmp_name'], $uploadfile);
            $path = str_replace("..", "<rootFolder />", $uploadfile);

            if ($_SESSION["user"]->getPicture() != $path) {
                $connection = new DBConnection();
                $connection->query("UPDATE utenti SET img=\"$path\" WHERE utenti.id = {$_SESSION["user"]->getId()}");
                $connection->disconnect();
            }
        } else {
            $_SESSION["wrong"] = "img";
        }
        break;
    case "nick":if ($_POST["user-password-nickname"] == $_SESSION["user"]->getPassword()) {
            $nuovoNick = $_POST["user-nickname"];
            if ($_SESSION["user"]->getNickname() != $nuovoNick) {
                $connection = new DBConnection();
                $connection->query("UPDATE utenti SET nickname=\"$nuovoNick\" WHERE utenti.id = {$_SESSION["user"]->getId()}");
                $connection->disconnect();
            }
        } else {
            $_SESSION["wrong"] = "nick";
        }
        break;
    case "psw":if ($_POST["user-password-password"] == $_SESSION["user"]->getPassword() && $_POST["user-password1"] == $_POST["user-password2"]) {
            $nuovaPsw = $_POST["user-password1"];
            if ($_SESSION["user"]->getPassword() != $nuovaPsw) {
                $connection = new DBConnection();
                $connection->query("UPDATE utenti SET passw=\"$nuovaPsw\" WHERE utenti.id = {$_SESSION["user"]->getId()}");
                $connection->disconnect();
            }
        } else {
            $_SESSION["wrong"] = "psw";
        }
        break;
    case "email":if ($_POST["user-password-email"] == $_SESSION["user"]->getPassword()) {
            $connection = new DBConnection();
            $connection->query("UPDATE utenti SET email=\"{$_POST['user-email']}\" WHERE utenti.id = {$_SESSION["user"]->getId()}");
            $connection->disconnect();
        } else {
            $_SESSION["wrong"] = "email";
        }
        break;
}

$_SESSION["user"]->update();
header("Location: ./modifica-utente.php");
