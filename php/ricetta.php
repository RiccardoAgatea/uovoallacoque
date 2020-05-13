<?php
require_once "./template-handler.php";
require_once __DIR__ . "/db-connection.php";
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

$content = file_get_contents(__DIR__ . "/components/ricetta-content.php");

$connection = new DBConnection();
$id = $_GET["id"];

$result = $connection->query("SELECT * FROM ricette WHERE id={$_GET["id"]}")->fetch_assoc();

if (!$result) {
    // redirect 404
} else {
    $nome = $result["nome"];
    $portata = $result["portata"];
    $difficolta = $result["difficolta"];
    $tempo = $result["tempo"];
    $img = $result["img"];
    $ingredienti = $result["ingredienti"];
    $procedimento = $result["procedimento"];

    $portate = [
        "Primi piatti",
        "Secondi piatti",
        "Dessert",
    ];

    $percorsoBread = "<a href=\"<rootFolder />/index.php\">Home</a> &gt; <a href=\"<rootFolder />/php/elenco.php?id=$portata\">{$portate[$portata-1]}</a> &gt; $nome";

    $handler->setBreadcrumb(
        str_replace(
            "<percorsoPlaceholder />",
            $percorsoBread,
            file_get_contents(__DIR__ . "/components/default-breadcrumb.php")
        )
    );

    $listaIngredienti = "";

    foreach (explode(",", $ingredienti) as $ing) {
        $listaIngredienti .= "<li>$ing</li>";
    }
    
    $commenti = "";

    if (key_exists("logged", $_SESSION) && $_SESSION["logged"]) {

        
        $nuovoCommento =file_get_contents(__DIR__ . "/components/inserimento-commento.php");
        $nuovoCommento = str_replace("<ricettaPlaceholder />", $_GET["id"], $nuovoCommento);
        $commenti .= $nuovoCommento;
        $pagina = intval($_GET["pagina"]);
        $num = 2;
        $min=($pagina - 1) * $num;
        $corrente = $_GET["pagina"];


        $resultCommenti = $connection->query("SELECT utenti.img AS img, utenti.nickname AS nick, commenti.contenuto AS testo, commenti.dataeora AS dataora FROM commenti, utenti WHERE commenti.ricetta={$_GET["id"]} and utenti.id=commenti.utente ORDER BY dataora DESC LIMIT $min, $num");
        $totPagine = ceil($connection->query("SELECT COUNT(*) FROM commenti WHERE commenti.ricetta={$_GET["id"]}")->fetch_row()[0] / $num);

        if ($resultCommenti) {
            $commenti .= "<ul class=\"commenti\">";

            while ($row= $resultCommenti->fetch_assoc()) {
                $immagine = $row['img'];
                $nickname = $row['nick'];
                $testo = $row ['testo'];
                $dataora = $row['dataora'];

                $commentiContent = file_get_contents(__DIR__ . "/components/commento-content.php");

                $commentiContent = str_replace("<immagineUtentePlaceholder />", $immagine, $commentiContent);
                $commentiContent = str_replace("<nomeUtentePlaceholder />", $nickname, $commentiContent);
                $commentiContent = str_replace("<testoCommentoPlaceholder />", $testo, $commentiContent);
                $commentiContent = str_replace("<dataOraCommentoPlaceholder />", $dataora, $commentiContent);

                $commenti .= "<li>" . $commentiContent . "</li>";
            }
            $commenti .= "</ul>";
            $commenti.= getPaginazione($corrente, $totPagine, $id);

        }


        else {
            $commenti .= "<p>Scrivi il primo commento per questa ricetta!</p>";
        }

    }
    else {
        $commenti .= "<p>Per visualizzare e inserire i commenti, <a href=\"<rootFolder />/php/login.php\">accedi</a> o <a href=\"<rootFolder />/php/signup.php\">registrati</a>.</p>";
    }


    $content = str_replace("<nomeRicettaPlaceholder />", $nome, $content);
    $content = str_replace("<imgSrcPlaceholder />", $img, $content);
    $content = str_replace("<difficoltàPlaceholder />", $difficolta, $content);
    $content = str_replace("<tempoPlaceholder />", "$tempo minuti", $content);
    $content = str_replace("<ingredientiPlaceholder />", $listaIngredienti, $content);
    $content = str_replace("<proceduraPlaceholder />", $procedimento, $content);
    $content = str_replace("<commentiPlaceholder />", $commenti, $content);
}

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);
$handler->setFooter ( 
    file_get_contents(__DIR__ . "/components/html/footer.html")
);

$handler->send();

function getPaginazione($corrente, $totPagine, $id)
{
    if ($totPagine==1) {
        $out="";
    }
    else {
        $out = "<ul class=\"paginazione\">";
        if ($corrente != 1) {
            $out .= "<li><a href=\"?";
            $out .= "id=$id";
            $out .= "&pagina=" . strval($corrente-1) . "\">Precedente</a></li>";
        }
    for ($i = 1; $i <= $totPagine; $i++) {
        if ($i != $corrente) {
            $out .= "<li><a href=\"?";
            $out .= "id=$id";
            $out .= "&pagina=" . $i . "\">" . $i . "</a></li>";
        } else {
            $out .= "<li>$i</li>";
        }
    }
    if ($corrente != $totPagine) {
        $out .= "<li><a href=\"?";
        $out .= "id=$id";
        $out .= "&pagina=" . strval($corrente+1) . "\">Successiva</a></li>";
    }
    $out .= "</ul>";
    }
    

    return $out;
}
