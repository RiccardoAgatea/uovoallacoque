<?php
require_once __DIR__ . "/php/template-handler.php";
require_once __DIR__ . "/php/user.php";

session_start();

$handler = new TemplateHandler(".", "xhtml");

$handler->setTitle("Richiesta errata | Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

$login = "";

if (key_exists("logged", $_SESSION) && $_SESSION["logged"]) {
    $login .= file_get_contents(__DIR__ . "/php/components/personal-login.php");

    $login = str_replace("<nomeUtentePlaceholder />", $_SESSION["user"]->getNickname(), $login);

} else {
    $login .= file_get_contents(__DIR__ . "/php/components/default-login.php");
}

$handler->setLogin($login);

$handler->setNav(
    file_get_contents(__DIR__ . "/php/components/default-nav.php")
);

$handler->setBreadcrumb(
    // str_replace(
    //     "<percorsoPlaceholder />",
    //     "Home",
    //     file_get_contents(__DIR__ . "/php/components/default-breadcrumb.php")
    // )
    ""
);

$content = "<p>Attenzione alle richieste che fai! Probabilmente hai commesso un errore.</p>";

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/php/components/default-tornaSu.php")
);

$handler->setFooter(
    file_get_contents(__DIR__ . "/php/components/html/footer.html")
);

$handler->send();