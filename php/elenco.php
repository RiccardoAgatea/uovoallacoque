<?php
require_once __DIR__ . "/template-handler.php";
require_once __DIR__ . "/query-portata.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$login = "";

if (key_exists("pagina", $_GET)) {
    if (intval($_GET["pagina"] < 1)) {
        header("Location: ../404.php");
        exit;
    }
}

if (key_exists("logged", $_SESSION) && $_SESSION["logged"]) {
    $login .= file_get_contents(__DIR__ . "/components/personal-login.php");

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
    header("Location: ../404.php");
    exit;
}

$handler->setTitle("$tipi[$tipo] | Uovo alla Coque");
$handler->setAuthor("Agatea Riccardo, Bosinceanu Ecaterina, Righetto Sara, Schiavon Rebecca");
$nav = file_get_contents(__DIR__ . "/components/default-nav.php");

switch ($tipo) {
    case 0:$handler->setDescription("Elenco delle ricette il cui nome contiene il termine ricercato");
        $handler->setOtherMeta("<meta name=\"keywords\" content=\"ricette\" />");
        break;
    case 1:$handler->setDescription("Elenco delle ricette di primi piatti disponibili");
        $handler->setOtherMeta("<meta name=\"keywords\" content=\"ricette, primi piatti\" />");
        break;
    case 2:$handler->setDescription("Elenco delle ricette di secondi piatti disponibili");
        $handler->setOtherMeta("<meta name=\"keywords\" content=\"ricette, secondi piatti\" />");
        break;
    case 3:$handler->setDescription("Elenco delle ricette dei dolci disponibili");
        $handler->setOtherMeta("<meta name=\"keywords\" content=\"ricette, dolci, dessert\" />");
        break;
}

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
} else {
    $handler->setBreadcrumb("");
}

$handler->setNav($nav);

$content = file_get_contents(__DIR__ . "/components/elenco-content.php");

$categoria = $tipi[$tipo];

if ($tipo == 0) {
    $categoria .= ": " . $_GET["termine-ricerca"];
}

$content = str_replace("<categoriaPlaceholder />", $categoria, $content);

$perPagina = 6;
$pagina = (key_exists("pagina", $_GET)) ? intval($_GET['pagina']) : 1;
$primoElemento = ($pagina - 1) * $perPagina;

$temp =
$tipo != 0 ?
contentPortata($tipo, $primoElemento, $perPagina) :
contentRicerca($_GET["termine-ricerca"], $primoElemento, $perPagina);

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
