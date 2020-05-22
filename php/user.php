<?php
require_once __DIR__ . "/db-connection.php";

class User
{
    private $id;
    private $nickname;
    private $password;
    private $email;
    private $picture;
    private $admin;

    public function __construct(string $email)
    {
        $connection = new DBConnection();
        $result = $connection->query("SELECT id, nickname, img, passw, ad FROM utenti WHERE email=\"{$email}\"");

        if (!$result) {
            exit;
            throw new Exception("User doesn't exist", 1);
        }

        $user_row = $result->fetch_assoc();

        $this->id = intval($user_row['id']);
        $this->nickname = $user_row['nickname'];
        $this->password = $user_row['passw'];
        $this->email = $email;
        $this->picture = $user_row['img'];
        $this->admin = boolval($user_row['ad']);

        $connection->disconnect();

    }

    public function getId()
    {
        return $this->id;
    }

    public function getNickname()
    {
        return $this->nickname;
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
    public function getAdmin()
    {
        return $this->admin;
    }

    public function update()
    {
        $connection = new DBConnection();

        $result = $connection->query("SELECT nickname, img, email, passw, ad FROM utenti WHERE id={$this->id}");

        $user_row = $result->fetch_assoc();

        $this->nickname = $user_row['nickname'];
        $this->password = $user_row['passw'];
        $this->email = $user_row['email'];
        $this->picture = $user_row['img'];
        $this->admin = boolval($user_row['ad']);

        $connection->disconnect();

    }
}
