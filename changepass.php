<?php

$todo = mysql_escape_string($_POST['todo']);
$forgotpass = "false";

if($todo =="changepass"){
	$added = "true";
}

include('includes/header.php');
include('functions/Albums.php');
include('functions/Featured.php');
?>

<?


$todo = mysql_escape_string($_POST['todo']);

if($todo == "changepass"){



$oldpassword = $_POST['oldpassword'];
$password1 = $_POST['password1']; 
$password2 = $_POST['password2'];

if((strlen($oldpassword) == 0) OR (strlen($password1) == 0) OR (strlen($password2) == 0)){
	
	print '<script type="text/javascript">';
	print 'alert("You left something blank :(")';
	print '</script>'; 
	
	print "<script language=\"JavaScript\">";
	print "window.location = 'changepass.php'; ";
	print "</script>";
	exit;
}



$tempusername = $_SESSION["username"];
	$getsignupdatereset = mysql_query("SELECT username FROM users WHERE username='$tempusername'");
	
	$daterowreset = mysql_fetch_array($getsignupdatereset);
	$signupdatereset = $daterowreset['created_at'];
		
	$db_password1 = md5(md5($password1).$signupdatereset);

if(mysql_query("UPDATE users SET password='$db_password1' where username='$tempusername'")){

	$resetpass = "true";
	}
}
?> 

 
 
<style type="text/css">

.message2{
	-moz-border-radius: 3px;
	-webkit-border-radius:2px;
    border:1px solid black;
	width:200px;
	background:black;
	padding:5px;
	color: #fff;
	margin-top: 3px;
}

</style>



 
 
 
	<div id="yui-main">
	 <div class="yui-b">
		<div class="yui-g">
			<h4>Change your password?</h4>
		</div>
		<div class="yui-g">
				<div class="download_types hidden" id="dl_songid"><a>MP3</a><br /><a>OGG</a><br /><a>Other</a></div>
				<div class="clear"></div>

				<p class="curator">
				Please Enter your New Password: <br><br>
				
					<form method="post" id="changepass" action="">
  					<input type=hidden name=todo value=changepass>
    				<p>
    					<label for="oldpassword">Old Password:</label><br> 
      					<input id="oldpassword" name="oldpassword" value="" title="oldpassword" type="password"  class="required bordered" 															onchange="toggle_oldpassword('oldpassword')">
      					
      					 <br/>
      					<div id="oldpassword_exists" style="font-size: 11px;font-weight: bold;color:#FF3300"> </div>
    				</p>

    				
    				
    					<label for="password1">New Password:</label><br> 
      					<input id="password1" name="password1" value="" title="password1" type="password"  class="required bordered" onchange="toggle_password1('password1')">
      					
      					 <br/>
      					<div id="password1_exists" style="font-size: 11px;font-weight: bold;color:#FF3300"> </div>
    				</p>
    				<p>
     					<label for="password2">Re-enter New Password:</label><br>
      					<input id="password2" name="password2" value="" title="password2" type="password" class="required bordered" onchange="check_password(this.value)"
      					
      					><br/>
      					<div id="password2_exists" style="font-size: 11px;font-weight: bold;color:#FF3300"> </div>
      				</p>
     				<br>
      				<p>
        				<input id="changepassword" class="button" value="Submit" type="submit" value="Send data" disabled/>
     				</p>
    				</form>
    				<? if($resetpass == "true"){?>
   			<div id="object" class="message2">
 			 <p>Password Successfully Changed! Please keep changing your password for better security :)</p>
			</div>  <?
 } ?>
		</div>

	 </div>
	</div>
<?php
include('includes/sidebar.php');
include('includes/footer.php');
?>
