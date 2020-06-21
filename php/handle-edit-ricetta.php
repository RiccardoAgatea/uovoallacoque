<?php
require_once "./db-connection.php";
require_once "./validation.php";

$id = $_GET['id'];
$pagina = $_GET['pagina'];

session_start();

$_SESSION["nome"] = $_POST['nome'];
$_SESSION["tempo"] = $_POST['tempo'];
$_SESSION["difficolta"] = $_POST['difficolta'];
$_SESSION["portata"] = $_POST['tipo'];
$_SESSION["tipo"] = $_POST['tipo'];
$_SESSION["ingredienti"] = $_POST['ingredienti'];
$_SESSION["procedura"] = $_POST['procedura'];
$_SESSION["keywords"] = $_POST['keywords'];

$_SESSION["errorNome"] = checkNomeRicetta("nome", false);
$_SESSION["errorImg"] = checkImage("immagine");
$_SESSION["errorDifficolta"] = checkDifficolta("difficolta");
$_SESSION["errorTempo"] = checkTempo("tempo");
$_SESSION["errorKeywords"] = checkKeywords("keywords");

if ($_SESSION["errorNome"] != "" ||
    $_SESSION["errorImg"] != "" ||
    $_SESSION["errorDifficolta"] != "" ||
    $_SESSION["errorTempo"] != "" ||
    $_SESSION["errorKeywords"] != "") {
    $_SESSION["wrong-edit"] = true;
    header("Location: ./edit-ricetta.php?id={$id}&pagina={$pagina}");
    exit;
} else {
    $connection = new DBConnection();

    $path = "";
    $basename = basename($_FILES['immagine']['name']);
    $uploadfile = "../img/ricette/" . $basename;
    move_uploaded_file($_FILES['immagine']['tmp_name'], $uploadfile);
    $path = str_replace("..", "<rootFolder />", $uploadfile);
    // }

    $queryString = " UPDATE ricette SET nome='{$_POST['nome']}', difficolta='{$_POST['difficolta']}', tempo='{$_POST['tempo']}', img='$path', portata='{$_POST['tipo']}', ingredienti='{$_POST['ingredienti']}', procedimento='{$_POST['procedura']}' WHERE id='{$id}' ";
    $connection->query($queryString);
    $connection->disconnect();

    $_SESSION["wrong-edit"] = false;
    $_SESSION["nome"] = "";
    $_SESSION["tempo"] = "";
    $_SESSION["portata"] = "";
    $_SESSION["difficolta"] = "";
    $_SESSION["ingredienti"] = "";
    $_SESSION["procedura"] = "";
    $_SESSION["tipo"] = "";
    $_SESSION["keywords"] = "";
    header("Location: ./ricetta.php?id={$id}&pagina={$pagina}");
    exit;
}
