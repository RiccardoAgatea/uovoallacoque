<?php
require_once "./db-connection.php";
require_once "./validation.php";

session_start();
$_SESSION["error"] = "";

if ($_SESSION["error"] !== "" ) { 
    $_SESSION["wrong-edit"] = true; 
   header("Location: ./edit-ricetta.php"); 
    exit;
} else { 
    $connection = new DBConnection();
    $connection->query(" UPDATE ricette SET nome=\"{$_POST['nome']}\", difficolta=\"{$_POST['difficolta']}\", tempo=\"{$_POST['tempo']}\", img=\"{$_POST['immagine']}\", portata=\"1\", ingredienti=\"{$_POST['ingredienti']}\", procedimento=\"{$_POST['procedura']}\" WHERE id=\"{$_GET['id']}\" ");

    $_SESSION["wrong-edit"] = false;
    $connection->disconnect();
    header("Location: ../index.php");
    exit;
}
