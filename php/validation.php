<?php
require_once "./db-connection.php";

function test_input($data)
{
    $data = trim($data); //rimuove gli spazi
    $data = stripslashes($data);
    $data = htmlentities($data, ENT_QUOTES | ENT_XHTML); // à -> &agrave;
    return $data;
}

function checkNickname($stringNickname) {
    $nicknameErr = $nickname = "";
    $connection = new DBConnection(); // oggetto che rappresenta il database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringNickname])) {
            $nicknameErr = "Il nickname non pu&ograve; essere vuoto";
        } else {
            $nickname = test_input($_POST[$stringNickname]);
            if (!preg_match("/^[A-Za-z0-9]+$/", $nickname)) {
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

function checkEmail($stringEmail)
{
    $emailErr = $email = "";
    $connection = new DBConnection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringEmail])) {
            $emailErr = "La mail non pu&ograve; essere vuota";
        } else {
            $email = test_input($_POST[$stringEmail]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
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

function comparePassword($stringPassword, $stringPasswordCofirm) 
{
	$passwordErr = $password = $passwordConfirm = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringPassword])) {
            $passwordErr = "La password non pu&ograve; essere un campo vuoto";
        } else {
            $password = test_input($_POST[$stringPassword]);
            $passwordConfirm = test_input($_POST[$stringPasswordConfirm]);
            if ($password != $passwordConfirm) {
                $passwordErr = "Le password non coincidono";
            }
        }
        return $passwordErr;
    }
}

function checkLogin($stringPassword, $stringEmail) { // quando accedo controlla che la password è uguale a quella presente nel db
    $err = $email = $password = "";
    $connection = new DBConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringEmail])) { //se la mail è vuota
            $err = "La mail non pu&ograve; essere vuota";
        } else {
            $email = test_input($_POST[$stringEmail]); 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //se la mail non valida
                $err = "Email incorretta";
            }
            if (empty($_POST[$stringPassword])) { //se la password è vuota
                $err = "La password non pu&ograve; essere un campo vuoto";
            } else {
                $password = test_input($_POST[$stringPassword]);
                $result = $connection->query("SELECT passw FROM utenti WHERE email=\"{$email}\"");
                if (!$result) {
                // if ($connection->query(" SELECT passw FROM utenti WHERE email=\"{$email}\" ")->fetch_row() != null) {
                    $err = "L'utente non esiste";
                    $connection->disconnect();
                } else {
                    $user_row = $result->fetch_assoc();
                    if($user_row['passw'] != $password) {
                        $err = "La password non &egrave; corretta";
                    }
                    
                }
            }
        }
        return $err;
    }
}

function checkNomeRicetta($stringNomeRicetta)
{
	$nomeRicettaErr = $nomeRicetta = "";
    $connection = new DBConnection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["REQUEST_METHOD"])) {
            $nomeRicettaErr = "Il nome non pu&ograve; essere un campo vuoto";
        } else {
            $nomeRicetta = test_input($_POST[$stringNomeRicetta]);
            if (!preg_match("/^[a-zA-Z0-9]{3,55}$/", $nomeRicetta)) {
                $nomeRicettaErr = "La lunghezza &egrave; tra 3 e 55 caratteri alfanumerici";
            }
            if ($connection->query(" SELECT nome FROM ricette WHERE nome=\"$nomeRicetta\" ")->fetch_row() != null) {
                $nomeRicettaErr = "Questa ricetta &egrave; gi&agrave; presente";
                $connection->disconnect();
            }
        }
        return $nomeRicettaErr;
    }
}

function checkDifficolta($stringDifficolta)
{
	$difficoltaErr = $difficolta = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["REQUEST_METHOD"])) {
            $difficoltaErr = "La difficolt&agrave; non pu&ograve; essere un campo vuoto";
        } else {
            $difficolta = test_input($_POST[$stringDifficolta]);
            if (!preg_match("/^[1-5]$/", $difficolta)) {
                $difficoltaErr = "L'intervallo valido &egrave; tra 1 e 5";
            }
        }
        return $difficoltaErr;
    }
}

function checkTempo($stringTempo)
{
	$tempoErr = $tempo = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["REQUEST_METHOD"])) {
            $tempoErr = "Il tempo non pu&ograve; essere un campo vuoto";
        } else {
            $tempo = test_input($_POST[$stringtempo]);
            if (!preg_match("/^[1-9][0-9]*$/", $tempo)) {
                $tempoErr = "Sono ammessi solo valori interi positivi";
            }
        }
        return $tempoErr;
    }
}
