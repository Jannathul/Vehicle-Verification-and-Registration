<?php require_once("../includes/Functions.php");?>
<?php require_once("../includes/Session.php");?>
<?php
$_SESSION["User_ID"]=null;
$_SESSION["Username"]=null;
$_SESSION["AdminName"]=null;
session_destroy();
Redirect_to("Login.php");
?>
