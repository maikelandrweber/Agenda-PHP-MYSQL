<?php
error_reporting(0);
include('conecta.php');

//*PEGA OS DADOS DA OUTRA SESSÃO
	$dados = $_GET['dia'];
	$explode = explode("?",$dados);
	$dia = $explode[0];
	$mes = $explode[1];
	$ano = $explode[2];
	
		$data =  "$ano-$mes-$dia";
		$data_formatada = "$dia-$mes-$ano";
		$data_hoje = date('Y-m-d');
		$data_final = date('Y-m-d', strtotime('+10 days'));


		// conexão
		$query = "SELECT * FROM dbdados WHERE data_reserva = '$data'";
		$result = mysql_query($query);
		$sql = mysql_fetch_array($result);

			$id= $sql['id'];
	
	if (isset($_POST['deletar']) && $_POST['deletar'] = 2) {
		
		$data_enviada = $_POST['data'];
		$user = $_POST['nome'];
		$senha = $_POST['senha'];
		$email = $_POST['email'];
		$termo = $_POST['termo'];
		
				$query = mysql_query("SELECT * FROM dbdados WHERE data_reserva <= '$data_final'");
					if ($qr = mysql_fetch_array($query) <> ""){
						$multa = "Sim";
					} else {$multa = "Não";}
					
				$query = mysql_query("DELETE FROM dbdados WHERE data_reserva = '$data_enviada'");
				$deletado = mysql_query("INSERT INTO dbdeletados (user,email,termo,multa,data_deletada,data) VALUES ('$user','$email','$termo','$multa','$data','$data_hoje')");
	}
	
	if (isset($_POST['acao']) && $_POST['acao'] = 1) {
		
			$user = $_POST['nome'];
			$senha = $_POST['senha'];
			$email = $_POST['email'];
			$termo = $_POST['termo'];
			$turno = $_POST['turno'];
			$finalidade = $_POST['finalidade'];
			$datahoje = date('Y-m-d');
			$data_enviada = $_POST['data'];
			
			
					$query3 = "SELECT * FROM dbdados WHERE data_reserva = '$data_enviada'";
					$result3 = mysql_query($query3);
				
					if (mysql_num_rows($result3) == ""){
						
					mysql_query("INSERT INTO dbdados (user,email,data_reserva,termo,turno,finalidade,data) values ('$user','$email','$data_enviada','$termo','$turno','$finalidade','$datahoje')");
						
					} else{
						echo "<script>window.alert('Está data encontra-se reservada!')</script>";
					}
	  }
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Agenda</title>
	<meta language="portugues" />
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body>
<script>
function bloqueio() {
	if (document.getElementById("divprincipal").style.display == "none"){ 
	document.getElementById("divprincipal").style.display = "block";	  
	}	else	  {	
	document.getElementById("divprincipal").style.display = "none";	 
	}  
	
	}
	
	
				function mostra_texto(){
				document.getElementById('normas').style.display="block";
			}
			function esconde_texto(){
				document.getElementById('normas').style.display="none";
			}
			function checkbox(){  
			if(document.getElementById('termo').checked == true){ 	 
			document.getElementById('envia').disabled = ""  
			}  
			if(document.getElementById('termo').checked == false){ 	 
			ocument.getElementById('envia').disabled = "disabled"  
			}	
			}
	
	</script>

