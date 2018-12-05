<?php
	include ("conexao.php");
	include "menu.inc";
			
	$lendo = $_POST["lendo"];
	$gosta_ler = $_POST["gosta_ler"];
	$tem_filme = $_POST["tem_filme"];
	
		
	$insert = "INSERT INTO livro_filme (lendo, gosta_ler, tem_filme) VALUES ('$lendo', '$gosta_ler', '$tem_filme')";
	
	// faz uma consulta no banco // 
	mysqli_query($link, $insert) or die(mysqli_error($link));
	$id = mysqli_insert_id($link);
	
	echo $id;
?>