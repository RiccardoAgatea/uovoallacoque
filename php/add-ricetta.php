<?php
require_once "./template-handler.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml"); 

$handler->setTitle("Aggiungi ricetta | Utente | Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

if (!key_exists("logged", $_SESSION) || (!$_SESSION["logged"]))
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

$handler->setBreadcrumb(
    str_replace(
        "<percorsoPlaceholder />",
        "<a href=\"<rootFolder />/php/utente.php\">Utente</a> &gt Aggiungi ricetta",
        file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
    )
);

$content = file_get_contents(__DIR__ . "/components/add-ricetta-content.php");

if (key_exists("wrong-add", $_SESSION) && $_SESSION["wrong-add"]) {
    $content = str_replace("<nomePlaceholder />", $_SESSION["nome"], $content);
    $content = str_replace("<imgPlaceholder />", $_SESSION["immagine"], $content);
    $content = str_replace("<difficoltaPlaceholder />", $_SESSION["difficolta"], $content);
    $content = str_replace("<tempoPlaceholder />", $_SESSION["tempo"], $content);
    $content = str_replace("<ingredientiPlaceholder />", $_SESSION["ingredienti"], $content);
    $content = str_replace("<proceduraPlaceholder />", $_SESSION["procedura"], $content);
    switch (intval($_SESSION["tipo"])) {
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

    $_SESSION["wrong-add"] = false;
    $_SESSION["immagine"] = "";
    $_SESSION["difficolta"] = "";
    $_SESSION["nome"] = "";
    $_SESSION["tempo"] = "";
    $_SESSION["tipo"] = "";
    $_SESSION["ingredienti"] = "";
    $_SESSION["procedura"] = "";
} else {
    $content = str_replace("<nomePlaceholder />", "", $content);
    $content = str_replace("<imgPlaceholder />", "", $content);
    $content = str_replace("<difficoltaPlaceholder />", "", $content);
    $content = str_replace("<tempoPlaceholder />", "", $content);
    $content = str_replace("<ingredientiPlaceholder />", "", $content);
    $content = str_replace("<proceduraPlaceholder />", "", $content);
    $content = str_replace("<errorNomePlaceholder />", "", $content);
    $content = str_replace("<errorImgPlaceholder />", "", $content);
    $content = str_replace("<errorDifficoltaPlaceholder />", "", $content);
    $content = str_replace("<errorTempoPlaceholder />", "", $content);
    $content = str_replace("<errorTipoPlaceholder />", "", $content);
}

$handler->setContent($content);

$handler->setAnnulla(
    str_replace(
        "<linkPlaceholder/>",
        "<rootFolder />/php/utente.php",
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
