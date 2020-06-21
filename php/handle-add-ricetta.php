<?php
require_once "./db-connection.php";
require_once "./validation.php";
require_once "./user.php";

session_start();

$_SESSION["nome"] = $_POST['nome'];
$_SESSION["tempo"] = $_POST['tempo'];
$_SESSION["difficolta"] = $_POST['difficolta'];
$_SESSION["tipo"] = $_POST['tipo'];
$_SESSION["ingredienti"] = $_POST['ingredienti'];
$_SESSION["procedura"] = $_POST['procedura'];
$_SESSION["keywords"] = $_POST['keywords'];

$_SESSION["errorNome"] = checkNomeRicetta("nome", true);
$_SESSION["errorImg"] = checkImage("immagine");
$_SESSION["errorDifficolta"] = checkDifficolta("difficolta");
$_SESSION["errorTempo"] = checkTempo("tempo");
$_SESSION["errorKeywords"] = checkKeywords("keywords");

if ($_SESSION["errorNome"] != "" ||
    $_SESSION["errorImg"] != "" ||
    $_SESSION["errorDifficolta"] != "" ||
    $_SESSION["errorTempo"] != "" ||
    $_SESSION["errorKeywords"] != "") {
    $_SESSION["wrong-add"] = true;
    header("Location: ./add-ricetta.php");
    exit;
} else {
    $connection = new DBConnection(); 
    $nickname = $_SESSION['user']->getNickname();

    
    $connection->query("INSERT INTO ricette (nome, difficolta, tempo, portata, ingredienti, procedimento, keywords, author) VALUES (\"{$_POST['nome']}\",\"{$_POST['difficolta']}\",\"{$_POST['tempo']}\",\"{$_POST['tipo']}\",\"{$_POST['ingredienti']}\",\"{$_POST['procedura']}\",\"{$_POST['keywords']}\", \"$nickname\");");

    if(key_exists("immagine", $_FILES)) {
        $ricettaRow = $connection->query("SELECT id FROM ricette WHERE nome=\"{$_POST['nome']}\"");
        if($ricettaRow) {
            $idRicetta = $ricettaRow->fetch_assoc()['id'];
            $imageFileType = strtolower(pathinfo($_FILES['immagine']['name'], PATHINFO_EXTENSION));
            $uploadfile = "../img/ricette/" . $idRicetta . "." . $imageFileType;
            move_uploaded_file($_FILES['immagine']['tmp_name'], $uploadfile);
            $path = str_replace("..", "<rootFolder />", $uploadfile);

            $connection->query("UPDATE ricette SET ricette.img = \"{$path}\" WHERE ricette.id={$idRicetta}");
        }
    }

    $connection->disconnect();
    $_SESSION["wrong-add"] = false;
    $_SESSION["nome"] = "";
    $_SESSION["tempo"] = "";
    $_SESSION["difficolta"] = "";
    $_SESSION["ingredienti"] = "";
    $_SESSION["procedura"] = "";
    $_SESSION["tipo"] = "";
    $_SESSION["keywords"] = "";
    header("Location: ./utente.php");
    exit;
}
