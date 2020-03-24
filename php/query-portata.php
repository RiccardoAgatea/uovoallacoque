<?php
    include (__DIR__ . '/db-connection.php');
    
    function contentPortata($i) {
    $mysql= new DBconnection;
    $query="SELECT * FROM ricette WHERE portata=$i";
    
    $risultato = "";
    if ($result=$mysql->risultato($query))
    {
        while ($row=$result->fetch_assoc())
        {
            $nome = $row['nome'];
            $difficolta = $row['difficolta'];
            $tempo = $row['tempo'];
            $immagine = $row['img'];

            $risultato = $risultato.
            '<li class=elenco-elemento>'.
                '<img class="elenco-immagine" src="'.$immagine.'" alt = "immagine di '.$nome.'" />'.
                '<h2 class=elenco-titolo>'.$nome.'</h2>'.               
                '<ul class="elenco-attributi">'.
                    '<li> Difficolt&agrave;: '.$difficolta.'</li>'.
                    '<li>Tempo: '.$tempo. '</li>'.
                '</ul>'.
            '</li>' ;           ;    
        }
        return $risultato;
        
    }
    $mysql->disconnect();
    }
    
?>
