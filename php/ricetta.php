<?php
require_once "./template-handler.php";
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";
require_once __DIR__ . "/conversioni.php";
require_once __DIR__ . "/paginazione.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$login = "";

if (key_exists("logged", $_SESSION) && $_SESSION["logged"]) {
    $login .= file_get_contents(__DIR__ . "/components/personal-login.php");

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

if (!key_exists("id", $_GET)) {
    header("Location: ../400.php");
    exit;
}
$id = $_GET["id"];

if (key_exists("pagina", $_GET)) {
    if (intval($_GET["pagina"] < 1)) {
        header("Location: ../404.php");
        exit;
    }
}

$result = $connection->query("SELECT * FROM ricette WHERE id={$_GET["id"]}")->fetch_assoc();
if (!$result) {
    $connection->disconnect();
    header("Location: ../404.php");
    exit;
} else {
    $nome = inserimentoLingua($result["nome"]);
    $nomeClean = rimozioneLingua($result["nome"]);
    $imgAlt = "immagine di " . rimozioneLingua($result["nome"]);
    $portata = $result["portata"];
    $difficolta = $result["difficolta"];
    $tempo = $result["tempo"];
    $votoMedio = $connection->query("SELECT media({$_GET['id']})")->fetch_row()[0];
    if (intval($votoMedio) == 0) {
        $votoMedio = "-";
    } else {
        $votoMedio = number_format($votoMedio, 1);
    }
    $img = $result["img"];
    $ingredienti = inserimentoLingua($result["ingredienti"]);
    $procedimento = inserimentoLingua($result["procedimento"]);
    $keywords = $result["keywords"];
    $author = $result["author"];

    $handler->setTitle($nomeClean . " | Uovo alla Coque");
    $handler->setAuthor($author);
    $handler->setDescription("Pagina che presenta la ricetta $nomeClean");
    $handler->setOtherMeta("<meta name=\"keywords\" content=\"$keywords\" />");

    $portate = [
        "Primi piatti",
        "Secondi piatti",
        "Dessert",
    ];

    $percorsoBread = "<a xml:lang=\"en\" href=\"<rootFolder />/index.php\">Home</a> &gt; <a href=\"<rootFolder />/php/elenco.php?id=$portata\">{$portate[$portata - 1]}</a> &gt; $nome";

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
    $tastiVoto = "<p class=\"tasti-voto-avviso\"><a href=\"<rootFolder />/php/login.php\">Accedi</a> o <a href=\"<rootFolder />/php/signup.php\">registrati</a> per votare questa ricetta.</p>";

    if (key_exists("logged", $_SESSION) && $_SESSION["logged"]) {

        $queryVoto = $connection->query("SELECT voto FROM voti WHERE voti.utente={$_SESSION["user"]->getId()} AND voti.ricetta=$id");

        if ($queryVoto && $queryVoto->num_rows != 0) {
            $row = $queryVoto->fetch_assoc()["voto"];
            $tastiVoto = "<p>Il tuo voto per questa ricetta &egrave; " . strval($row) . "/5</p>";
        } else {
            $tastiVoto = "<form action=\"<rootFolder />/php/handle-voto.php?ricetta={$id}\" method=\"post\"><fieldset class=\"fieldset-noborder print-hide\">
                <legend>Vota questa ricetta</legend>
                <ul class=\"tasti-voto\">
                <li>
                    <label for=\"pulsante-voto-1\" class=\"label-voto\">1 Stella</label><input type=\"radio\" id=\"pulsante-voto-1\" class=\"pulsante-voto\" checked=\"checked\" name=\"pulsante-voto\" value=\"1\" />
                </li>
                <li>
                    <label for=\"pulsante-voto-2\" class=\"label-voto\">2 Stelle</label><input type=\"radio\" id=\"pulsante-voto-2\" class=\"pulsante-voto\" name=\"pulsante-voto\" value=\"2\" />
                </li>
                <li>
                    <label for=\"pulsante-voto-3\" class=\"label-voto\">3 Stelle</label><input type=\"radio\" id=\"pulsante-voto-3\" class=\"pulsante-voto\" name=\"pulsante-voto\" value=\"3\" />
                </li>
                <li>
                    <label for=\"pulsante-voto-4\" class=\"label-voto\">4 Stelle</label><input type=\"radio\" id=\"pulsante-voto-4\" class=\"pulsante-voto\" name=\"pulsante-voto\" value=\"4\" />
                </li>
                <li>
                    <label for=\"pulsante-voto-5\" class=\"label-voto\">5 Stelle</label><input type=\"radio\" id=\"pulsante-voto-5\" class=\"pulsante-voto\" name=\"pulsante-voto\" value=\"5\" />
                </li>
                </ul>
                <input class=\"pulsante-voto-submit\" type=\"submit\" value= \"vota\"/>
            </fieldset></form>";
        }
        $pagina = 0;
        if (key_exists("pagina", $_GET)) {
            $pagina = intval($_GET["pagina"]);
        }
        else {
            $pagina = 1;
        }
        $num = 5;
        $min = ($pagina - 1) * $num;
        $corrente = $pagina;

        if (!key_exists("idcommento", $_GET)) {
            $nuovoCommento = file_get_contents(__DIR__ . "/components/inserimento-commento.php");
            $nuovoCommento = str_replace("<ricettaPlaceholder />", $_GET["id"], $nuovoCommento);
            $nuovoCommento = str_replace("<paginaRicettaPlaceholder />", $corrente, $nuovoCommento);
            $commenti .= $nuovoCommento;
        } else {
            $idcommento = $_GET['idcommento'];
            $commentoResult = $connection->query("SELECT commenti.contenuto AS testo, commenti.utente AS idutente FROM commenti WHERE commenti.id=$idcommento");

            if (!$commentoResult || $commentoResult->num_rows == 0) {
                $connection->disconnect();
                header("Location: ../404.php");
                exit;
            }

            $row = $commentoResult->fetch_assoc();

            $idUtente = $row['idutente'];

            if ($idUtente != $_SESSION['user']->getId()) {
                $connection->disconnect();
                header("Location: ../403.php");
                exit;
            }

            $testo = $row['testo'];

            $modificaCommento = file_get_contents(__DIR__ . "/components/modifica-commento.php");
            $modificaCommento = str_replace("<ricettaPlaceholder />", $_GET["id"], $modificaCommento);
            $modificaCommento = str_replace("<paginaRicettaPlaceholder />", $corrente, $modificaCommento);
            $modificaCommento = str_replace("<idCommentoPlaceholder />", $idcommento, $modificaCommento);
            $modificaCommento = str_replace("<paginaPlaceholder />", $corrente, $modificaCommento);
            $modificaCommento = str_replace("<testoCommentoDaModificarePlaceholder />", $testo, $modificaCommento);
            $commenti .= $modificaCommento;
        }

        $resultCommenti = $connection->query("SELECT commenti.modificato AS edited, commenti.id AS id, utenti.id AS idutente, utenti.img AS img, utenti.nickname AS nick, commenti.contenuto AS testo, commenti.dataeora AS dataora FROM commenti, utenti WHERE commenti.ricetta={$_GET["id"]} and utenti.id=commenti.utente ORDER BY dataora DESC LIMIT $min, $num");
        $totPagine = ceil($connection->query("SELECT COUNT(*) FROM commenti WHERE commenti.ricetta={$_GET["id"]}")->fetch_row()[0] / $num);

        if ($resultCommenti && $resultCommenti->num_rows) {
            $content = str_replace("<printHidePlaceholder />", "", $content);
            $commenti .= "<ul class=\"commenti\">";

            while ($row = $resultCommenti->fetch_assoc()) {
                $immagine = $row['img'];
                $nickname = $row['nick'];
                $testo = $row['testo'];
                $dataora = $row['dataora'];
                $idUtente = $row['idutente'];
                $idcommento = $row['id'];
                $tmpEdited = $row['edited'];
                $edited = "";

                if ($tmpEdited) {
                    $edited .= "(modificato)";
                }

                $commentiContent = file_get_contents(__DIR__ . "/components/commento-content.php");

                $commentiContent = str_replace("<immagineUtentePlaceholder />", $immagine, $commentiContent);
                $commentiContent = str_replace("<nomeUtentePlaceholder />", $nickname, $commentiContent);
                $commentiContent = str_replace("<testoCommentoPlaceholder />", $testo, $commentiContent);
                $commentiContent = str_replace("<dataOraCommentoPlaceholder />", $dataora, $commentiContent);
                $commentiContent = str_replace("<editedPlaceholder />", $edited, $commentiContent);

                if ($idUtente == $_SESSION['user']->getId()) {
                    $commentiContent = str_replace("<modificaCommentoPlaceholder />", "<form class=\"print-hide\" method=\"post\" action=\"<rootFolder />/php/setup-modifica-commento.php?ricetta={$_GET["id"]}&amp;idcommento=$idcommento&amp;pagina=$corrente\"><fieldset class=\"fieldset-noborder\"><input class=\"commento-tasto-modifica\" type=\"submit\" value=\"Modifica\"/></fieldset></form>", $commentiContent);
                } else {
                    $commentiContent = str_replace("<modificaCommentoPlaceholder />", "", $commentiContent);
                }

                if ($idUtente == $_SESSION['user']->getId() || $_SESSION['user']->getAdmin()) {
                    $commentiContent = str_replace("<eliminaCommentoPlaceholder />", "<form class=\"print-hide\" method=\"post\" action=\"<rootFolder />/php/handle-elimina-commento.php?ricetta={$_GET["id"]}&amp;idcommento=$idcommento\"><fieldset class=\"fieldset-noborder\"><input class=\"commento-tasto-elimina\" type=\"submit\" value=\"Elimina\"/></fieldset></form>", $commentiContent);
                } else {
                    $commentiContent = str_replace("<eliminaCommentoPlaceholder />", "", $commentiContent);
                }

                $commenti .= "<li class=\"commento\">" . $commentiContent . "</li>";
            }
            $commenti .= "</ul>";
            $commenti .= getPaginazioneCommenti($corrente, $totPagine, $id);

        } else {
            if ($corrente != 1) {
                $commenti .= "<p class=\"print-hide\">Sei andato troppo avanti! Non ci sono commenti qui.</p>";
            } else {
                $commenti .= "<p class=\"print-hide\">Scrivi il primo commento per questa ricetta!</p>";
            }
            $content = str_replace("<printHidePlaceholder />", " print-hide", $content);

        }

    } else {
        $content = str_replace("<printHidePlaceholder />", " print-hide", $content);
        $commenti .= "<p class=\"commenti-avviso print-hide\">Per visualizzare e inserire i commenti, <a href=\"<rootFolder />/php/login.php\">accedi</a> o <a href=\"<rootFolder />/php/signup.php\">registrati</a>.</p>";
    }

    $content = str_replace("<nomeRicettaPlaceholder />", $nome, $content);
    $content = str_replace("<imgAltPlaceholder />", $imgAlt, $content);
    $content = str_replace("<imgSrcPlaceholder />", $img, $content);
    $content = str_replace("<difficoltàPlaceholder />", $difficolta, $content);
    $content = str_replace("<tempoPlaceholder />", "$tempo minuti", $content);
    $content = str_replace("<votoMedioRicettaPlaceholder />", "$votoMedio /5", $content);
    $content = str_replace("<ingredientiPlaceholder />", $listaIngredienti, $content);
    $content = str_replace("<proceduraPlaceholder />", $procedimento, $content);
    $content = str_replace("<commentiPlaceholder />", $commenti, $content);
    $content = str_replace("<votoPlaceholder />", $tastiVoto, $content);

    if(key_exists("errorTesto", $_SESSION) && $_SESSION["errorTesto"] != ""){ // dovrebbe funzionare sia per insert che edit
        $content = str_replace("<errorCommentoPlaceholder />", $_SESSION["errorTesto"], $content);
    } else {
        $content = str_replace("<errorCommentoPlaceholder />", "", $content);
    }
}

if (key_exists("logged", $_SESSION) && $_SESSION["logged"] && $_SESSION["user"]->getAdmin()) {
    $nrPagina = $pagina;
    $editPath = "<rootFolder />/php/edit-ricetta.php?id=$id&amp;pagina=$nrPagina";
    $content = str_replace("<editPlaceholder />", "<a id=\"link-modifica-ricetta\" class=\"print-hide\" href=\"$editPath\"> Modifica la ricetta </a> ", $content);
    $content = str_replace("<removePlaceholder />", "<a id=\"link-elimina-ricetta\" class=\"print-hide\" href=\"<rootFolder />/php/handle-rimuovi-ricetta.php?removeId=$id&amp;portata=$portata\"> Elimina la ricetta </a> ", $content);
} else {
    $content = str_replace("<editPlaceholder />", "", $content);
    $content = str_replace("<removePlaceholder />", "", $content);
}

$handler->setContent($content);

$handler->setBackToTop(
    file_get_contents(__DIR__ . "/components/default-tornaSu.php")
);
$handler->setFooter(
    file_get_contents(__DIR__ . "/components/html/footer.html")
);

$connection->disconnect();

$handler->send();

