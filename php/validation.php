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

function checkEmail($stringEmail){
  $connection = new DBConnection();
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["REQUEST_METHOD"])){
      $emailErr = "La mail non pu&ograve; essere vuota";
    }
    else{
      $email = test_input($_POST[$stringEmail]);
      if(!preg_match("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$",$email)){
        $emailErr = "Email incorretta";
      }
      if ($connection->query(" SELECT email FROM utenti WHERE email=\"$email\" ")->fetch_row() != null) { 
        $emailErr = "&Egrave; gi&agrave; presente un account con questa email";
        $connection->disconnect();
      }
    }
    return $emailErr;
  }
}

function checkPassword($stringPassword, $stringPasswordCofirm){
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["REQUEST_METHOD"])){
      $passwordErr = "La password non pu&ograve; essere un campo vuoto";
    }
    else{
      $password = test_input($_POST[$stringPassword]);
      $passwordConfirm = test_input($_POST[$stringPasswordConfirm]);
      if(!preg_match($password, $passwordConfirm)){
        $passwordErr = "Le password non coincidono";
      }
    }
    return $passwordErr;
}
}

function checkNomeRicetta($stringNomeRicetta){
  $connection = new DBConnection();
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["REQUEST_METHOD"])){
      $nomeRicettaErr = "Il nome non pu&ograve; essere un campo vuoto";
    }
    else{
      $nomeRicetta = test_input($_POST[$stringNomeRicetta]);
      if(!preg_match("^[a-zA-Z0-9]{3,55}$",$nomeRicetta)){
        $nomeRicettaErr = "La lunghezza massima &egrave; di 55 caratteri alfanumerici";
      }
      if ($connection->query(" SELECT nome FROM ricette WHERE nome=\"$nomeRicetta\" ")->fetch_row() != null) { 
        $emailErr = "Questa ricetta &egrave; gi&agrave; presente";
        $connection->disconnect();
      }
    }
    return $nomeRicettaErr;
  }
}


function checkDifficolta($stringDifficolta){
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["REQUEST_METHOD"])){
      $difficoltaErr = "La difficolt&agrave; non pu&ograve; essere un campo vuoto";
    }
    else{
      $difficolta = test_input($_POST[$stringDifficolta]);
      if(!preg_match("^[1-5]$",$difficolta)){
        $nomeRicettaErr = "L'intervallo valido &egrave; tra 1 e 5";
      }
    }
    return $difficoltaErr;
  }
}

function checkTempo($stringTempo){
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["REQUEST_METHOD"])){
      $tempoErr = "Il tempo non pu&ograve; essere un campo vuoto";
    }
    else{
      $tempo = test_input($_POST[$stringtempo]);
      if(!preg_match("^[1-9][0-9]*$",$tempo)){
        $tempoErr = "Sono ammessi solo valori interi positivi";
      }
    }
    return $tempoErr;
  }
}

function checkPassword($stringPassword, $stringPasswordCofirm){
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["REQUEST_METHOD"])){
      $passwordErr = "La password non pu&ograve; essere un campo vuoto";
    }
    else{
      $password = test_input($_POST[$stringPassword]);
      $passwordConfirm = test_input($_POST[$stringPasswordConfirm]);
      if(!preg_match($password, $passwordConfirm)){
        $passwordErr = "Le password non coincidono";
      }
    }
    return $passwordErr;
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