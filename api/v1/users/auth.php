<?php
	
	// Check if there is a user with this ID
	function isRegisteredID($ID) {
		$Query = "SELECT * FROM users WHERE id='$ID'";

		if(mysql_num_rows(mysql_query($Query)) == 1) {
			return true;
		} else {
			return false;
		}
	}

	// Check if there is a user with this Username
	function isRegisteredUsername($Username) {
		$Query = "SELECT * FROM users WHERE username='$Username'";

		if(mysql_num_rows(mysql_query($Query)) == 1) {
			return true;
		} else {
			return false;
		}
	}

	// Check if there is a user with this eMail
	function isRegisteredMail($eMail) {
		$Query = "SELECT * FROM users WHERE email='$eMail'";

		if(mysql_num_rows(mysql_query($Query)) == 1) {
			return true;
		} else {
			return false;
		}
	}

	// Check if this is a valid username
	function isValidUsername($Username) {
		
		// ToDo : Add Username Control

		if($Username == "root") {
			return false;
		} else {
			return true;
		}
	}

	// Check if this is a valid email
	function isValidMail($eMail) {
		if (!filter_var($eMail, FILTER_VALIDATE_EMAIL)) {
      		return false;
    	} else {
    		return true;
    	}
	}

	// Find user's Username from user's ID
	function findUsernameFromID($ID) {
		$Query = "SELECT * FROM users WHERE id='$ID'";
		$Result = mysql_query($Query);
		$Row = mysql_fetch_array($Result);

		return $Row['username'];
	}

	// Find user's Username from user's eMail
	function findUsernameFromMail($eMail) {
		$Query = "SELECT * FROM users WHERE email='$eMail'";
		$Result = mysql_query($Query);
		$Row = mysql_fetch_array($Result);

		return $Row['username'];

	}

	// Find user's ID from user's Username
	function findIDFromUsername($Username) {
		$Query = "SELECT * FROM users WHERE username='$Username'";
		$Result = mysql_query($Query);
		$Row = mysql_fetch_array($Result);

		return $Row['id'];
	}

	// Find user's ID from user's eMail
	function findIDFromMail($eMail) {
		$Query = "SELECT * FROM users WHERE email='$eMail'";
		$Result = mysql_query($Query);
		$Row = mysql_fetch_array($Result);

		return $Row['id'];

	}

	// Find if this user is authorized
	function isAuthorized($Username, $Token) {
		$Query = "SELECT * FROM users WHERE username='$Username'";
		$Row = mysql_fetch_array(mysql_query($Query));
		
		if($Token == md5($Username . $Row['password'])) {
			return true;
		} else {
			return false;
		}
	}

?>