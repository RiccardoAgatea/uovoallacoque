<?php
require_once "./template-handler.php";
require_once __DIR__ . "/user.php";

session_start();

if(!key_exists("logged", $_SESSION) || !$_SESSION["logged"]) {
    header("Location: ../401.php");
    exit;
}

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Utente | Modifica utente | Uovo alla Coque");
$handler->setAuthor("Agatea Riccardo, Bosinceanu Ecaterina, Righetto Sara, Schiavon Rebecca");
$handler->setDescription("Pagina per modificare le informazioni dell'utente");
$handler->setOtherMeta("<meta name=\"robots\" content=\"noindex, nofollow\" />");

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
        "<a href=\"<rootFolder />/php/utente.php\">Utente</a>  &gt; Modifica utente",
        file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
    )
);

$content = file_get_contents(__DIR__ . "/components/modifica-utente-content.php");
if (key_exists("wrong", $_SESSION)) {
    $content = str_replace("<errorPlaceholder />", "<p>".$_SESSION["wrong"]."</p>", $content);

    unset($_SESSION["wrong"]);
} else if (key_exists("complete", $_SESSION) && $_SESSION["complete"]){
    $content = str_replace("<errorPlaceholder />", "<p>Modifica completata con successo</p>", $content);

    unset($_SESSION["complete"]);
}else{
    $content = str_replace("<errorPlaceholder />", "", $content);
}

$handler->setContent($content);

$handler->setAnnulla(
    str_replace(
        "<linkPlaceholder/>",
        "<rootFolder />/php/utente.php",
        file_get_contents(__DIR__ . "/components/default-annulla.php")
    )
);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);

$handler->setFooter(
    file_get_contents(__DIR__ . "/components/html/footer.html")
);

$handler->send();
