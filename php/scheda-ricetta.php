<?php
require_once __DIR__ . "/conversioni.php";
function schedaRicetta(string $immagine, string $nome, string $difficolta, string $tempo, string $voto, string $link, int $livello)
{   $nomeRicetta = inserimentoLingua($nome);
    $nomeImmagine = rimozioneLingua($nome);
    return "<img class=\"elenco-immagine\" src=\"$immagine\" alt = \"immagine di $nomeImmagine\" />

        <h$livello class=\"elenco-titolo\"><a href=\"$link\">$nomeRicetta</a></h$livello>
            <dl class=\"elenco-attributi\">
                <dt> Difficolt&agrave; </dt> <dd>$difficolta</dd>
                <dt>Tempo</dt> <dd>$tempo minuti</dd>
                <dt>Voto medio</dt> <dd>" . ($voto == "0" ? "-" : $voto) . " &frasl; 5</dd>
            </dl>
    ";
}
