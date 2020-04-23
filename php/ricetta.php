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

$handler->setBreadcrumb("Ti trovi in: Home &gt Primi");

$content = file_get_contents(__DIR__ . "/components/ricetta-content.html");

$content = preg_replace("(<top.*Placeholder />)", "", $content);

$handler->setContent($content);

$handler->send();
