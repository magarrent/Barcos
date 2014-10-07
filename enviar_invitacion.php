<?php

	require "config/bd.php";

	$destino = $_REQUEST['destino'];

	$sql = "INSERT INTO invitaciones (Origen, Destino, Estado) VALUES ('".$_SESSION['usuario']."', '".$destino."', '0')";
	mysql_query($sql);

?>