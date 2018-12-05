<?php
	session_start();
	include "conexao.php";
  $sql = "SELECT * FROM livro_filme";

  $result = mysqli_query($link,$sql);

  $cont_filme =0;
  $cont_nfilme =0;
  $cont_gosta =0;
  $cont_ngosta =0;
  $cont_lendo =0;
  $cont_nlendo =0;

	  while($linha = mysqli_fetch_assoc($result)){
	    if($linha['gosta_ler'] =='Sim'){
	      $cont_gosta++;
	    }
	    else{
	      $cont_ngosta++;
	    }
	    if($linha['tem_filme'] =='Sim'){
	      $cont_filme++;
	    }
	    else{
	      $cont_nfilme++;
	    }
	  
	  if($linha['lendo'] =='Sim'){
	      $cont_lendo++;
	    }
	    else{
	      $cont_nlendo++;
	    }
	 }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">

</script>

<link rel="shortcut icon" href="icon.png" >
	<title>Mundo dos Livros</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	    <script type="text/javascript">	
		
	      google.charts.load("current", {packages:["corechart"]});
	      google.charts.setOnLoadCallback(drawChart);
	      function drawChart() {
	        var data = google.visualization.arrayToDataTable([
	          ['Dados', 'Quantidade'],
	          ['Gosta',<?php echo $cont_gosta?> ],
	          ['Não Gosta',<?php echo $cont_ngosta?>]
	          ]);

	        var options = {
	          title: 'Afinidade com Leitura',		
	          pieHole: 0.5,
	          backgroundColor: '#494646',
	          pieSliceTextStyle: {
	            color: 'white',
	          }
        };

	        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
	        chart.draw(data, options);
	      }	
	      google.charts.setOnLoadCallback(drawChart2);
	      function drawChart2() {
	        var data = google.visualization.arrayToDataTable([
	          ['Dados', 'Quantidade'],
	          ['Tem Filme',<?php echo $cont_filme?> ],
	          ['Não Tem Filme',<?php echo $cont_nfilme?>]
	          ]);

	        var options = {
	          title: 'Livros Lidos Que Contêm Filmes',
	          pieHole: 0.5,
	          backgroundColor: '#494646',
	          pieSliceTextStyle: {
	            color: 'white',
          }
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('donutchart2'));
	        chart.draw(data, options);
	      }
	      google.charts.setOnLoadCallback(drawChart3);
	      function drawChart3() {
	        var data = google.visualization.arrayToDataTable([
	          ['Dados', 'Quantidade'],
	          ['Esta Lendo Atualmente',<?php echo $cont_lendo?> ],
	          ['Não Esta Lendo Atualmente',<?php echo $cont_nlendo?>]
	          ]);

	        var options = {
	          title: 'Pessoas Lendo Livros Atualmente',		
	          pieHole: 0.5,
	          backgroundColor: '#494646',
	          pieSliceTextStyle: {
	            color: 'white',
	          }
        };

	        var chart = new google.visualization.PieChart(document.getElementById('donutchart3'));
	        chart.draw(data, options);
	      }	
	  	
	   
	    </script>
	<script>
		$(document).ready(function(){
			$("#livro").hide();
			$("#btn_cadastro").click(function(){
				$.ajax({
					url: "cadastro.php",
					type: "post",
					data: {
						nome: $("#nome_cadastro").val(),
						email: $("#email_cadastro").val(),
						sexo: $(".sexo:checked").val(),
						data_nasc: $("#data_cadastro").val(),
						escolaridade: $("#escolaridade_cadastro").val(),
						estado_civil: $("#estado-civil").val(),
						senha: $("#senha_cadastro").val()
					},
					
					beforeSend : function(){
						$("#status").html('Cadastrando...');
					}
					}).done(function(msg){
					
					if(msg==1){
						location.href = "index.php";
						
					}else{
						alert(msg);
					}
					}).fail(function(jqXHR, textStatus, msg){
						alert(msg);
					});	
				});
				
			$("#btn_cadastrando").click(function(){
				$(".cadastro").fadeIn();
				$("#form_login").hide();
				$("#livro").hide();
			});
			
			$("#btn_voltar").click(function(){
				$("#form_login").fadeIn();
				$(".cadastro").hide();
				$("#livro").hide();
			});
			
			$(document).on('click',"#relatorio", function(){
				$("#livro").hide();
				$("#form_login").hide();
				$(".cadastro").hide();
				$("#donutchart").fadeIn();
				$("#donutchart2").fadeIn();
				$("#donutchart3").fadeIn();
				
			});
			
			$("#inicio").click(function(){
				$("#form_login").fadeIn(); 
				$("#livro").hide();
				$("#donutchart").hide();
				$("#donutchart2").hide();
				$("#donutchart3").hide();
				$(".cadastro").hide();
			});
			
			$("#btn_form_livro_filme").click(function(){
				$("#form_login").hide();
				$("#donutchart").hide();
				$("#donutchart2").hide();
				$("#donutchart3").hide();
				$.ajax({
					url: "cadastro_livro_filme.php",
					type: "post",
					data: {
						  lendo: $(".lendo:checked").val(),
						  gosta_ler: $(".gosta_ler:checked").val(),
						  tem_filme: $(".tem_filme:checked").val()
					} // pronto
				}).done(function(msg){
					$("#livro").hide();
					$("#cadastro_lf_pronto").html('Obrigado (a) por responder!');
				});
			});
			
			
			$(document).on('click',"#livro_filme", function(){
				$("#form_login").hide();
				$("#livro").fadeIn();
				$("#donutchart").hide();
				$("#donutchart2").hide();	
				$("#donutchart3").hide();
			});

			$("#btn_login").click(function(){
				$.ajax({
					url : "autenticacao.php",
					type : "post",
					data: {
						login : $("#login").val(),
						senha : $("#senha").val()
					},

					beforeSend : function(){
						$("#status").html('Autenticando...');
					}
				}).done(function(msg){
					
					if(msg==1){
						
						
						$("#form_login").html("");
						
						$.ajax({
							url : "pagina_inicial_simples.php",
							type : "get",
						// done:pronta
						}).done(function(msg){
							$("#menu").html(msg);
						});
						
					}else{
						alert(msg);
					}// fail:falhou
				}).fail(function(jqXHR, textStatus, msg){
					alert(msg);
				});
				
			});
		});
	</script>
