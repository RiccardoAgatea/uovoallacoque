<?php
require_once __DIR__ . "/php/template-handler.php";
require_once __DIR__ . "/php/query-portata.php";
require_once __DIR__ . "/php/user.php";

session_start();

$handler = new TemplateHandler(".", "xhtml");

$handler->setTitle("Uovo alla Coque");
$handler->setAuthor("Agatea Riccardo, Bosinceanu Ecaterina, Righetto Sara, Schiavon Rebecca");
$handler->setDescription("Pagina iniziale del sito Uovo alla Coque");
$handler->setOtherMeta("<meta name=\"keywords\" content=\"ricette, uova, piatti, primo piatto, secondo piatto, dolce\" />");

$login = "";

if (key_exists("logged", $_SESSION) && $_SESSION["logged"]) {
    $login .= file_get_contents(__DIR__ . "/php/components/personal-login.php");

    $login = str_replace("<nomeUtentePlaceholder />", $_SESSION["user"]->getNickname(), $login);

} else {
    $login .= file_get_contents(__DIR__ . "/php/components/default-login.php");
}

$handler->setLogin($login);

$handler->setNav(
    preg_replace(
        "((?s)<a href=\"<rootFolder />/index\.php\">.*?</a>)",
        "<span xml:lang=\"en\">Home</span>",
        file_get_contents(__DIR__ . "/php/components/default-nav.php")
    )
);

$handler->setBreadcrumb(
    str_replace(
        "<percorsoPlaceholder />",
        "<span xml:lang=\"en\">Home</span>",
        file_get_contents(__DIR__ . "/php/components/default-breadcrumb.php")
    )
);

$content = file_get_contents(__DIR__ . "/php/components/home-content.php");

if(key_exists("logged", $_SESSION) && $_SESSION["logged"]) {
    $content = str_replace("<registrandotiPlaceholder/>", "Registrandoti", $content);
} else {
    $content = str_replace("<registrandotiPlaceholder/>", "<a id=\"testo-signup\" href=\"<rootFolder />/php/signup.php\">Registrandoti</a>", $content);
}

$risultato1 = piattoMigliore(1);
$risultato2 = piattoMigliore(2);
$risultato3 = piattoMigliore(3);
$content = str_replace(array("<topPrimoPlaceholder />", "<topSecondoPlaceholder />", "<topDolcePlaceholder />"), array($risultato1, $risultato2, $risultato3), $content);

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/php/components/default-tornaSu.php")
);

$handler->setFooter (
    file_get_contents(__DIR__ . "/php/components/html/footer.html")
);

$handler->send();
