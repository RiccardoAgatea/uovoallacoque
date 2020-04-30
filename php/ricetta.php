<?php
require_once "./template-handler.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Uovo alla Coque");
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
