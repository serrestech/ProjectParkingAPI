<?php

	// MySQL Server Info (Host, Username, Password, DataBase Name)
	$Host = "next-tech.techlimittv.eu";
	$Username = "NextTech";
	$Password = "1215123@GJK";
	$DBName = "ProjectParking";

	// Disable Error Reporting on PHP
	error_reporting(0);

	// Connect the BackEnd with the MySQL Server
	$Connection = mysql_connect($Host, $Username, $Password) or die("Can't connect with this Server");
	
	// Select DataBase
	mysql_select_db($DBName);

	// Enable JSON Content Type for PHP files
	function enableJSON() {
		header('Content-Type: application/json');
	}

	// Print Object as JSON Object with Pretty Format
	function printJSON($ObjectJSON) {
		echo json_encode($ObjectJSON, JSON_PRETTY_PRINT);
	}

?>