</head>

<body >
<div id="menu" class="container">
<?php
	include "pagina_inicial_simples.php";
?>
</div>
<div id="pesquisa" style="font-size: 150%; text-align:center; font-style: italic;">
			Caro usuario, esta pesquisa tem como intuito descobrir o numero de pessoas que apreciam a arte da leitura e quanto desses
				livros vão para o mundo cinematografico.
	</div>
<?php	
	if(!isset($_SESSION["autenticacao"])){
?>
	<div id="form_login" class="form_login" name="form_login">
			<div id="status"></div>
				<h2>Formulario de Login</h2>
			<input type="email" class="input" id="login" name="login" placeholder="example@gmail.com" required="required"/>
			</br>
			<input type="password" class="input" id="senha" name="senha" placeholder="Digite aqui sua senha..." required="required"/>
			<br />
			<input type="button" id="btn_login" class="btn" value="Login">
			<input type="button" id="btn_cadastrando" class="btn" value="Cadastre-se">
	</div>
	<?php
	}
	?>
		<?php
		if(!isset($_SESSION["autenticacao"])){
		
		?>
	<div class="cadastro" style="display:none;">
		<h2>Formulário de Cadastro</h2>
			<input type="text" name="nome_cadastro" id="nome_cadastro" placeholder="Nome" required="required"/>
			<br/><br/>
			<input type="email" name="email_cadastro" id="email_cadastro" placeholder="E-mail" required="required"/>
			<br/><br/>
			<label style="margin-right: 45%">
			Sexo:
			</label>
			<label class="container" style="margin-right: 35%">
			<input type="radio" name="sexo" required="required class="sexo" value="Masculino">Masc.
			<span class="checkmark"></span>
			</label>
			<label class="container" style="margin-right: 35%">
			<input type="radio" name="sexo" required="required class="sexo" value="Feminino">Fem.
			<span class="checkmark"></span>
			</label>
			<label class="container" style="margin-right: 35%">
			<input type="radio" name="sexo" required="required class="sexo" value="Outro">Outro
			<span class="checkmark"></span>
			</label>
			<br/><br/>
			<label>Data de Nascimento:</label>
			<br/>
			<input type="date" name="data_cadastro" required="required id="data_cadastro"/>
			<br/><br/>
			<select id="escolaridade_cadastro"  required="required">
						<option>Escolaridade</option>
						<option value="Fundamental">Fundamental</option>
						<option value="Médio">Médio</option>
						<option value="Superior">Superior</option>
						<option value="Pós-graduação">Pós-graduação</option>
			</select>
			<br/><br/>
			<select id="estado-civil">
				<option>Estado-Civil</option>
				<option value="Solteiro">Solteiro</option>
				<option value="Casado">Casado</option>
				<option value="Divorciado">Divorciado</option>
			</select>
			<br/><br/>
			<input type="password" name="senha_cadastro" id="senha_cadastro" placeholder="Senha" required="required"/>
			<br/><br/>
			<input type="button" id="btn_cadastro" class="btn" value="Cadastrar">
			<input type="button" id="btn_voltar" class="btn" value="Voltar">
		</div>
		
		<?php
		}
		?>
	</div>
	<div id="livro" class="livro">
	<h1>Mundo do Livro</h1>
			<label>Você gosta de ler?</label>
			<label class="container">
			<input type="radio" name="opcao" class="gosta_ler" value="sim">Sim
			<span class="checkmark"></span>
			</label>
			<label class="container">
			<input type="radio" name="opcao" class="gosta_ler" value="nao">Não
			<span class="checkmark"></span>
			</label>
			<label>Você esta lendo um livro atualmente?</label>
			<label class="container">
			<input type="radio" name="lendo" class="lendo" value="Sim"/>Sim, estou lendo.
			<span class="checkmark2"></span>
			</label>
			<label class="container">
			<input type="radio" name="lendo" class="lendo" value="Nao"/>Não estou lendo.
			<span class="checkmark2"></span>
			</label>
			
			<label>O Seu livro preferido já ganhou um filme?</label><br /> <br />
			<label class="container">
			<input type="radio" name="nome_filme" class="tem_filme" value="Sim"/>Sim, já ganhou.
			<span class="checkmark3"></span>
			</label>
			
			<label class="container">
			<input type="radio" name="nome_filme" class="tem_filme" value="Nao"/>Não, ainda não ganhou.
			<span class="checkmark4"></span>
			</label>
			<input type="button" id="btn_form_livro_filme" class="btn" value="Pronto..">
	</div>
	<div id="cadastro_lf_pronto" ></div>
	
		<!--Fim do cadastro de login -->
	<div class="graficos">		
		<div id="donutchart" style="width: 22px; height: 1px; display: none; " ></div>
		<div id="donutchart3" style="width: 22px; height: 1px; display: none;margin-left: 35%; " ></div>
		<div id="donutchart2" style="width: 100px; height: 1px; display: none;margin-left: 70%;"></div>
	</div>
	</body>
</html>