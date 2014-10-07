<?php

	if (session_start()) {
		$con = mysql_connect("localhost", "root", "1234");
		mysql_select_db("barcos", $con);
	}

?>