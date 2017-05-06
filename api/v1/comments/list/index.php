<?php

	require_once("../../../../config.php");
	enableJSON();

	$Query = "SELECT * FROM comments";

	$Result = mysql_query($Query);

	if(mysql_num_rows($Result) == 0) {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "No Comments Found";
	} else {
		$ObjectJSON->Status = "OK";
		$ObjectJSON->Message = "Comments Found";
		$Counter = 0;
		while($Row = mysql_fetch_array($Result)) {
			$ObjectJSON->Comments[$Counter]->FromUser = $Row['fromuser'];
			$ObjectJSON->Comments[$Counter]->ToUser = $Row['touser'];
			$ObjectJSON->Comments[$Counter]->Content = $Row['content'];
			$Counter++;
		}
	}

	printJSON($ObjectJSON);

?>