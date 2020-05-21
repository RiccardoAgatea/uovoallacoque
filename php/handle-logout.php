<?php

session_start();

$_SESSION["logged"] = false;
$_SESSION['user'] = NULL;
$_SESSION["wrong-login"] = false;
$_SESSION["email"] = "";
$_SESSION["password"] = "";
header("Location: ../index.php");
exit;
    