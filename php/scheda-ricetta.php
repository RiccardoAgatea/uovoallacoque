<?php

function schedaRicetta(string $immagine, string $nome, string $difficolta, string $tempo, string $voto, string $link)
{
    return "<img class=\"elenco-immagine\" src=\"$immagine\" alt = \"immagine di $nome\" />
    <div class=elenco-testo>
        <h2 class=elenco-titolo>$nome</h2>
        <ul class=\"elenco-attributi\">
            <li> Difficolt&agrave;: $difficolta</li>
            <li>Tempo: $tempo</li>
            <li>Voto medio: $voto &frasl; 5</li>
            <a href=\"$link\">Apri</a>
        </ul>      
    </div>";
}