			<?php
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
				if(isset($_SESSION["autenticacao"])){
					include "conexao.php";
					$id = $_SESSION["autenticacao"];
					$sql = "SELECT nome_cadastro FROM cadastro_pessoas WHERE id_pessoas=$id";
					$resultado = mysqli_query($link,$sql);
					$linha = mysqli_fetch_assoc($resultado);

					//echo "<ul> <li>".$linha["nome_cadastro"]."</li>";
				}
			?>
			
		<ul>	
			<li><a href="#" id="inicio">Início</a></li>
			<li><a href="#" id="relatorio">Relatório</a></li>
		
		<?php
			if(isset($_SESSION["autenticacao"])){
		?>

			<li><a href="#" id="livro_filme">Preencher Formulário</a></li>
			
			<li style="float:right"><a href="logout.php" class="active">Sair</a></li>
		
		<?php
			}
		?>
	</ul>