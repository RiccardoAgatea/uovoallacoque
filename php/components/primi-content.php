    <?php
    include 'connection.php'
        $query="SELECT * FROM PRIMI"
        echo '<div id="content">
        <h1>Primi Piatti</h1>'

        if ($result=$mysql->query($query))
        {
            while ($row=$result->fetc_assoc())
            {
                $nome = $row['Nome'];





                echo '<h2>'.$nome.'</h2>';
                
            }
        }

    ?>
    
</div>