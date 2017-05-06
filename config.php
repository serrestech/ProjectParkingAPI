<?php

	$Host = "snf-750694.vm.okeanos.grnet.gr";
	$Username = "NextTech";
	$Password = "1215123@GJK";
	$DBName = "ProjectParking";

	error_reporting(0);

	$Connection = mysql_connect($Host, $Username, $Password) or die("Can't connect with this Server");
	mysql_select_db($DBName);


	function enableJSON() {
		header('Content-Type: application/json');
	}

	function printJSON($ObjectJSON) {
		echo json_encode($ObjectJSON, JSON_PRETTY_PRINT);
	}

?>