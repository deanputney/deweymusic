<?php
/*
Login functions for modularity
*/

function siteLogin ($username, $userid, $firstname, $lastname){
	siteLogout();
    session_start();
  	$_SESSION["username"]= $username;
  	$_SESSION["userid"] = $userid;
  	$sessionname = "";
  	$sessionname .= $firstname;
  	$sessionname .= " ";
  	$sessionname .= $lastname;
  	$_SESSION["name"] = $sessionname;
}

function addFBUser($username, $fbID){
	$query = "INSERT INTO users (username, email, fb_id) VALUES ('" + $fbID + "', '" + $fbID + "', '" + $fbID + "')";
	$result = mysql_query($query);
	
	if($result){
		$query = "SELECT LAST_INSERT_ID()";
		$result = mysql_query($query);
	
		if($result){
			$fbIDRow = mysql_fetch_array($result);
			return $fbIDRow[0];
		}
	}
}

function siteLogout(){
	session_destroy();
	unset($_SESSION["username"]);
	unset($_SESSION["userid"]);
	unset($_SESSION["username"]);
}

function isValidEmail($email){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
}

?>