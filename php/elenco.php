<?php
require_once "./template-handler.php";
require_once "./query-portata.php";

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

$handler->setLogin(
    file_get_contents(__DIR__ . "/components/default-login.php")
);

$tipi = [
    "Risultati della ricerca",
    "Primi Piatti",
    "Secondi Piatti",
    "Dolci",
];

$tipo = $_GET['id'];

if ($tipo < 0 || $tipo >= 4) {
    throw new Exception("Mica bene!");
}

if ($tipo != 0) {
    $handler->setNav(
        str_replace(
            "<a href=\"<rootFolder />/php/elenco.php?id=$tipo\">{$tipi[$tipo]}</a>",
            "{$tipi[$tipo]}",
            file_get_contents(__DIR__ . "/components/default-nav.php")
        )
    );

    $handler->setBreadcrumb(
        "Ti trovi in: Home &gt; $tipi[$tipo]"
    );
}

$content = file_get_contents(__DIR__ . "/components/elenco-content.php");
$content = str_replace("<categoriaPlaceholder />", $tipi[$tipo], $content);

$risultato = $tipo != 0 ? contentPortata($tipo) : contentRicerca();

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
