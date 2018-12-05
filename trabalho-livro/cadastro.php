
		<?php	
			include ("conexao.php");
			
			$nome = $_POST["nome"];
			$email_cadastro= $_POST["email"];
			$sexo = $_POST["sexo"];
			$data_cadastro = $_POST["data_nasc"];
			$escolaridade_cadastro = utf8_decode($_POST["escolaridade"]);
			$estado_civil = $_POST["estado_civil"];
			$senha = md5($_POST["senha"]);
			
			
			$insert ="INSERT INTO cadastro_pessoas (nome_cadastro,email_cadastro,sexo_cadastro,escolaridade_cadastro,data_cadastro
			,estadocivil_cadastro,senha, permissao)
					VALUES ('$nome','$email_cadastro','$sexo','$escolaridade_cadastro','$data_cadastro',
					'$estado_civil','$senha','0')";
					
			if(mysqli_query($link, $insert)){
				// mysqli_insert_id - retorna o ID gerado automaticamente na última consulta 
				$id= mysqli_insert_id($link);
				
				// cria	 uma nova sessaão
				session_start();
				$_SESSION["autenticacao"] =$id;
				$_SESSION["permissao"] = '0';
				echo "1";
			}else{
				echo "Erro ao cadastrar<br/>";
				echo mysqli_error($link);
			}
		?>
	