<?php
require_once "./template-handler.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Registrati | Uovo alla Coque");
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

$handler->setBreadcrumb(
    str_replace(
        "<percorsoPlaceholder />",
        "Registrati",
        file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
    )
);

$content = file_get_contents(__DIR__ . "/components/signup-content.php");

if (key_exists("wrong-signup", $_SESSION) && $_SESSION["wrong-signup"]) {
    $content = str_replace("<emailPlaceholder />", $_SESSION["email"], $content);

    $content = str_replace("<password1Placeholder />", $_SESSION["password"], $content);

    $content = str_replace("<nicknamePlaceholder />", $_SESSION["nickname"], $content);

    if ($_SESSION["error"] == "email") {
        $content = str_replace("<errorPlaceholder />", "<p>L'indirizzo email inserito risulta già associato ad un utente</p>", $content);
    } else if ($_SESSION["error"] == "nickname") {
        $content = str_replace("<errorPlaceholder />", "<p>Il nickname inserito non è disponibile</p>", $content);

    }

    $_SESSION["wrong-signup"] = false;
    $_SESSION["email"] = "";
    $_SESSION["password"] = "";
    $_SESSION["nickname"] = "";

} else {
    $content = str_replace("<emailPlaceholder />", "", $content);

    $content = str_replace("<password1Placeholder />", "", $content);

    $content = str_replace("<nicknamePlaceholder />", "", $content);

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
