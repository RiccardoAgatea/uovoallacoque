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
            '<h2>'.$nome.'</h2>'.
            '<img src="'.$immagine.'" alt = "immagine di '.$nome.'" />'.
            '<ul>'.
            '<li> Difficoltà: '.$difficolta.'</li>'.
            '<li>Tempo: '.$tempo. '</li>'.
            '</ul>';    
        }
        return $risultato;
        
    }
    $mysql->disconnect();
    }
    
?>
