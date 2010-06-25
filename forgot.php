<?php

$todo = mysql_escape_string($_POST['todo']);
$forgotpass = "false";

if($todo =="forgotpassword"){
	$added = "true";
}

include('includes/header.php');
include('functions/Albums.php');
include('functions/Featured.php');
?>


<?

$todo = mysql_escape_string($_POST['todo']);

if(isset($todo) and $todo=="forgotpassword"){

$lostusername = $_POST['lostuser'];
$lostemail = $_POST['lostemail'];


function makeRandomPassword() { 
          $salt = "abchefghjkmnpqrstuvwxyz0123456789"; 
          srand((double)microtime()*1000000);  
          $i = 0; 
          while ($i <= 7) { 
                $num = rand() % 33; 
                $tmp = substr($salt, $num, 1); 
                $pass = $pass . $tmp; 
                $i++; 
          } 
          return $pass; 
    } 
    $random_password = makeRandomPassword(); 
    

	$getsignupdatelost = mysql_query("SELECT * FROM users WHERE username='$lostusername' AND email='$lostemail'");
	
	$daterowlost = mysql_fetch_array($getsignupdatelost);
	$signupdatelost = $daterowlost['created_at'];
		
	$db_password = md5(md5($random_password).$signupdatelost);
	
	//
	
	$myQuery = mysql_query("UPDATE users SET password='$db_password' WHERE email ='$lostemail' AND username='$lostusername'");
	if($myQuery && mysql_affected_rows() == 1){

    	$forgotpass = "true";
    // Forgot Email (: (:
		$to      = $lostemail;
		$subject = 'Your password at deweymusic.org';
		
		//message sending
		$message = "Hi, we have reset your password. 
     
    	New Password: $random_password 
     
    	www.deweymusic.org
    	Once logged in you can change your password 
     
    	Thanks! 
    	Dean Putney
     
    	This is an automated response, please do not reply!"; ;
		
		$headers = 'From: Deweymusic.org' . "\r\n" .
    	'Reply-To: deweymusic@gmail.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
		mail($to, $subject, $message, $headers);
		
    } 
	
}

?>
 
	<div id="yui-main">
	 <div class="yui-b">
		<div class="yui-g">
			<h4>Forgot Your Password?</h4>
	
					<? if($forgotpass == "true"){
 			 		echo '<h3 class="success">Password Successfully reset! Please check the email you have entered for your new password :)</h3>';
					} 
					else {
					echo '
					<h3>Please Enter the Username and Email you signed up with below and a random password will be emailed to you :). </h3>
					<form method="post" id="lostpassword" action="">
  					<input type=hidden name=todo value=forgotpassword>
    				<p>
    					<label for="lostuser">Username</label><br>
      					<input id="lostuser" name="lostuser" value="" title="lostuser" type="text"  class="required bordered" onchange="toggle_lostusername(\'lostuser\')"> <br/>
      					<div id="lostusername_exists" style="font-size: 11px;font-weight: bold;color:#FF3300"> </div>
    				</p>
    				<p>
     					<label for="lostemail">Email</label><br>
      					<input id="lostemail" name="lostemail" value="" title="lostemail" type="text" class="required bordered" onchange="toggle_lostemail(\'lostemail\')"><br/>
      					<div id="lostemail_exists" style="font-size: 11px;font-weight: bold;color:#FF3300"> </div>
      				</p>
     				<br>
      				<p>
        				<input id="forgotpassword" class="button" value="Submit" type="submit" value="Send data" disabled/>
     				</p>
     
    				</form>';
    				}?>
		</div>
	 </div>
	</div>
<?php
include('includes/sidebar.php');
include('includes/footer.php');
?>
