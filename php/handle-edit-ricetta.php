<?php
require_once "./db-connection.php";
require_once "./validation.php";

$id = $_GET['id'];
$pagina = $_GET['pagina'];

session_start();

$_SESSION["nome"] = $_POST['nome'];
$_SESSION["tempo"] = $_POST['tempo'];
$_SESSION["difficolta"] = $_POST['difficolta'];
$_SESSION["immagine"] = $_POST['immagine'];
$_SESSION["ingredienti"] = $_POST['ingredienti'];
$_SESSION["procedura"] = $_POST['procedura'];

$_SESSION["errorNome"] = checkNomeRicetta("nome");
$_SESSION["errorImg"] = "";
$_SESSION["errorDifficolta"] = checkDifficolta("difficolta");
$_SESSION["errorTempo"] = checkTempo("tempo");

if ($_SESSION["errorNome"] != "" || $_SESSION["errorImg"] != "" || $_SESSION["errorDifficolta"] !=  "" || $_SESSION["errorTempo"] != "") { 
    $_SESSION["wrong-edit"] = true; 
   header("Location: ./edit-ricetta.php?id={$id}&pagina={$pagina}"); 
    exit;
} else { 
    $connection = new DBConnection();
    $queryString = " UPDATE ricette SET nome='{$_POST['nome']}', difficolta='{$_POST['difficolta']}', tempo='{$_POST['tempo']}', img='{$_POST['immagine']}', portata='1', ingredienti='{$_POST['ingredienti']}', procedimento='{$_POST['procedura']}' WHERE id='{$id}' ";
    $connection->query($queryString);
    $connection->disconnect();

    $_SESSION["wrong-edit"] = false;
    $_SESSION["nome"] = "";
    $_SESSION["tempo"] = "";
    $_SESSION["difficolta"] = "";
    $_SESSION["immagine"] = "";
    $_SESSION["ingredienti"] = "";
    $_SESSION["procedura"] = "";
    header("Location: ./ricetta.php?id={$id}&pagina={$pagina}");
    exit;
}
