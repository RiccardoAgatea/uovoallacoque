<?php
require_once "./template-handler.php";

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

$handler->setLogin(  
    str_replace("<a href=\"<rootFolder />/php/signup.php\">Registrati</a>", 
        "Registrati", 
        file_get_contents(__DIR__ . "/components/default-login.php")
    )
);

$handler->setNav(
    file_get_contents(__DIR__ . "/components/default-nav.php")
);

$handler->setBreadcrumb("Ti trovi in: Registrati");

$content = file_get_contents(__DIR__ . "/components/signup-content.php");

$content = preg_replace("(<top.*Placeholder />)", "", $content);

$handler->setContent($content);

$handler->send();
