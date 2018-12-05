<?php
	session_start();
	if(!isset($_SESSION["autenticacao"])){
		header("Location: login.php");
	}else{
		header("Location:index.php");
	}
?>	