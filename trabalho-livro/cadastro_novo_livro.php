<?php
	include ("conexao.php");
			
	$novo_nome_livro = $_POST["novo_nome_livro"];
		
	$insert = "INSERT INTO livros (nome_livro) VALUES ('$novo_nome_livro')";
			
	mysqli_query($link, $insert) or die(mysqli_error($link));
	$resultado = mysqli_insert_id($link);
	
	echo $resultado;
?>