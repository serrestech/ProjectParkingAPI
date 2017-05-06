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
			$ObjectJSON->Users[$Counter]->FromUser = $Row['fromuser'];
			$ObjectJSON->Users[$Counter]->ToUser = $Row['touser'];
			$ObjectJSON->Users[$Counter]->Content = $Row['content'];
			$Counter++;
		}
	}

	printJSON($ObjectJSON);

?>