<?php

class DBConnection
{
    //I valori vanno cambiati quando lo passiamo nel server di tecweb. A
    //quel punto impostiamo xampp perché sia uguale, e cambiamo i dati
    //di accesso. localhost rimane uguale perchè lo script e il db
    //girano comunque sulla stessa macchina
    private $host = "localhost";
    private $username;
    private $password;
    private $connection;

    public function __construct()
    {
        $this->username = str_replace("\n", "", file_get_contents(__DIR__ . "/username.txt"));
        $this->password = str_replace("\n", "", file_get_contents(__DIR__ . "/pwd_db-1920.txt"));

        $this->connectTo(str_replace("\n", "", file_get_contents(__DIR__ . "/dbname.txt")));
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
        return $this->connection->query($query);
    }

}
