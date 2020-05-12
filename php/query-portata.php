<?php
require_once __DIR__ . '/db-connection.php';
require_once __DIR__ . '/scheda-ricetta.php';

function contentPortata($portata, $min, $num)
{
    $mysql = new DBconnection;

    $totPagine = ceil($mysql->query("SELECT COUNT(*) FROM ricette WHERE portata=$portata")->fetch_row()[0] / $num);

    $query = "SELECT * FROM ricette WHERE portata=$portata ORDER BY id DESC LIMIT $min,$num";
    $result = $mysql->query($query);

    $risultato = "";

    if ($result) {
        $risultato .= "<ul id=\"elenco-content\">";

        while ($row = $result->fetch_assoc()) {
            $nome = $row['nome'];
            $difficolta = $row['difficolta'];
            $tempo = $row['tempo'];
            $immagine = $row['img'];

            if ($immagine == null) {

            }

            $votor = $mysql->query("SELECT media({$row['id']});")->fetch_row();
            $voto = $votor[0];
            $voto = number_format($voto, 1);
            $id = $row['id'];
            $link = "<rootFolder />/php/ricetta.php?id=$id";
            $livello = 2;

            $risultato .=
            '<li class=elenco-elemento>' .
            schedaRicetta($immagine, $nome, $difficolta, $tempo, $voto, $link, $livello) .
                '</li>';
        }

        $risultato .= "</ul>";
    }

    $mysql->disconnect();

    return [$risultato, $totPagine];
}

function contentRicerca($termine, $min, $num)
{
    $mysql = new DBConnection;

    $totPagine = ceil($mysql->query("SELECT COUNT(*)FROM ricette WHERE ricette.nome LIKE \"%$termine%\"")->fetch_row()[0] / $num);

    $search_query = "SELECT * FROM ricette WHERE ricette.nome LIKE \"%$termine%\" ORDER BY id DESC LIMIT $min,$num";
    $result = $mysql->query($search_query);

    $risultato = "";

    if (!$result) {
        throw new Exception("Errore nel ritorno dei risultati della ricerca dal db");
    }

    if ($result->num_rows != 0) {
        $risultato .= "<ul id=\"elenco-content\">";

        while ($row = $result->fetch_assoc()) {
            $nome = $row['nome'];
            $difficolta = $row['difficolta'];
            $tempo = $row['tempo'];
            $immagine = $row['img'];
            $id = $row['id'];
            $votor = $mysql->query("SELECT media({$row['id']});")->fetch_row();
            $voto = $votor[0];
            $voto = number_format($voto, 1);
            $livello = 2;

            $link = "<rootFolder />/php/ricetta.php?id=$id";

            $risultato .=
            '<li class=elenco-elemento>' .
            schedaRicetta($immagine, $nome, $difficolta, $tempo, $voto, $link, $livello) .
                '</li>';
        }

        $risultato .= "</ul>";
    } else {
        $risultato .= "<p>Spiacenti, non siamo riusciti a trovare quello che cercavi</p>";
    }

    $mysql->disconnect();

    return [$risultato, $totPagine];
}

function piattoMigliore($portata)
{
    $mysql = new DBconnection;
    $query = "SELECT * FROM ricette WHERE ricette.portata=$portata ORDER BY media(ricette.id) DESC LIMIT 1";

    $risultato = "";
    if ($result = $mysql->query($query)) {
        while ($row = $result->fetch_assoc()) {
            $nome = $row['nome'];
            $immagine = $row['img'];
            $nome = $row['nome'];
            $difficolta = $row['difficolta'];
            $tempo = $row['tempo'];
            $immagine = $row['img'];
            $id = $row['id'];
            $livello = 3;

            $votor = $mysql->query("SELECT media({$row['id']});")->fetch_row();
            $voto = $votor[0];
            $voto = number_format($voto, 1);
            $link = "<rootFolder />/php/ricetta.php?id=$id";

            $risultato = $risultato .
            '<div class=elenco-elemento>' .
            schedaRicetta($immagine, $nome, $difficolta, $tempo, $voto, $link, $livello) .
                '</div>';
        }
    }

    $mysql->disconnect();

    return $risultato;
}

function getPaginazione($totPagine, $tipo, $corrente)
{
    if ($totPagine==1) {
        $out="";
    }
    else {
        $out = "<ul class=\"paginazione\">";
        if ($corrente != 1) {
            $out .= "<li><a href=\"?";
            if ($tipo == 0) {
                $out .= "termine_ricerca={$_GET["termine_ricerca"]}";
            } else {
                $out .= "id=$tipo";
            }
            $out .= "&pagina=" . strval($corrente-1) . "\">Precedente</a></li>";
        }
    for ($i = 1; $i <= $totPagine; $i++) {
        if ($i != $corrente) {
            $out .= "<li><a href=\"?";
            if ($tipo == 0) {
                $out .= "termine_ricerca={$_GET["termine_ricerca"]}";
            } else {
                $out .= "id=$tipo";
            }
            $out .= "&pagina=" . $i . "\">" . $i . "</a></li>";
        } else {
            $out .= "<li>$i</li>";
        }
    }
    if ($corrente != $totPagine) {
        $out .= "<li><a href=\"?";
        if ($tipo == 0) {
            $out .= "termine_ricerca={$_GET["termine_ricerca"]}";
        } else {
            $out .= "id=$tipo";
        }
        $out .= "&pagina=" . strval($corrente+1) . "\">Successiva</a></li>";
    }
    $out .= "</ul>";
    }
    

    return $out;
}
