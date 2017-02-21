<?php
error_reporting(0);
include('conecta.php');

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Agenda</title>
	<meta language="portugues" />
	<link href="css/style.css" rel="stylesheet"/>
</head>
<body>



<header>
<p>Agenda</p>
</header>
				<!---SELECIONA ANO E MES----->
				<div class="selecao">
				
							<p>Olá, <?php //echo $_SESSION['UsuarioNome']; ?>!</p>
							</div>
							<div class="centro">		
							<caption>Seleciona Mês & Ano</caption>
							<form method='GET' id="ajax-contact">
							<input type='month' name='mes' id="mes" />
							<input type='submit' name='enviar' value="Pesquisar" />
							</form><br>
							</div>
				
				<!---SELECIONA ANO E MES----->
				
<?php	

	
	$mes_selecionado = $_GET['mes'];
	$explode = explode("-",$mes_selecionado);
	$mes = $explode[1];
	$ano = $explode[0];
	

 if($mes == 1)  {
 $dias=31;
 $nome="Janeiro";
 }
 if($mes == 2)  {
 $dias=28;
 $nome="Fevereiro";
 }
 if($mes == 3)  {
 $dias=31;
 $nome="Março";
 }
 if($mes == 4)  {
 $dias=30;
 $nome="Abril";
 }
 if($mes == 5)  {
 $dias=31;
 $nome="Maio";
 }
 if($mes == 6)  {
 $dias=30;
 $nome="Junho";
 }
 if($mes == 7)  {
 $dias=31;
 $nome="Julho";
 }
 if($mes == 8)  {
 $dias=31;
 $nome="Agosto";
 }
 if($mes == 9)  {
 $dias=30;
 $nome="Setembro";
 }
 if($mes == 10) {
 $dias=31;
 $nome="Outubro";
 }
 if($mes == 11) {
 $dias=30;
 $nome="Novembro";
 }
 if($mes == 12) {
 $dias=31;
 $nome="Dezembro";
 }
?>
<?php
 echo '<h3>'.$nome . " de " . $ano.'</h3>';
?>
<table border="1" cellspacing="1">

<tr>
<td width=200><center>Domingo</center></td>
<td width=200><center>Segunda</center></td>
<td width=200><center>Terça</center></td>
<td width=200><center>Quarta</center></td>
<td width=200><center>Quinta</center></td>
<td width=200><center>Sexta</center></td>
<td width=200><center>Sábado</center></td>
</tr>
<?php

		// INICIA O CONTADOR DE DIAS DO MES
		 echo "<tr>";
		 for($i=1;$i<=$dias;$i++) {
		 $diadasemana = date("w",mktime(0,0,0,$mes,$i,$ano));
		 $cont = 0;
		 if($i == 1) {
		 while($cont < $diadasemana) {
		 echo "<td></td>";
		 $cont++;
		 }
		 }
		 
				//COLOCA O 0 NA FRENTE DOS NUMEROS MENORES DE 10
				if ($i < 10){
					$i = "0". $i;
				}
		
 echo "<td><a href='reserva.php?dia=";echo $i; echo "?";echo $mes; echo"?"; echo $ano; echo"'><left>";
 echo $i;
 
	$data =  "$ano-$mes-$i";
 		
		// conexão
		$query = "SELECT * FROM dbdados WHERE data_reserva = '$data'";
		$result = mysql_query($query);
	
		if (mysql_num_rows($result) == "")
		{
			echo "</left>";
			echo "<center>Livre</center></td></a>";
		}
		else
		{
			echo "</left>";
			echo "<center>Reservado</center></td></a>";
		}
 if($diadasemana == 6) {
 echo "</tr>";
 echo "<tr>";
 }
 }
 echo "</tr>";
 ?>
</table>
</body>
</html>