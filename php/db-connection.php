<?php

class DBConnection
{
    //I valori vanno cambiati quando lo passiamo nel server di tecweb. A
    //quel punto impostiamo xampp perché sia uguale, e cambiamo i dati
    //di accesso. localhost rimane uguale perchè lo script e il db
    //girano comunque sulla stessa macchina
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $connection;

    public function __construct()
    {
        $this->connectTo("tecweb");
    }

    public function connectTo(string $database)
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $database);

        if (!$this->connection) {
            throw new RuntimeException("Couldn't connect to database");
        }
    }

    public function disconnect()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }

    public function query($query)
    {
        return $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
    }
    
    public function risultato($query) {
        return $this->connection->query($query);
    }
}
