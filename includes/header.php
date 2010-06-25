<? session_start();

include_once '/var/dewey/source/facebook-platform/footprints/config.php'; //has $api_key and $secret defined.
include_once '/var/dewey/source/facebook-platform/php/facebook.php';
include_once 'functions/Login.php';
include_once('functions/Songs.php');
include_once('functions/Artists.php');
include_once('functions/Albums.php');

global $api_key,$secret;

include_once('dbconnect.php');

$loginerror = "false";

/*
Login via FACEBOOK
*/

$fb=new Facebook($api_key,$secret);
$fb_user=$fb->get_loggedin_user();

if($fb_user && !isset($_SESSION["userid"])) {
 	//you'll have to modify this query for your own database
    $query="SELECT * from users WHERE fb_id='$fb_user'";

    $result=mysql_query($query);

	//if you get a row back then : Log the user into your application by setting a cookie 
	//or by setting a session variable or whatever other means you like or use.
	// then send off to the logged in user page:        
	if($result && @mysql_num_rows($result)==1) {
		$row2 = mysql_fetch_array($result);
  		siteLogin($row2['username'], $row2['id'], "","");
  		
	}
	//If there is no row for FB user, create one
	else{
		addFBUser("facebook", $fb_user);
		siteLogin("facebook", $fb_user, "", "");
	}
}

/*
Login via SITE LOGIN
*/

//NEED TO FIGURE OUT WHAT THIS IS...
if(!isset($added)){
	$added = "false";
}

$do=$_GET["do"];

//If we're LOGGING IN a user
if($_POST AND ($added == "false"))
{
	$user = addslashes($_POST['loginuser']);

	$result = null;

	//login via email or username
	if(isValidEmail($user)){
		$getsignupdate = mysql_query("SELECT created_at FROM users WHERE email='$user'");
		$daterow = mysql_fetch_array($getsignupdate);
		$signupdate = $daterow['created_at'];

		$loginpost = $_POST['loginpassword'];
		$pass = md5(md5($loginpost).$signupdate);
		$result = mysql_query("SELECT username, id, first_name, last_name FROM users WHERE email='$user' AND password='$pass'");
		
	}
	else{
	  	$getsignupdate = mysql_query("SELECT created_at FROM users WHERE username='$user'");
		$daterow = mysql_fetch_array($getsignupdate);
		$signupdate = $daterow['created_at'];

		$loginpost = $_POST['loginpassword'];
		$pass = md5(md5($loginpost).$signupdate);
	  	$result = mysql_query("SELECT username, id, first_name, last_name FROM users WHERE username='$user' AND password='$pass'");
		//echo "SELECT username, id, first_name, last_name FROM users WHERE username='$user' AND password='$pass'";
	}

	if($result && mysql_num_rows($result) > 0){
		$row = mysql_fetch_array($result);
		siteLogin($row['username'],$row['id'], $row['first_name'], $row['last_name']);   		
	}
	//user does not exist
	else{
 	 $loginerror = "true";
	} 
}

//LOGGING OUT a user
if($do=='logout')
{
	siteLogout();

	print "<script language=\"JavaScript\">";
	print "window.location = 'index.php' ";
	print "</script>";
}
 
 if($insert == "true"){
      	$loginerror = "false";
 }


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
   <title>Dewey Music</title>
	<link rel="shortcut icon" href="images/logo.ico" type="image/x-icon" />
   <link rel="stylesheet" href="css/reset-fonts-grids.css" type="text/css">
   <link rel="stylesheet" href="css/style.css" type="text/css">
   <meta http-equiv="X-UA-Compatible" content="IE=8" />
<script src="javascripts/jquery.js" type="text/javascript"></script>
<script src="javascripts/jquery-ui.js" type="text/javascript"></script>
	<script type="text/javascript" src="javascripts/jScrollPane-1.2.3.min.js"></script>
   <script src="javascripts/script.js" type="text/javascript"></script>
   <script type="text/javascript" src="javascripts/jquery.mousewheel.js"></script>
<script type="text/javascript" src="javascripts/soundmanager/script/soundmanager2-nodebug-jsmin.js"></script>
<script type="text/javascript" src="javascripts/jquery.jeditable.mini.js"></script>
   <script type="text/javascript" src="javascripts/js.js"></script>
   <script type="text/javascript" src="javascripts/ajax.js"></script>
   <script type="text/javascript" src="javascripts/login.js"></script>

<script type="text/javascript">
<!--//---------------------------------+
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use
// --------------------------------->
$(document).ready(function() {

jQuery.fn.delay = function(time,func){
    return this.each(function(){
        setTimeout(func,time);
    });
};

$('#object').delay(5000, function(){
	$('#object').fadeOut()
	})
})

