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
$content = str_replace("<idPlaceholder/>", $id, $content);
$content = str_replace("<paginaPlaceholder/>", $_GET['pagina'], $content);

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
    $content = str_replace("<nomeRicettaPlaceholder/>", $nome, $content);
    $content = str_replace("<imgSrcPlaceholder/>", $img, $content);
    $content = str_replace("<difficoltaPlaceholder/>", $difficolta, $content);
    $content = str_replace("<tempoPlaceholder/>", $tempo, $content);
    $content = str_replace("<ingredientiPlaceholder/>", $ingredienti, $content);
    $content = str_replace("<proceduraPlaceholder/>", $procedimento, $content);
}

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);

$handler->setFooter(
    file_get_contents(__DIR__ . "/components/html/footer.html")
);

$handler->send();
