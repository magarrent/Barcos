<?php

	require "config/bd.php";

	$sql = "SELECT * FROM invitaciones WHERE Destino = '".$_SESSION['usuario']."' || Origen = '".$_SESSION['usuario']."'";
	$query = mysql_query($sql);

	$list1 = [];

    while ($array = mysql_fetch_assoc($query)) {
    	array_push($list1, $array['Origen'].":".$array['Destino'].":".$array['Estado']);
    }

    $c = json_encode($list1); 

    echo $c;

?>