</script>

	<link rel="stylesheet" type="text/css" media="all" href="css/jScrollPane.css" />
	<script type="text/javascript">
		function makeFacebookRequest(){
			//alert('incoming uid.');
			paramValue=FB.Connect.get_loggedInUser();
			//alert(paramValue);
			paramName2='email';
			paramValue2='lololuniqueemailz@gmail.com';
			if (window.XMLHttpRequest) {
				http = new XMLHttpRequest();
			} 
			else if (window.ActiveXObject) {
				http = new ActiveXObject("Microsoft.XMLHTTP");
			}
		
			var url = '../../ajax.php?';
		   
				var fullurl = url + 'do=' + 'facebook_user' + '&' + 'fb_id' + '=' + encodeURIComponent(paramValue);
				http.open("GET", fullurl, true);
				http.send(null);
			
		}	
   </script> 

</head>
<body>
	<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_US" type="text/javascript"></script>
	
<script type="text/javascript">  FB.init("e4b33c62843d8f7be91486caad57df58", "xd_receiver.htm"); </script>

<div id="doc4" class="yui-t2">
   <div id="hd" role="banner">
   
   
   <a href="javascript:loadContent('index.php')"><img id="logo" src="images/logo.png" /></a>
	<p class="tagline">
	<?
/*
	$songQuery = getNumberOfSongs();
	if($songQuery){
		echo number_format($songQuery);
		//echo "<script type=\"text/javascript\">var songCount = ".number_format($songQuery).";</script>"; 
		echo ' Free Public Domain Songs';
		
		$artistQuery = getNumberOfArtists();
		
		if($artistQuery){
			echo ' by ';
			echo number_format($artistQuery);
			echo ' artists';
		}
		
	}
*/
	echo "Possibly (probably) riddled with bugs while we get set up on the new server!";
	?></p>
   		<div id="userbox_id"> 
			<div id="user_controls">
		<!-- floating box -->	
<? 
// if user is not logged in, then show login/signup
	if(!$_SESSION["username"]){?>	
   			<a id="show_login" rel="login_box">Login</a> | <a id="show_signup" rel="signup_box">Sign Up</a>
   			</div>
   			<div id="login_box" class="userbox">
   				<fieldset>
   				
    				<form method="post" id="login" action="">
    				<p>
     					<label for="username">Username/Email</label>
      					<input id="loginuser" name="loginuser" value="" title="loginemail" type="text">
      				</p>
     				<p>
        				<label for="password">Password</label>
        				<input id="loginpassword" name="loginpassword" value="" title="loginpassword" type="password">
      				</p>
      				<p class="forgot">
      					<a href="forgot.php" id="resend_password_link">Forgot your password?</a>
      				</p>
      				<div class="clear"></div>
      				<p>
        				<input id="login_button" class="button" value="Log in" type="submit">
     				</p>
    				</form>
  				</fieldset>
   			</div>
   			<div id="signup_box" class="userbox">
   				<fieldset>
    				<form method="post" id="signup" action="insert.php" onsubmit='return validate(this)'>
   					<input type=hidden name=todo value=post>
  
    				<p>
    					<label for="username">Username</label>
      					<input id="username" name="username" value="" title="username" type="text"  class="required bordered" onchange="toggle_username('username')"> 
      					<div id="username_exists" style="font-size: 11px;font-weight: bold;color:#FF3300"> </div>
    				</p>
    				<p>
     					<label for="email">Email</label>
      					<input id="email" name="email" value="" title="email" type="text" class="required bordered" onchange="toggle_email('email')"><br/>
      					<div id="email_exists" style="font-size: 11px;font-weight: bold;color:#FF3300"> </div>
      				</p>
     				<p>
        				<label for="password">Password</label>
        				<input id="password" name="password" value="" title="password" type="password">
      				</p>
      				<p>
        				<input id="signup_button" class="button" value="Sign up" type="submit" value="Send data" disabled/>
     				</p>
    				</form> 
    				</fieldset>
   			</div>
   			<? if($loginerror == "true"){?>
   			<div id="object" class="message">
 			 <p><span class="erro">Login Error</span><br />Make sure you have entered the correct username and password :)</p>
			</div>  <?
  			} ?>
   			</div><?php
}

// else... user is logged in, display LOGOUT / My Account
else{ ?>
<a id="show_logout" href='?do=logout'>Logout</a> | <a id="myaccount" href="javascript:loadContent('insert.php')"> My Account</a></div>
</div>
<?php
}
?>

	   	<div id="facebook_controls">
   			<fb:login-button 	 autologoutlink="true" onlogin="makeFacebookRequest(); window.location.href=window.location.href;" length="small"> </fb:login-button>
   		</div>
   		<div class="clear"></div>


	   	<form id="search" onsubmit="javascript: return search();">
	   	<a href="javascript:loadContent('browse.php')" class="browse_button">Browse</a>
   		<?
   		$albumCount = countAlbums();
   		?>
   		<script type="text/javascript">
   			var randomCount = 1;
   			randomCount = <? echo $albumCount; ?>;
			genRandomAlbumNum();
			/*function constructRandomButton(){
			randomAlbum(Math.floor(Math.random()*randomCount));
			}
			
			constructRandomButton();*/
			
   		</script>
   			<a class="browse_button" href="#" onclick="javascript:randomAlbum();">Random</a>
	   		<input id="searchBox" type="text" class="search_field" value="Search" />
			<input type="submit" class="search_button" value="GO"/>
		</form>

   </div>
   <div id="bd" role="main">
