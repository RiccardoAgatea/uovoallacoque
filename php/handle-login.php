<?php
require_once __DIR__ . "/user.php";
require_once "./validation.php";

session_start();

$_SESSION["email"] = $_POST['email'];
$_SESSION["error"] = checkLogin("password", "email"); 

if ($_SESSION["error"] != "") { 
    $_SESSION["wrong-login"] = true; 
    header("Location: ./login.php"); 
    exit;
} else { 
    $user = new User($_POST['email']);
    $_SESSION['user'] = $user;
    $_SESSION["logged"] = true;
    $_SESSION["wrong-login"] = false;
    $_SESSION["email"] = "";
    $_SESSION["password"] = "";
    $_SESSION["nickname"] = "";
    header("Location: ./utente.php");
    exit;
}




// try {
//     $user = new User($_POST['email']);

//     if ($user->getPassword() != $_POST['password']) {
//         exit;
//         throw new Exception("Wrong password", 1);
//     } else {
//         $_SESSION["logged"] = true;
//         $_SESSION['user'] = $user;
//         $_SESSION["wrong-login"] = false;
//         $_SESSION["email"] = "";
//         $_SESSION["password"] = "";
//         header("Location: ./utente.php");
//         exit;
//     }
// } catch (Exception $e) {
//     $_SESSION["logged"] = false;
//     $_SESSION["wrong-login"] = true;
//     $_SESSION["email"] = $_POST["email"];
//     $_SESSION["password"] = $_POST["password"];
//     header("Location: ./login.php");
//     exit;
// }
