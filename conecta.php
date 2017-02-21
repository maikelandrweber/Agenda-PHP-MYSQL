<?php
	// Tenta se conectar ao servidor MySQL
	mysql_connect('localhost', 'root', 'Mw2711270%') or trigger_error(mysql_error());
	// Tenta se conectar a um banco de dados MySQL
	mysql_select_db('agenda') or trigger_error(mysql_error());
	

?>
	