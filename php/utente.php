<?php
require_once "./template-handler.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Utente | Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

$login = "";

$login .= file_get_contents(__DIR__ . "/components/personal-login.php");

$login = preg_replace("((?s)<a.*?href=\"<rootFolder />/php/utente\.php\">.*?</a>)", "<nomeUtentePlaceholder />", $login);

$login = str_replace("<nomeUtentePlaceholder />", $_SESSION["user"]->getNickname(), $login);

$handler->setLogin($login);

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

$content = str_replace("<PlaceholderImmagineUtente />", $_SESSION["user"]->getPicture(), $content);
$content = str_replace("<PlaceholderNicknameUtente />", $_SESSION["user"]->getNickname(), $content);
$content = str_replace("<PlaceholderEmailUtente />", $_SESSION["user"]->getEmail(), $content);

if (key_exists("wrong", $_SESSION)) {
    $content = str_replace("<errorPlaceholder />", "<p>Password errata</p>", $content);

    unset($_SESSION["wrong"]);
} else {
    $content = str_replace("<errorPlaceholder />", "", $content);
}

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);

$handler->setFooter(
    file_get_contents(__DIR__ . "/components/html/footer.html")
);

$handler->send();
