<?php
require_once "./template-handler.php";
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml"); 

$handler->setTitle("Modifica ricetta | Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

if (!key_exists("logged", $_SESSION)||(!$_SESSION["logged"]))
{
    header("Location: ../401.php");
}
else if (!$_SESSION["user"]->getAdmin()) {
    header("Location: ../403.php");
}

$login = "";

$login .= file_get_contents(__DIR__ . "/components/personal-login.php");

$login = str_replace("<nomeUtentePlaceholder />", $_SESSION["user"]->getNickname(), $login);

$handler->setLogin($login);

$handler->setNav(
    file_get_contents(__DIR__ . "/components/default-nav.php")
);

$content = file_get_contents(__DIR__ . "/components/edit-ricetta-content.php");

$connection = new DBConnection();

if(key_exists("pagina", $_GET)) {
    if (intval($_GET["pagina"]<1)) {
        header("Location: ../404.php");
        exit;
    }
}

$id = $_GET["id"];
$pagina = $_GET['pagina'];
$content = str_replace("<idPlaceholder/>", $id, $content);
$content = str_replace("<paginaPlaceholder/>", $pagina, $content);

$result = $connection->query("SELECT * FROM ricette WHERE id={$id}")->fetch_assoc();
if (!$result) {
    $connection->disconnect();
    header("Location: ../404.php");
    exit;
} else {
    $nome = $result["nome"];
    $portata = $result["portata"];
    $difficolta = $result["difficolta"];
    $tempo = $result["tempo"];
    $img = $result["img"];
    $ingredienti = $result["ingredienti"];
    $procedimento = $result["procedimento"];

    $portate = [
        "Primi piatti",
        "Secondi piatti",
        "Dessert",
    ];

    $percorsoBread = "<a href=\"<rootFolder />/index.php\">Home</a> &gt; <a href=\"<rootFolder />/php/elenco.php?id=$portata\">{$portate[$portata - 1]}</a> &gt; <a href=\"<rootFolder />/php/ricetta.php?id=$id&amp;pagina=1\">$nome</a> &gt; Modifica ricetta";

    $handler->setBreadcrumb(
        str_replace(
            "<percorsoPlaceholder />",
            $percorsoBread,
            file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
        )
    );   

    if (key_exists("wrong-edit", $_SESSION) && $_SESSION["wrong-edit"]) {
        $content = str_replace("<nomeRicettaPlaceholder/>", $_SESSION["nome"], $content);
        $content = str_replace("<imgSrcPlaceholder/>", $_SESSION["immagine"], $content);
        $content = str_replace("<difficoltaPlaceholder/>", $_SESSION["difficolta"], $content);
        $content = str_replace("<tempoPlaceholder/>", $_SESSION["tempo"], $content);
        $content = str_replace("<ingredientiPlaceholder/>", $_SESSION["ingredienti"], $content);
        $content = str_replace("<proceduraPlaceholder/>", $_SESSION["procedura"], $content);

        switch ($_SESSION["tipo"]) {
          case 1:
            $content = str_replace('<input class="radio-ricetta" type="radio" id="primo" name="tipo" value="1"/>', '<input class="radio-ricetta" type="radio" id="primo" name="tipo" value="1" checked="checked"/>', $content);
            break;
          case 2:
            $content = str_replace('<input class="radio-ricetta" type="radio" id="secondo" name="tipo" value="2"/>', '<input class="radio-ricetta" type="radio" id="secondo" name="tipo" value="2" checked="checked"/>', $content);
            break;
          case 3:
            $content = str_replace('<input class="radio-ricetta" type="radio" id="dolce" name="tipo" value="3"/>', '<input class="radio-ricetta" type="radio" id="dolce" name="tipo" value="3" checked="checked"/>', $content);
            break;
          default:
            $content = str_replace("<errorTipoPlaceholder />", "Tipo di portata inesistente", $content);
        } 

        if ($_SESSION["errorNome"] != "") {
            $content = str_replace("<errorNomePlaceholder />", $_SESSION["errorNome"], $content);
        }   
        if ($_SESSION["errorImg"] != "") {
            $content = str_replace("<errorImgPlaceholder />", $_SESSION["errorImg"], $content);
        } 
        if ($_SESSION["errorDifficolta"] != "") {
            $content = str_replace("<errorDifficoltaPlaceholder />", $_SESSION["errorDifficolta"], $content);
        } 
        if ($_SESSION["errorTempo"] != "") {
            $content = str_replace("<errorTempoPlaceholder />", $_SESSION["errorTempo"], $content);
        } 

        $_SESSION["wrong-edit"] = false;
        $_SESSION["immagine"] = "";
        $_SESSION["difficolta"] = "";
        $_SESSION["nome"] = "";
        $_SESSION["tempo"] = "";
        $_SESSION["ingredienti"] = "";
        $_SESSION["procedura"] = "";
    } else {
        $content = str_replace("<nomeRicettaPlaceholder/>", $nome, $content);
        $content = str_replace("<imgSrcPlaceholder/>", $img, $content);
        $content = str_replace("<difficoltaPlaceholder/>", $difficolta, $content);
        $content = str_replace("<tempoPlaceholder/>", $tempo, $content);
        $content = str_replace("<ingredientiPlaceholder/>", $ingredienti, $content);
        $content = str_replace("<proceduraPlaceholder/>", $procedimento, $content);

        switch ($portata) {
          case 1:
            $content = str_replace('<input class="radio-ricetta" type="radio" id="primo" name="tipo" value="1"/>', '<input class="radio-ricetta" type="radio" id="primo" name="tipo" value="1" checked="checked"/>', $content);
            break;
          case 2:
            $content = str_replace('<input class="radio-ricetta" type="radio" id="secondo" name="tipo" value="2"/>', '<input class="radio-ricetta" type="radio" id="secondo" name="tipo" value="2" checked="checked"/>', $content);
            break;
          case 3:
            $content = str_replace('<input class="radio-ricetta" type="radio" id="dolce" name="tipo" value="3"/>', '<input class="radio-ricetta" type="radio" id="dolce" name="tipo" value="3" checked="checked"/>', $content);
            break;
          default:
            $content = str_replace("<errorTipoPlaceholder />", "Tipo di portata inesistente", $content);
        } 

        $content = str_replace("<errorNomePlaceholder />", "", $content);
        $content = str_replace("<errorImgPlaceholder />", "", $content);
        $content = str_replace("<errorDifficoltaPlaceholder />", "", $content);
        $content = str_replace("<errorTempoPlaceholder />", "", $content);
        $content = str_replace("<errorTipoPlaceholder />", "", $content);
    }
}

$handler->setContent($content);

$handler->setAnnulla(
    str_replace(
        "<linkPlaceholder/>",
        "<rootFolder />/php/ricetta.php?id=$id&amp;pagina=$pagina",
        file_get_contents(__DIR__ . "/components/default-annulla.php")
    )
);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);

$handler->setFooter(
    file_get_contents(__DIR__ . "/components/html/footer.html")
);

$handler->send();
