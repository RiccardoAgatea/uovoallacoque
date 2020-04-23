<?php
require_once "./php/template-handler.php";
require_once __DIR__ . '/php/query-portata.php';

$handler = new TemplateHandler(".", "xhtml");

$handler->setTitle("Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

$handler->setLogin(
    file_get_contents(__DIR__ . "/php/components/default-login.php")
);

$handler->setNav(
    str_replace(
        "<a href=\"<rootFolder />/index.php\">Home</a>",
        "Home",
        file_get_contents(__DIR__ . "/php/components/default-nav.php")
    )
);

$handler->setBreadcrumb(
    str_replace(
        "<percorsoPlaceholder />",
        "Home",
        file_get_contents(__DIR__ . "/php/components/default-breadcrumb.php")
    )
);

$content = file_get_contents(__DIR__ . "/php/components/home-content.php");

$risultato1 = piattoMigliore(1);
$risultato2 = piattoMigliore(2);
$risultato3 = piattoMigliore(3);
$content = str_replace(array("<topPrimoPlaceholder />", "<topSecondoPlaceholder />", "<topDolcePlaceholder />"), array($risultato1, $risultato2, $risultato3), $content);

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/php/components/default-tornaSu.php")
);

$handler->send();
