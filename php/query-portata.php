<?php
    include (__DIR__ . '/db-connection.php');
    $mysql=DBconnection::connectTo("test-data");
    function contentPortata($i) {
    $query="SELECT * FROM ricette WHERE portata=$i";
    
    $risultato = "";
    if ($result=$mysql->query($query))
    {
        while ($row=$result->fetc_assoc())
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
        $this -> $risultato;
    }
    
    }
    DBConnection::disconnect();
?>
