<?php
require_once "./template-handler.php";
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

$login = "";

if (key_exists("logged", $_SESSION) && $_SESSION["logged"]) {
    $login .= file_get_contents(__DIR__ . "/components/personal-login.php");

    $login = str_replace("<idUtentePlaceholder />", $_SESSION["user"]->getID(), $login);

    $login = str_replace("<nomeUtentePlaceholder />", $_SESSION["user"]->getNickname(), $login);

} else {
    $login .= file_get_contents(__DIR__ . "/components/default-login.php");
}

$handler->setLogin($login);

$handler->setNav(
    file_get_contents(__DIR__ . "/components/default-nav.php")
);

$content = file_get_contents(__DIR__ . "/components/ricetta-content.php");

$connection = new DBConnection();

$result = $connection->query("SELECT * FROM ricette WHERE id={$_GET["id"]}")->fetch_assoc();

if (!$result) {
    // redirect 404
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

    $percorsoBread = "<a href=\"<rootFolder />/index.php\">Home</a> &gt; <a href=\"<rootFolder />/php/elenco.php?id=$portata\">{$portate[$portata-1]}</a> &gt; $nome";

    $handler->setBreadcrumb(
        str_replace(
            "<percorsoPlaceholder />",
            $percorsoBread,
            file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
        )
    );

    $listaIngredienti = "";

    foreach (explode(",", $ingredienti) as $ing) {
        $listaIngredienti .= "<li>$ing</li>";
    }

    $content = str_replace("<nomeRicettaPlaceholder />", $nome, $content);
    $content = str_replace("<imgSrcPlaceholder />", $img, $content);
    $content = str_replace("<difficoltàPlaceholder />", $difficolta, $content);
    $content = str_replace("<tempoPlaceholder />", $tempo, $content);
    $content = str_replace("<ingredientiPlaceholder />", $listaIngredienti, $content);
    $content = str_replace("<proceduraPlaceholder />", $procedimento, $content);
}

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);

$handler->send();
