<?php

session_start();
require '../_dbConnect.php';

if (!$_SESSION['loggedIn']) {

    header("location:_logIn.php");
}
 
include './_top.php';

?>

