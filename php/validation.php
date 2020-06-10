<?php
require_once "./db-connection.php";

function test_input($data)
{
    $data = trim($data); //rimuove gli spazi
    $data = stripslashes($data);
    $data = htmlentities($data, ENT_QUOTES | ENT_XHTML); // à -> &agrave;
    return $data;
}

function checkNickname($stringNickname)
{
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
            if (strlen($stringNickname) > 20) {
                $nicknameErr = "Il nickname non può essere più lungo di 20 caratteri";
            }
            if ($connection->query(" SELECT nickname FROM utenti WHERE nickname=\"$nickname\" ")->fetch_row() != null) {
                $nicknameErr = "Il nickname inserito &egrave; gi&agrave; utilizzato";
                $connection->disconnect();
            }
        }
    }
    return $nicknameErr;
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
    }
    return $emailErr;
}

function comparePassword($stringPassword, $stringPasswordConfirm)
{
    $passwordErr = $password = $passwordConfirm = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringPassword]) || empty($_POST[$stringPasswordConfirm])) {
            $passwordErr = "La password non pu&ograve; essere un campo vuoto";
        } else {
            $password = test_input($_POST[$stringPassword]);
            $passwordConfirm = test_input($_POST[$stringPasswordConfirm]);
            if ($password != $passwordConfirm) {
                $passwordErr = "Le password non coincidono";
            }
        }
    }
    return $passwordErr;
}

function checkLogin($stringPassword, $stringEmail)
{ // quando accedo controlla che la password è uguale a quella presente nel db
    $err = $email = $password = "";
    $connection = new DBConnection();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringEmail])) { //se la mail è vuota
            $err = "Credenziali errate";
        } else {
            $email = test_input($_POST[$stringEmail]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //se la mail non valida
                $err = "Credenziali errate";
            }
            if (empty($_POST[$stringPassword])) { //se la password è vuota
                $err = "Credenziali errate";
            } else {
                $password = test_input($_POST[$stringPassword]);
                $result = $connection->query("SELECT passw FROM utenti WHERE email=\"{$email}\""); //se c'è la mail nel db
                if (!$result) {
                    $err = "Credenziali errate";
                    $connection->disconnect();
                } else {
                    $user_row = $result->fetch_assoc();
                    if ($user_row['passw'] != $password) { //se la password non corrisponde
                        $err = "Credenziali errate";
                    }

                }
            }
        }
    }
    return $err;
}

function checkAddNomeRicetta($stringNomeRicetta)
{
    $nomeRicettaErr = $nomeRicetta = "";
    $connection = new DBConnection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringNomeRicetta])) {
            $nomeRicettaErr = "Il nome non pu&ograve; essere un campo vuoto";
        } else {
            $nomeRicetta = test_input($_POST[$stringNomeRicetta]);
            if (!preg_match("/^.{3,55}$/", $nomeRicetta)) {
                $nomeRicettaErr = "La lunghezza &egrave; tra 3 e 55 caratteri";
            }
            if ($connection->query(" SELECT nome FROM ricette WHERE nome=\"$nomeRicetta\" ")->fetch_row() != null) {
                $nomeRicettaErr = "Questa ricetta &egrave; gi&agrave; presente";
                $connection->disconnect();
            }
        }
    }
    return $nomeRicettaErr;
}

function checkEditNomeRicetta($stringNomeRicetta)
{
    $nomeRicettaErr = $nomeRicetta = "";
    $connection = new DBConnection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringNomeRicetta])) {
            $nomeRicettaErr = "Il nome non pu&ograve; essere un campo vuoto";
        } else {
            $nomeRicetta = test_input($_POST[$stringNomeRicetta]);
            if (!preg_match("/^.{3,55}$/", $nomeRicetta)) {
                $nomeRicettaErr = "La lunghezza &egrave; tra 3 e 55 caratteri";
            }
        }
    }
    return $nomeRicettaErr;
}

function checkDifficolta($stringDifficolta)
{
    $difficoltaErr = $difficolta = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringDifficolta])) {
            $difficoltaErr = "La difficolt&agrave; non pu&ograve; essere un campo vuoto";
        } else {
            $difficolta = test_input($_POST[$stringDifficolta]);
            if (!preg_match("/^[1-5]$/", $difficolta)) {
                $difficoltaErr = "L'intervallo valido &egrave; tra 1 e 5";
            }
        }
    }
    return $difficoltaErr;
}

function checkTempo($stringTempo)
{
    $tempoErr = $tempo = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringTempo])) {
            $tempoErr = "Il tempo non pu&ograve; essere un campo vuoto";
        } else {
            $tempo = test_input($_POST[$stringTempo]);
            if (!preg_match("/^[1-9][0-9]*$/", $tempo)) {
                $tempoErr = "Sono ammessi solo valori interi positivi";
            }
        }
    }
    return $tempoErr;
}

function checkKeywords($stringKeywords)
{
    $keywordsErr = $keywords = "";
    $connection = new DBConnection(); // oggetto che rappresenta il database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST[$stringKeywords])) {
            $keywordsErr = "Il campo non pu&ograve; essere vuoto";
        } else {
            $keywords = test_input($_POST[$stringKeywords]);
            if (!preg_match("/^[A-Za-z0-9,\s]+$/", $keywords)) {
                $keywordsErr = "Le keywords devono contenere solo lettere e numeri";
            }
        }
    }
    return $keywordsErr;
}

function checkImage($stringImage)
{
    $imageErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && file_exists($_FILES[$stringImage]['tmp_name'])) {
        $extension = strtolower(pathinfo($_FILES[$stringImage]['name'], PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "svg");
        if (!in_array($extension, $allowed_extensions)) {
            $imageErr = "Formato immagine non valido";
        }
    }
    return $imageErr;
}
