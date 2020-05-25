<?php
require_once "./db-connection.php";

$nicknameErr = $emailErr = $difficoltaErr = "";
$nickname = $email = $difficolta = "";

function test_input($data) {
  $data = trim($data); //rimuove gli spazi
  $data = stripslashes($data); 
  $data = htmlspecialchars($data); // à -> &agrave;
  return $data;
}

function checkNickname($stringNickname){ // $stringNickname -> "nickname"
  $connection = new DBConnection(); // oggetto che rappresenta il database
  if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (empty($_POST[$stringNickname])) {
      $nicknameErr = "Il nickname non pu&ograve; essere vuoto";
    } else {
      $nickname = test_input($_POST[$stringNickname]);
      if (!preg_match("/^[A-Za-z0-9]+$/",$nickname)) {
        $nicknameErr = "Il nickname deve contenere solo lettere e numeri";
      }
      if ($connection->query(" SELECT nickname FROM utenti WHERE nickname=\"$nickname\" ")->fetch_row() != null) { 
        $nicknameErr = "Il nickname inserito &egrave; gi&agrave; utilizzato";
        $connection->disconnect();
      }
    } 
    return $nicknameErr;
  }
}



/*
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

  // mail
  if (empty($_POST["email"])) {
    $emailErr = "La e-mail non pu&ograve; essere vuota";
  } else {
    $email = test_input($_POST["email"]);
    // Remove all illegal characters from email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Email non corretta";
    }
  }
  if ($connection->query("SELECT email FROM utenti WHERE email=\"{$_POST['email']}\"")->fetch_row() != null) {
    $_SESSION["wrong-signup"] = true;
    $_SESSION["error"] = "email";
    $_SESSION["email"] = $_POST['email'];
    $_SESSION["password"] = $_POST['password1'];
    $_SESSION["nickname"] = $_POST['nickname'];
    $connection->disconnect();
    $emailErr = "L'indirizzo email inserito risulta gi&agrave; associato ad un utente";
  }




  //difficoltà
  if (empty($_POST["difficolta"])) {
    $difficoltaErr = "La difficolt&agrave; non pu&ograve; essere vuota";
  } else {
    $difficolta = test_input($_POST["difficolta"]);
    $min = 1;
    $max = 5;

    if (filter_var($difficolta, FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min, "max_range"=>$max))) === false) {
        $difficoltaErr = "L'intervallo valido &egrave; tra 1 e 5";
    } else {
        $difficoltaErr = "";
    }
  }
  

}*/

?> 


