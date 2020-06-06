<?php
require_once "./template-handler.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Registrati | Uovo alla Coque");
$handler->setDescription("Pagina per registrarsi al sito");
$handler->setOtherMeta("<meta name=\"robots\" content=\"noindex, nofollow\" />");

$handler->setLogin(
    preg_replace("((?s)<a href=\"<rootFolder />/php/signup\.php\">.*?</a>)",
        "Registrati",
        file_get_contents(__DIR__ . "/components/default-login.php")
    )
);

$handler->setNav(
    file_get_contents(__DIR__ . "/components/default-nav.php")
);

$handler->setBreadcrumb(
    str_replace(
        "<percorsoPlaceholder />",
        "Registrati",
        file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
    )
);

$content = file_get_contents(__DIR__ . "/components/signup-content.php");

if (key_exists("wrong-signup", $_SESSION) && $_SESSION["wrong-signup"]) {
    $content = str_replace("<nicknamePlaceholder />", $_SESSION["nickname"], $content);
    $content = str_replace("<emailPlaceholder />", $_SESSION["email"], $content);
    $content = str_replace("<password1Placeholder />", $_SESSION["password"], $content);
    
    if ($_SESSION["errorNickname"] != "") {
        $content = str_replace("<errorNicknamePlaceholder />", $_SESSION["errorNickname"], $content);
    }    
    if ($_SESSION["errorEmail"] != "") {
        $content = str_replace("<errorEmailPlaceholder />", $_SESSION["errorEmail"], $content);
    }    
    if ($_SESSION["errorPassword"] != "") {
        $content = str_replace("<errorPasswordPlaceholder />", $_SESSION["errorPassword"], $content);
    }   

    $_SESSION["wrong-signup"] = false;
    $_SESSION["email"] = "";
    $_SESSION["password"] = "";
    $_SESSION["nickname"] = "";
} else {
    $content = str_replace("<nicknamePlaceholder />", "", $content);
    $content = str_replace("<emailPlaceholder />", "", $content);
    $content = str_replace("<password1Placeholder />", "", $content);
    $content = str_replace("<errorNicknamePlaceholder />", "", $content);
    $content = str_replace("<errorEmailPlaceholder />", "", $content);
    $content = str_replace("<errorPasswordPlaceholder />", "", $content);
}

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);
$handler->setFooter(
    file_get_contents(__DIR__ . "/components/html/footer.html")
);

$handler->send();
