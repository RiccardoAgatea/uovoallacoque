<?php
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";
require_once __DIR__ . "/validation.php";
session_start();

if (!key_exists("logged", $_SESSION) || (!$_SESSION["logged"])) {
    header("Location: ../401.php");
}

switch ($_GET["item"]) {
    case "img":
        if ((!file_exists($_FILES['user-immagine']['tmp_name']) || !is_uploaded_file($_FILES['user-immagine']['tmp_name']))) {
            $_SESSION["wrong"] = "Seleziona un file";
        } else if ($_FILES['user-immagine']['size'] > 153600) { //150KB
            $_SESSION["wrong"] = "L'immagine non deve superare i 150KB";
        } else if ($_POST["user-password-immagine"] == $_SESSION["user"]->getPassword()) {
            $imageFileType = strtolower(pathinfo($_FILES['user-immagine']['name'], PATHINFO_EXTENSION));
            $uploadfile = "../img/utenti/" . $_SESSION["user"]->getId() . "." . $imageFileType;
            move_uploaded_file($_FILES['user-immagine']['tmp_name'], $uploadfile);
            $path = str_replace("..", "<rootFolder />", $uploadfile);

            if ($_SESSION["user"]->getPicture() != $path) {
                $connection = new DBConnection();
                $connection->query("UPDATE utenti SET img=\"$path\" WHERE utenti.id = {$_SESSION["user"]->getId()}");
                $connection->disconnect();
            }

            $_SESSION["complete"] = true;
        } else {
            $_SESSION["wrong"] = "Password errata";
        }
        break;
    case "nick":
        $check = checkNickname("user-nickname");
        if ($check != "") {
            $_SESSION["wrong"] = $check;
        } else if ($_POST["user-password-nickname"] == $_SESSION["user"]->getPassword()) {
            if ($_SESSION["user"]->getNickname() != $_POST["user-nickname"]) {
                $connection = new DBConnection();
                $connection->query("UPDATE utenti SET nickname=\"{$_POST["user-nickname"]}\" WHERE utenti.id = {$_SESSION["user"]->getId()}");
                $connection->disconnect();
            }

            $_SESSION["complete"] = true;
        } else {
            $_SESSION["wrong"] = "Password errata";
        }
        break;
    case "psw":if ($_POST["user-password-password"] == $_SESSION["user"]->getPassword() && $_POST["user-password1"] == $_POST["user-password2"]) {
            $nuovaPsw = $_POST["user-password1"];
            if ($_SESSION["user"]->getPassword() != $nuovaPsw) {
                $connection = new DBConnection();
                $connection->query("UPDATE utenti SET passw=\"$nuovaPsw\" WHERE utenti.id = {$_SESSION["user"]->getId()}");
                $connection->disconnect();
            }

            $_SESSION["complete"] = true;
        } else {
            $_SESSION["wrong"] = "Password errata";
        }
        break;
    case "email":
        $check = checkEmail("user-email");
        if ($check != "") {
            $_SESSION["wrong"] = $check;
        } else if ($_POST["user-password-email"] == $_SESSION["user"]->getPassword()) {
            $connection = new DBConnection();
            $connection->query("UPDATE utenti SET email=\"{$_POST["user-email"]}\" WHERE utenti.id = {$_SESSION["user"]->getId()}");
            $connection->disconnect();

            $_SESSION["complete"] = true;
        } else {
            $_SESSION["wrong"] = "Password errata";
        }
        break;
}

$_SESSION["user"]->update();
header("Location: ./modifica-utente.php");
