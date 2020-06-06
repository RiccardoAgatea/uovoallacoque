<?php
require_once "./template-handler.php";
require_once __DIR__ . "/db-connection.php";
require_once __DIR__ . "/user.php";

session_start();

$handler = new TemplateHandler("..", "xhtml");

$handler->setTitle("Uovo alla Coque");
$handler->setDescription("");

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
$id = $_GET["id"];

if(key_exists("pagina", $_GET)) {
    if (intval($_GET["pagina"]<1)) {
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

    $percorsoBread = "<a href=\"<rootFolder />/index.php\">Home</a> &gt; <a href=\"<rootFolder />/php/elenco.php?id=$portata\">{$portate[$portata - 1]}</a> &gt; $nome";

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
    $tastiVoto = "<p><a href=\"<rootFolder />/php/login.php\">Accedi</a> o <a href=\"<rootFolder />/php/signup.php\">registrati</a> per votare questa ricetta.</p>";

    if (key_exists("logged", $_SESSION) && $_SESSION["logged"]) {

        $queryVoto = $connection->query("SELECT voto FROM voti WHERE voti.utente={$_SESSION["user"]->getId()} AND voti.ricetta=$id");

        if($queryVoto && $queryVoto->num_rows!=0) {
            $row = $queryVoto->fetch_assoc()["voto"];
            $tastiVoto ="<p>Il tuo voto per questa ricetta &egrave; " . strval($row) ."/5</p>";
        }
        else {
            $tastiVoto = "<form action=\"<rootFolder />/php/handle-voto.php?ricetta={$id}\" method=\"post\"><fieldset class=\"fieldset-noborder\">
                <label for=\"pulsante-voto-1\">1 Stella</label><input type=\"radio\" id=\"pulsante-voto-1\" name=\"pulsante-voto\" value=\"1\" />
                <label for=\"pulsante-voto-2\">2 Stelle</label><input type=\"radio\" id=\"pulsante-voto-2\" name=\"pulsante-voto\" value=\"2\" />
                <label for=\"pulsante-voto-3\">3 Stelle</label><input type=\"radio\" id=\"pulsante-voto-3\" name=\"pulsante-voto\" value=\"3\" />
                <label for=\"pulsante-voto-4\">4 Stelle</label><input type=\"radio\" id=\"pulsante-voto-4\" name=\"pulsante-voto\" value=\"4\" />
                <label for=\"pulsante-voto-5\">5 Stelle</label><input type=\"radio\" id=\"pulsante-voto-5\" name=\"pulsante-voto\" value=\"5\" />
                <input type=\"submit\" value= \"vota\"/>
            </fieldset></form>";
        }


        $pagina = intval($_GET["pagina"]);
        $num = 10;
        $min = ($pagina - 1) * $num;
        $corrente = $_GET["pagina"];

        if (!key_exists("idcommento", $_GET)) {
            $nuovoCommento = file_get_contents(__DIR__ . "/components/inserimento-commento.php");
            $nuovoCommento = str_replace("<ricettaPlaceholder />", $_GET["id"], $nuovoCommento);
            $commenti .= $nuovoCommento;
        } else {
            $idcommento = $_GET['idcommento'];
            $commentoResult = $connection->query("SELECT commenti.contenuto AS testo, commenti.utente AS idutente FROM commenti WHERE commenti.id=$idcommento");

            if (!$commentoResult || $commentoResult->num_rows==0) {
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
            $modificaCommento = str_replace("<idCommentoPlaceholder />", $idcommento, $modificaCommento);
            $modificaCommento = str_replace("<paginaPlaceholder />", $corrente, $modificaCommento);
            $modificaCommento = str_replace("<testoCommentoDaModificarePlaceholder />", $testo, $modificaCommento);
            $commenti .= $modificaCommento;
        }

        $resultCommenti = $connection->query("SELECT commenti.modificato AS edited, commenti.id AS id, utenti.id AS idutente, utenti.img AS img, utenti.nickname AS nick, commenti.contenuto AS testo, commenti.dataeora AS dataora FROM commenti, utenti WHERE commenti.ricetta={$_GET["id"]} and utenti.id=commenti.utente ORDER BY dataora DESC LIMIT $min, $num");
        $totPagine = ceil($connection->query("SELECT COUNT(*) FROM commenti WHERE commenti.ricetta={$_GET["id"]}")->fetch_row()[0] / $num);

        if ($resultCommenti) {
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
                    $commentiContent = str_replace("<modificaCommentoPlaceholder />", "<form method=\"post\" action=\"<rootFolder />/php/setup-modifica-commento.php?ricetta={$_GET["id"]}&amp;idcommento=$idcommento&amp;pagina=$corrente\"><fieldset class=\"fieldset-noborder\"><input type=\"submit\" value=\"Modifica\"/></fieldset></form>", $commentiContent);
                    $commentiContent = str_replace("<eliminaCommentoPlaceholder />", "<form method=\"post\" action=\"<rootFolder />/php/handle-elimina-commento.php?ricetta={$_GET["id"]}&amp;idcommento=$idcommento\"><fieldset class=\"fieldset-noborder\"><input type=\"submit\" value=\"Elimina\"/></fieldset></form>", $commentiContent);
                } else {
                    $commentiContent = str_replace("<modificaCommentoPlaceholder />", "", $commentiContent);
                    $commentiContent = str_replace("<eliminaCommentoPlaceholder />", "", $commentiContent);
                }

                $commenti .= "<li>" . $commentiContent . "</li>";
            }
            $commenti .= "</ul>";
            $commenti .= getPaginazione($corrente, $totPagine, $id);

        } else {
            if($corrente != 1) {
                $commenti .= "<p>Sei andato troppo avanti! Non ci sono commenti qui.</p>";
            }
            else
            $commenti .= "<p>Scrivi il primo commento per questa ricetta!</p>";
        }

    } else {
        $commenti .= "<p>Per visualizzare e inserire i commenti, <a href=\"<rootFolder />/php/login.php\">accedi</a> o <a href=\"<rootFolder />/php/signup.php\">registrati</a>.</p>";
    }

    $content = str_replace("<nomeRicettaPlaceholder />", $nome, $content);

    $content = str_replace("<imgSrcPlaceholder />", $img, $content);
    $content = str_replace("<difficoltàPlaceholder />", $difficolta, $content);
    $content = str_replace("<tempoPlaceholder />", "$tempo minuti", $content);
    $content = str_replace("<ingredientiPlaceholder />", $listaIngredienti, $content);
    $content = str_replace("<proceduraPlaceholder />", $procedimento, $content);
    $content = str_replace("<commentiPlaceholder />", $commenti, $content);
    $content = str_replace("<votoPlaceholder />", $tastiVoto, $content);
}

