<?php
require_once "./db-connection.php";

class User
{
    private $id;
    private $nickname;
    private $password;
    private $email;
    private $picture;

    public function __construct(string $email)
    {
        $result = (new DBConnection())->query("SELECT id, nickname, img, passw FROM utenti WHERE email=\"{$email}\"");

        if (!$result) {
            throw new Exception("User doesn't exist", 1);
        }

        $user_row = $result->fetch_assoc();

        $this->id = $user_row['id'];
        $this->nickname = $user_row['nickname'];
        $this->password = $user_row['passw'];
        $this->email = $email;
        $this->picture = $user_row['img'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNickname()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPicture()
    {
        return $this->picture;
    }
}
