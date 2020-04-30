<?php
require_once "./template-handler.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Utente | Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

$handler->setLogin("");

$handler->setNav(
    file_get_contents(__DIR__ . "/components/default-nav.php")
);

$handler->setBreadcrumb(
    str_replace(
        "<percorsoPlaceholder />",
        "<a href=\"<rootFolder />/index.php\">Home</a> &gt Utente",
        file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
    )
);

$content = file_get_contents(__DIR__ . "/components/utente-content.php");

$content = preg_replace("(<top.*Placeholder />)", "", $content);

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);

$handler->send();
