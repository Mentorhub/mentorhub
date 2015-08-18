<?php require_once "includes/functions.php"; ?>
<?php 
	session_start();
	session_destroy();
	$_SESSION["loggedinuser"]="";
	$_SESSION["loggedin"]=false;
	$loggedin=false;
	$loggedinuser="";
	redirect("index.php");
 ?>