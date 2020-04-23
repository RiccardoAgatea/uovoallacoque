<?php
require_once __DIR__ . '/db-connection.php';

function contentPortata($portata)
{
    $mysql = new DBconnection;
    $query = "SELECT * FROM ricette WHERE portata=$portata";
    $result = $mysql->query($query);

    $risultato = "";

    if ($result) {
        $risultato .= "<ul id=\"elenco-content\">";

        while ($row = $result->fetch_assoc()) {
            $nome = $row['nome'];
            $difficolta = $row['difficolta'];
            $tempo = $row['tempo'];
            $immagine = $row['img'];
            $id = $row['id'];
            $voto = $mysql->query("SELECT media($id)")->fetch_row()[0];

            $risultato .=
                '<li class=elenco-elemento>' .
                '<img class="elenco-immagine" src="' . $immagine . '" alt = "immagine di ' . $nome . '" />' .
                '<h2 class=elenco-titolo>' . $nome . '</h2>' .
                '<ul class="elenco-attributi">' .
                '<li> Difficolt&agrave;: ' . $difficolta . '</li>' .
                '<li>Tempo: ' . $tempo . '</li>' .
                '<li>Voto medio: ' . $voto . ' &frasl; 5</li>' .
                '</ul>' .
                '</li>';
        }

        $risultato .= "</ul>";
    }

    $mysql->disconnect();

    return $risultato;
}

function contentRicerca($termine)
{
    $mysql = new DBConnection;
    $search_query = "SELECT * FROM ricette WHERE ricette.nome LIKE \"%$termine%\"";
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
            $voto = $mysql->query("SELECT media($id)")->fetch_row()[0];

            $risultato .=
                '<li class=elenco-elemento>' .
                '<img class="elenco-immagine" src="' . $immagine . '" alt = "immagine di ' . $nome . '" />' .
                '<h2 class=elenco-titolo>' . $nome . '</h2>' .
                '<ul class="elenco-attributi">' .
                '<li> Difficolt&agrave;: ' . $difficolta . '</li>' .
                '<li>Tempo: ' . $tempo . '</li>' .
                '<li>Voto medio: ' . $voto . ' &frasl; 5</li>' .
                '</ul>' .
                '</li>';
        }

        $risultato .= "</ul>";
    } else {
        $risultato .= "<p>Spiacenti, non siamo riusciti a trovare quello che cercavi</p>";
    }

    $mysql->disconnect();

    return $risultato;
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
            $votor = $mysql->query("SELECT media($id);")->fetch_row();
            $voto = $votor[0];

            $risultato = $risultato .
                '<li class=elenco-elemento>' .
                '<img class="elenco-immagine" src="' . $immagine . '" alt = "immagine di ' . $nome . '" />' .
                '<h2 class=elenco-titolo>' . $nome . '</h2>' .
                '<ul class="elenco-attributi">' .
                '<li> Difficolt&agrave;: ' . $difficolta . '</li>' .
                '<li>Tempo: ' . $tempo . '</li>' .
                '<li>Voto medio: ' . $voto . ' &frasl; 5</li>' .
                '</ul>' .
                '</li>';
        }
    }

    $mysql->disconnect();

    return $risultato;
}
