<?php

	include ("conexao.php");
	
	$login = $_POST["login"];
	
	$senha = md5($_POST["senha"]);
	
	$sql = "SELECT * FROM cadastro_pessoas WHERE email_cadastro LIKE '$login' AND senha LIKE '$senha'";
	$resultado = mysqli_query($link, $sql) or die($sql);
	
	if(mysqli_num_rows($resultado)>=1){
		$linha = mysqli_fetch_assoc($resultado);
		session_start();
		$_SESSION["autenticacao"] = $linha["id_pessoas"];
		$_SESSION["permissao"] = $linha["permissao"];
		echo "1";
	}else{
		echo $sql;
	}

?>