<header>
<p>Agenda</p>
</header>
<form method="GET" action="index.php">
<input type="hidden" name="mes" value="<?php echo "$ano-$mes"?>" />
<input type="submit" value="Voltar"/>
</form>
</body>
<?php


				// conexão
		$query_verifica = mysql_query("SELECT * FROM dbdados WHERE data_reserva = '$data'");
		$sql_verifica = mysql_fetch_array($query_verifica);
		
		//INICIA O LOOP PARA VERIFICAR SE JÁ EXISTE A DATA
		if (mysql_num_rows($query_verifica) == ""){
			echo "<h2>Data selecionada "; echo $data_formatada; echo "</h2>";
		echo "<h2> Esta data encontra-se disponível para reserva, deseja reservar?</h2>";
		?>

			<div class="reserva">

				<form method="POST">
					<input type="radio" name="reserva" onclick="mostra_texto()" >Sim <br>
					<input type="radio" name="reserva" checked  onclick="esconde_texto()">Não<br>
				</form>
				</div>
			<div class="normas" id="normas">
			<?php
			$arquivo = "normas.txt"; 
			$linhas = 10;
				
			$dados = file_get_contents("$arquivo"); 

					$fp=fopen("$arquivo","r");
					$start=microtime(true);
					while($line=fgets($fp)) {
							5;
					}
					$end=microtime(true);
					fclose($fp);
					
				$f = fopen("$arquivo", "r");	
				
				// Lê cada uma das linhas do arquivo
				while(!feof($f)){ 
					echo fgets($f) .'</br>'; }	
				fclose($f); 
?>						
						<div class="form">
						<form style="text-align:center;" method="POST">
						
								<input type="hidden" name="acao" value="1"/>
								<label>Data a ser Reservada</label><br>
								<input type="text" name="data" style="margin:0 auto;" value="<?php echo $data;?>"required/>
								<br><br>
										<label for="turno">Turno</label><br>
										<select name="turno" id="turno" size="" style="margin:0 auto;"required></br>
										<option value="Dia inteiro">Dia inteiro</option>
										</select></br><br>


								<label for="finalidade">Finalidade da Locação</label><br>
										<select name="finalidade" id="finalidade" size="" style="margin:0 auto;" required>
										<option value="Festa de Família">Festa de Família</option>
										<option value="Formatura Cônjuge">Formatura Cônjuge</option>
										<option value="Formatura">Formatura</option>
										<option value="Aniversário">Aniversário</option>
										<option value="Reunião">Reunião</option>
										</select></br><br>
								<input name="termo" id="termo" value="1" type="checkbox" onclick="bloqueio()" required/>
								<label for="termo">Li e concordo com os termos acima.</label></br><br>
						
								<div id="divprincipal" style="display:none;">
										<label>Nome</label><br>
										<input type="text" name="nome"  value="<?php //echo $_SESSION['UsuarioNome'];?>"required/><br>
										<label>Email</label> <br>
										<input type="text" name="email"  value="<?php //echo $_SESSION['UsuarioEmail'];?>" required/><br>
										<label>Senha</label><br>
										<input type="password" name="senha" value="" required/><br>
										<input name="envia" id="envia" type="submit"  value="Cadastrar"/><br>
								</div>
						</div>	
					</form>
			</div>
			
		 <?php
		}else{
		 ?>
				<table border=1>
		
			<h2>Data selecionada  <?php echo $data_formatada;?></h2>
			<tr>
			<td><center>Esta data foi reservada por: <?php echo $sql_verifica['user'];?></center></td>
			</tr><tr>
			<td><center>E-mail para contato: <?php echo $sql_verifica['email'];?></center></td>
			</tr><tr>
			<td><center>Mais informações: teste@teste.com.br</center></td>
			</tr>
				<?php
					if ($sql_verifica['user'] == $_SESSION['UsuarioNome']){	
						
						if ($data <= $data_final){
								echo "<script>window.alert('Conforme os termos *****, cancelamento com menos de 10 dias gera multa,!";
								} else {$adverte = "Estou ciente dos termos!";}		
				?>
					</tr></table><br>
					<h2>Deseja cancelar a reserva?</h2>
						<div class="reserva">
							<form method="POST">
								<input type="radio" name="reserva" onclick="mostra_texto()" >Sim <br>
								<input type="radio" name="reserva" checked  onclick="esconde_texto()">Não<br>
							</form>
						</div>
							<div class="normas" id="normas">
								<p>Cancelamento de Reserva:</p>
								<p>-Segundo o regulamento da ******, o cancelamento de uma reserva, deve ser feita com no mínimo 10(dez) dias de antecedência. </p>
								<p>	-O descumprimento da mesma, resulta em uma multa no valor aproximado de ******.</p>
									
								</br><br>
								<div class="form">
									<form method="POST">
										<input type='hidden' name='deletar' value='2' />
										<input name="termo" id="termo" value="1" type="checkbox" onclick="bloqueio()" required/>
										<label for="termo" style="font-size:20px; text-decoration: underline;"><?php echo $adverte; ?></label>
										</br><br>								
											<div id="divprincipal" style="display:none; margin:0 auto;">
												<label>Data a ser Cancelada</label><br>
												<input type="text" name="data" style="margin:0 auto;" value="<?php echo $data;?>"required/><br>
												<label>Nome</label><br>
												<input type="text" name="nome"  value="<?php echo $_SESSION['UsuarioNome'];?>"required/><br>
												<label>Email</label> <br>
												<input type="text" name="email"  value="<?php echo $_SESSION['UsuarioEmail'];?>" required/><br>
												<label>Senha</label><br>
												<input type="password" name="senha" value="" required/><br>
												<input name="cancelar" id="envia" type="submit"  value="Cancelar Reserva"/><br>
											</div>
									</form>	
								</div>		
					<?php }else{
					}
			} ?>
		
</html>