if(key_exists("logged", $_SESSION) && $_SESSION["logged"] && $_SESSION["user"]->getAdmin()){
    $nrPagina = $_GET['pagina'];
    $editPath = "<rootFolder />/php/edit-ricetta.php?id=$id&amp;pagina=$nrPagina";
    $content = str_replace("<editPlaceholder />", "<a href=\"$editPath\"> Modifica la ricetta </a> ", $content);
    $content = str_replace("<removePlaceholder />", "<a href=\"<rootFolder />/php/handle-rimuovi-ricetta.php?removeId=$id&amp;portata=$portata\"> Elimina la ricetta </a> ", $content);
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

function getPaginazione($corrente, $totPagine, $id)
{
    if ($totPagine == 1) {
        $out = "";
    } else {
        $out = "<ul class=\"paginazione\">";
        if ($corrente != 1) {
            $out .= "<li><a href=\"?";
            $out .= "id=$id";
            $out .= "&amp;pagina=" . strval($corrente - 1) . "\">Precedente</a></li>";
        }
        for ($i = 1; $i <= $totPagine; $i++) {
            if ($i != $corrente) {
                $out .= "<li><a href=\"?";
                $out .= "id=$id";
                $out .= "&amp;pagina=" . $i . "\">" . $i . "</a></li>";
            } else {
                $out .= "<li>$i</li>";
            }
        }
        if ($corrente < $totPagine) {
            $out .= "<li><a href=\"?";
            $out .= "id=$id";
            $out .= "&amp;pagina=" . strval($corrente + 1) . "\">Successiva</a></li>";
        }
        $out .= "</ul>";
    }

    return $out;
}

