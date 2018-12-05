<?php	
	include ("conexao.php");
			
	$nome = $_POST["nome"];
	$sexo = $_POST["sexo"];
	$ler_livro= $_POST["ler_livro"];
	$livro = $_POST["livro"];
			
	$insert ="INSERT INTO cadastro (Nome,Sexo,gosta_livro,livro_preferido)
			VALUES ('$nome','$sexo','$ler_livro','$livro')";
	if(mysqli_query($link, $insert)){
		echo"Foi cadastrado com sucesso";
	}else{
		echo "Erro ao cadastrar<br/>";
			echo mysqli_error($link);
	}
?>