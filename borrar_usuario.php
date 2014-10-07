<?php

	include "config/bd.php";

	$sql = "DELETE FROM usuarios_activos WHERE Nickname = '".$_SESSION['usuario']."'";
	mysql_query($sql);

?>