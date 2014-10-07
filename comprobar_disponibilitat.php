<?php

	require "config/bd.php";

	$sql = "SELECT * FROM usuarios_activos WHERE Nickname != '".$_SESSION['usuario']."'";
	$query = mysql_query($sql);

	$list1 = [];
    $list2 = [];

    while ($array = mysql_fetch_assoc($query)) {
    	array_push($list1, $array['Nickname'].":".$array['Estado']);
    }

    $c = json_encode($list1); 

    echo $c;

?>