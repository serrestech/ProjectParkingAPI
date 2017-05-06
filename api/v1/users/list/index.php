<?php

	require_once("../../../../config.php");
	enableJSON();

	require_once("../auth.php");

	$Query = "SELECT * FROM users";

	$Result = mysql_query($Query);

	if(mysql_num_rows($Result) == 0) {
		$ObjectJSON->Status = "BAD";
		$ObjectJSON->Message = "We can't find users !";
	} else {
		$ObjectJSON->Status = "OK";
		$ObjectJSON->Message = "We find those users !";
		$Counter = 0;
		while($Row = mysql_fetch_array($Result)) {
			$ObjectJSON->Users[$Counter]->ID = $Row['id'];
			$ObjectJSON->Users[$Counter]->Username = $Row['username'];
			$ObjectJSON->Users[$Counter]->eMail = $Row['email'];
			$ObjectJSON->Users[$Counter]->Mobile = $Row['mobile'];
			$Counter++;
		}
	}

	printJSON($ObjectJSON);

?>