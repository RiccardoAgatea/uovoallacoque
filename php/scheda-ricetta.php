<?php

function schedaRicetta(string $immagine, string $nome, string $difficolta, string $tempo, string $voto, string $link, int $livello)
{
    return "<img class=\"elenco-immagine\" src=\"$immagine\" alt = \"immagine di $nome\" />
    
        <h$livello class=elenco-titolo>$nome</h$livello>
            <dl class=\"elenco-attributi\">
                <dt> Difficolt&agrave; </dt> <dd>$difficolta</dd>
                <dt>Tempo</dt> <dd>$tempo</dd>
                <dt>Voto medio</dt> <dd>$voto &frasl; 5</dd>
            </dl>   
            <a id=\"link-apri\" href=\"$link\">Apri</a>  
    ";
}