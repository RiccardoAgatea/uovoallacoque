<?php
require_once "./template-handler.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml"); 

$handler->setTitle("Aggiungi ricetta | Utente | Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

if (!key_exists("logged", $_SESSION)||(!$_SESSION["logged"]))
{
    header("Location: ../401.php");
}
else if (!$_SESSION["user"]->getAdmin()) {
    header("Location: ../403.php");
}

$login = "";

$login .= file_get_contents(__DIR__ . "/components/personal-login.php");

$login = str_replace("<nomeUtentePlaceholder />", $_SESSION["user"]->getNickname(), $login);

$handler->setLogin($login);

$handler->setNav(
    file_get_contents(__DIR__ . "/components/default-nav.php")
);

$handler->setBreadcrumb(
    str_replace(
        "<percorsoPlaceholder />",
        "<a href=\"<rootFolder />/php/utente.php\">Utente</a> &gt Aggiungi ricetta",
        file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
    )
);

if (key_exists("wrong-add", $_SESSION) && $_SESSION["wrong-add"]) {
    // if ($_SESSION["error"] !== "") {
    //     $content = str_replace("<errorPlaceholder />", $_SESSION["error"], $content);
    // }   

    $_SESSION["wrong-add"] = false;
} else {
    // $content = str_replace("<errorPlaceholder />", "", $content);
}

$content = file_get_contents(__DIR__ . "/components/add-ricetta-content.php");

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);

$handler->setFooter(
    file_get_contents(__DIR__ . "/components/html/footer.html")
);

$handler->send();
