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

$risultato = $tipo != 0 ? contentPortata($tipo) : contentRicerca($_GET["termine_ricerca"]);

$content = str_replace("<elencoPlaceholder />", $risultato, $content);

$handler->setContent($content);
$handler->send();

// switch ($tipo) {
//     case 1:
//         $handler->setNav(
//             str_replace(
//                 "<a href=\"<rootFolder />/php/elenco.php?id=1\">Primi Piatti</a>",
//                 "Primi Piatti",
//                 file_get_contents(__DIR__ . "/components/default-nav.php")
//             )
//         );
//         $handler->setBreadcrumb("Ti trovi in: Home &gt Primi Piatti");
//         $content = file_get_contents(__DIR__ . "/components/primi-content.php");
//         $content = preg_replace("(<top.*Placeholder />)", "", $content);
//         $risultato = contentPortata(1);
//         $content = str_replace("<PlaceholderElenco />", $risultato, file_get_contents(__DIR__ . "/components/primi-content.php"));
//         $handler->setContent($content);
//         $handler->send();
//         break;
//     case 2:
//         $handler->setNav(
//             str_replace(
//                 "<a href=\"<rootFolder />/php/elenco.php?id=2\">Secondi Piatti</a>",
//                 "Secondi Piatti",
//                 file_get_contents(__DIR__ . "/components/default-nav.php")
//             )
//         );
//         $handler->setBreadcrumb("Ti trovi in: Home &gt Secondi Piatti");
//         $content = file_get_contents(__DIR__ . "/components/secondi-content.php");
//         $content = preg_replace("(<top.*Placeholder />)", "", $content);
//         $risultato = contentPortata(2);
//         $content = str_replace("<PlaceholderElenco />", $risultato, $content = file_get_contents(__DIR__ . "/components/secondi-content.php"));
//         $handler->setContent($content);
//         $handler->send();
//         break;
//     case 3:
//         $handler->setNav(
//             str_replace(
//                 "<a href=\"<rootFolder />/php/elenco.php?id=3\">Dolci</a>",
//                 "Dolci",
//                 file_get_contents(__DIR__ . "/components/default-nav.php")
//             )
//         );
//         $handler->setBreadcrumb("Ti trovi in: Home &gt Dolci");
//         $content = file_get_contents(__DIR__ . "/components/dolci-content.php");
//         $content = preg_replace("(<top.*Placeholder />)", "", $content);
//         $risultato = contentPortata(3);
//         $content = str_replace("<PlaceholderElenco />", $risultato, $content = file_get_contents(__DIR__ . "/components/dolci-content.php"));
//         $handler->setContent($content);
//         $handler->send();
//         break;
//     case 4:
//         $handler->setBreadcrumb("Ti trovi in: Home > Ricerca");
//         $content = file_get_contents(__DIR__ . "/components/ricerca-content.php");
//         $content = preg_replace("(<top.*Placeholder />)", "", $content);
//         $handler->setContent($content);
//         $handler->send();
//         break;

// }
