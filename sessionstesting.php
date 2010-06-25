<? session_start();

$do=$_GET["do"];

if($_POST)
{
if($_POST["name"]=='admin' && $_POST["pass"]='pass')
{
$_SESSION["username"]='Admin';
}
}

if($do=='logout')
{
session_destroy();
unset($_SESSION["username"]);
}

?>
<html>
<head>
<title>A Sample Login Script | PHPGame.Net</title>
</head>
<body>
<?
// ======== IF LOGIN SESSION NOT EXIST-REQUEST TO LOGIN
if(!$_SESSION["username"] && $do!='logout')
{
print " Your are currently not login.<br/>Please login with your username and password below
<form action='' method='post'>
Username <input type='text' name='name' size='20'/> (admin).<br/>
Password <input type='password' name='pass' size='20'/> (pass).<br/>
<input type='submit' value= ' Login '/>
</form>";
}

// ======== LOGOUT
if($do=='logout')
{
print "You have successfully logout.<br/>
<a href='index.php'>Click here to main page</a>";
}

// ======== LOGIN SESSION EXIST-YOU CAN ONY SEE THIS AREA ONCE YOU LOGIN CORRECTLY
if($_SESSION["username"])
{
print "Welcome to the Admin area<br/><br/>
<a href='?do=logout'>Logout now</a>";
}
?>
</body>
</html>