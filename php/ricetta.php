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

$handler->setNav(
    file_get_contents(__DIR__ . "/components/default-nav.php")
);

$handler->setBreadcrumb(
    str_replace(
        "<percorsoPlaceholder />",
        "<a href=\"<rootFolder />/index.php\">Home</a> &gt ??",
        file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
    )
);


$content = file_get_contents(__DIR__ . "/components/ricetta-content.php");

$content = preg_replace("(<top.*Placeholder />)", "", $content);

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);


$handler->send();
