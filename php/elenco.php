<?php
require_once __DIR__ . "/template-handler.php";
require_once __DIR__ . "/query-portata.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

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

$tipi = [
    "Risultati della ricerca",
    "Primi Piatti",
    "Secondi Piatti",
    "Dolci",
];

$tipo = array_key_exists('id', $_GET) ? $_GET['id'] : 0;

if ($tipo < 0 || $tipo >= 4) {
    throw new Exception("Mica bene!");
}
$handler->setTitle("$tipi[$tipo] | Uovo alla Coque");
$nav = file_get_contents(__DIR__ . "/components/default-nav.php");

if ($tipo != 0) {
    $nav = preg_replace(
        "((?s)<a href=\"<rootFolder />/php/elenco\.php\?id=$tipo\">.*?</a>)",
        "{$tipi[$tipo]}",
        $nav
    );

    $handler->setBreadcrumb(
        str_replace(
            "<percorsoPlaceholder />",
            "<a href=\"<rootFolder />/index.php\">Home</a> &gt; $tipi[$tipo]",
            file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
        )
    );
}

$handler->setNav($nav);

$content = file_get_contents(__DIR__ . "/components/elenco-content.php");
$content = str_replace("<categoriaPlaceholder />", $tipi[$tipo], $content);

$perPagina = 6; //sarà 9
$pagina = (key_exists("pagina", $_GET)) ? intval($_GET['pagina']) : 1;
$primoElemento = ($pagina - 1) * $perPagina;

$temp =
$tipo != 0 ?
contentPortata($tipo, $primoElemento, $perPagina) :
contentRicerca($_GET["termine_ricerca"], $primoElemento, $perPagina);

$risultato = $temp[0];
$totPagine = $temp[1];

$risultato .= getPaginazione($totPagine, $tipo, $pagina);

$content = str_replace("<elencoPlaceholder />", $risultato, $content);

$handler->setContent($content);
$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);
$handler->setFooter(
    file_get_contents(__DIR__ . "/components/html/footer.html")
);
$handler->send();
