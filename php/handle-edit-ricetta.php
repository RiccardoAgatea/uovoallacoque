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

    if (key_exists("immagine", $_FILES) && $_FILES['immagine']['name'] != "") {

        $imageFileType = strtolower(pathinfo($_FILES['immagine']['name'], PATHINFO_EXTENSION));
        $uploadfile = "../img/ricette/" . $id . "." . $imageFileType;
        move_uploaded_file($_FILES['immagine']['tmp_name'], $uploadfile);
        $path = str_replace("..", "<rootFolder />", $uploadfile);

        $connection->query("UPDATE ricette SET img = \"{$path}\" WHERE ricette.id={$id}");
    }

    $nome = test_input($_POST['nome']);
    $difficolta = test_input($_POST['difficolta']);
    $tempo = test_input($_POST['tempo']);
    $portata = test_input($_POST['tipo']);
    $ingredienti = test_input($_POST['ingredienti']);
    $procedura = test_input($_POST['procedura']);
    $keywords = test_input($_POST['keywords']);

    $connection->query("UPDATE ricette SET nome=\"$nome\" WHERE ricette.id='{$id}'");
    $connection->query("UPDATE ricette SET difficolta=\"$difficolta\" WHERE ricette.id='{$id}'");
    $connection->query("UPDATE ricette SET tempo=\"$tempo\" WHERE ricette.id='{$id}'");
    $connection->query("UPDATE ricette SET portata=\"$portata\" WHERE ricette.id='{$id}'");
    $connection->query("UPDATE ricette SET ingredienti=\"$ingredienti\" WHERE ricette.id='{$id}'");
    $connection->query("UPDATE ricette SET procedimento=\"$procedura\" WHERE ricette.id='{$id}'");
    $connection->query("UPDATE ricette SET keywords=\"$keywords\" WHERE ricette.id='{$id}'");
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
