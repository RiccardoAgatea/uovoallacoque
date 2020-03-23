<?php
require_once "./template-handler.php";

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

$handler->setLogin(
    file_get_contents(__DIR__ . "/components/default-login.php")
);
$tipo=$_GET['id'];
include (__DIR__ .'./query-portata.php');
switch($tipo) {
    case 1: 
        $handler->setNav(
            str_replace(
                "<a href=\"<rootFolder />/php/elenco.php?id=1\">Primi Piatti</a>",
                "Primi Piatti",
                file_get_contents(__DIR__ . "/components/default-nav.php")
            )
        );
        $handler->setBreadcrumb("Ti trovi in: Home > Primi Piatti");
        $content = file_get_contents(__DIR__ . "/components/primi-content.php");
        $content = preg_replace("(<top.*Placeholder />)", "", $content);
        $risultato = contentPortata(1);
        $content = str_replace("<PlaceholderElenco />", $risultato, file_get_contents(__DIR__ . "/components/primi-content.php"));
        $handler->setContent($content);
        $handler->send();
    break;
    case 2:
        $handler->setNav(
            str_replace(
                "<a href=\"<rootFolder />/php/elenco.php?id=2\">Secondi Piatti</a>",
                "Secondi Piatti",
                file_get_contents(__DIR__ . "/components/default-nav.php")
            )
        );
        $handler->setBreadcrumb("Ti trovi in: Home > Secondi Piatti");
        $content = file_get_contents(__DIR__ . "/components/secondi-content.php");
        $content = preg_replace("(<top.*Placeholder />)", "", $content);
        $risultato = contentPortata(2);
        $content = str_replace("<PlaceholderElenco />", $risultato, $content = file_get_contents(__DIR__ . "/components/secondi-content.php"));
        $handler->setContent($content);
        $handler->send();
    break;
    case 3:
        $handler->setNav(
            str_replace(
                "<a href=\"<rootFolder />/php/elenco.php?id=3\">Dolci</a>",
                "Dolci",
                file_get_contents(__DIR__ . "/components/default-nav.php")
            )
        );
        $handler->setBreadcrumb("Ti trovi in: Home > Dolci");
        $content = file_get_contents(__DIR__ . "/components/dolci-content.php");
        $content = preg_replace("(<top.*Placeholder />)", "", $content);
        $risultato = contentPortata(3);
        $content = str_replace("<PlaceholderElenco />", $risultato, $content = file_get_contents(__DIR__ . "/components/dolci-content.php"));
        $handler->setContent($content);
        $handler->send();
    break;
    case 4:
        $handler->setBreadcrumb("Ti trovi in: Home > Ricerca");
        $content = file_get_contents(__DIR__ . "/components/ricerca-content.php");
        $content = preg_replace("(<top.*Placeholder />)", "", $content);
        $handler->setContent($content);
        $handler->send();
    break;

}





