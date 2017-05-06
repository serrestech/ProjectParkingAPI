<?php

	function isRegisteredMail($eMail) {
		$Query = "SELECT * FROM users WHERE email='$eMail'";
		if(mysql_num_rows(mysql_query($Query)) == 1) {
			return true;
		}
	}

	function isRegisteredUsername($Username) {
		$Query = "SELECT * FROM users WHERE username='$Username'";
		if(mysql_num_rows(mysql_query($Query)) == 1) {
			return true;
		}
	}

	function findUsernameFromMail($eMail) {
		$Query = "SELECT * FROM users WHERE email='$eMail'";
		$Result = mysql_query($Query);

		$Row = mysql_fetch_array($Result);
		return $Row['username'];

	}

?>