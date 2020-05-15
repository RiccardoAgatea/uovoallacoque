<?php
require_once "./template-handler.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Accedi | Uovo alla Coque");
$handler->setDescription("");
$handler->setKeywords("");
$handler->setAuthor("");

if (key_exists("logged", $_SESSION) && $_SESSION["logged"]) {
    header("Location: ./utente.php");
}

$handler->setLogin(
    preg_replace("((?s)<a href=\"<rootFolder />/php/login\.php\">.*?</a>)",
        "Accedi",
        file_get_contents(__DIR__ . "/components/default-login.php")
    )
);

$handler->setNav(
    file_get_contents(__DIR__ . "/components/default-nav.php")
);

$handler->setBreadcrumb(
    str_replace(
        "<percorsoPlaceholder />",
        "Accedi",
        file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
    )
);

$content = file_get_contents(__DIR__ . "/components/login-content.php");

if (key_exists("wrong-login", $_SESSION) && $_SESSION["wrong-login"]) {
    $content = str_replace("<emailPlaceholder />", $_SESSION["email"], $content);

    $content = str_replace("<passwordPlaceholder />", $_SESSION["password"], $content);

    $content = str_replace("<errorPlaceholder />", "<p>Credenziali errate</p>", $content);

    $_SESSION["wrong-login"] = false;
    $_SESSION["email"] = "";
    $_SESSION["password"] = "";

} else {
    $content = str_replace("<emailPlaceholder />", "", $content);

    $content = str_replace("<passwordPlaceholder />", "", $content);

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
